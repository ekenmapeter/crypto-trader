<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\UserWallet;
use App\Models\WalletType;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\WithdrawalSubmitted;
use App\Mail\WithdrawalPending;
use App\Mail\WithdrawalApproved;
use App\Mail\WithdrawalRejected;

class WithdrawalController extends Controller
{
    public function create()
    {
        $wallet_user_id = Auth::id();
        $totalWalletAmount = DB::table('user_wallet')
            ->where('user_id', $wallet_user_id)
            ->sum('amount');

        $activeWalletTypes = WalletType::where('active', true)->orderBy('coin_name')->get();
        $userWallets = UserWallet::where('user_id', Auth::id())
            ->whereIn('wallet_type_id', $activeWalletTypes->pluck('id'))
            ->with('walletType')
            ->get();

        return view('user.pages.withdraw', [
            'title' => 'Withdraw',
            'walletTypes' => $activeWalletTypes,
            'userWallets' => $userWallets,
            'totalWalletAmount' => $totalWalletAmount
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'method' => 'required|in:crypto,bank,wire',
            'wallet_type_id' => 'required|exists:wallet_type,id',
            'amount' => 'required|numeric|min:0.00000001',
            'destination_address' => 'nullable|string|max:255',
            'bank_name' => 'nullable|string|max:255',
            'account_name' => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:255',
            'wire_details' => 'nullable|string',
        ]);

        // Optionally enforce method-specific required fields
        if ($request->method === 'crypto') {
            $request->validate(['destination_address' => 'required|string']);
        } elseif ($request->method === 'bank') {
            $request->validate([
                'bank_name' => 'required|string',
                'account_name' => 'required|string',
                'account_number' => 'required|string',
            ]);
        } elseif ($request->method === 'wire') {
            $request->validate(['wire_details' => 'required|string']);
        }

        $user = Auth::user();

        // Check if user has sufficient balance
        $userWallet = UserWallet::where('user_id', $user->id)
            ->where('wallet_type_id', $request->wallet_type_id)
            ->first();

        if (!$userWallet || $userWallet->amount < $request->amount) {
            return back()->withErrors(['amount' => 'Insufficient balance for withdrawal.']);
        }

        DB::beginTransaction();
        try {
            // Deduct from user's wallet immediately
            $userWallet->amount = max(0, ($userWallet->amount ?? 0) - (float)$request->amount);
            $userWallet->save();

            $withdrawal = Withdrawal::create([
                'user_id' => $user->id,
                'wallet_type_id' => $request->wallet_type_id,
                'method' => $request->method,
                'amount' => $request->amount,
                'destination_address' => $request->destination_address,
                'bank_name' => $request->bank_name ?? '',
                'account_name' => $request->account_name ?? '',
                'account_number' => $request->account_number ?? '',
                'wire_details' => $request->wire_details,
                'username' => $user->username,
                'phone' => $user->mobile_number ?? '',
                'status' => 0, // 0 = pending, 1 = approved, 2 = rejected
                'is_debited' => 1,
            ]);

            // Create transaction record using TransactionService
            $metadata = [
                'method' => $request->method,
                'wallet_type_id' => $request->wallet_type_id,
                'destination_address' => $request->destination_address,
                'bank_name' => $request->bank_name,
                'account_name' => $request->account_name,
                'account_number' => $request->account_number,
                'wire_details' => $request->wire_details,
                'withdrawal_id' => $withdrawal->id
            ];

            TransactionService::createWithdrawalTransaction(
                $user,
                $request->amount,
                $userWallet->walletType->coin_name ?? 'USD',
                $withdrawal,
                $metadata
            );

            // Notify Admin & User
            try {
                $adminSetting = \App\Models\AdminSetting::first();
                $adminEmail = $adminSetting?->admin_email ?? 'admin@coinledger.com';
                
                // Admin Notification
                \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\WithdrawalSubmitted($withdrawal->load('user', 'walletType')));
                
                // User Notification
                \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\WithdrawalPending($withdrawal));
                
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Withdrawal notification failed: ' . $e->getMessage());
            }

            DB::commit();
            return redirect()->route('user.withdraw.create')->with('success', 'Withdrawal submitted. Funds have been deducted from your wallet for review.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed to submit withdrawal. Please try again.']);
        }
    }

    // Admin methods
    public function adminIndex()
    {
        $withdrawals = Withdrawal::with('user', 'walletType')->latest()->paginate(30);
        return view('admin.pages.withdrawals', compact('withdrawals'));
    }

    public function adminPreview($id)
    {
        $withdrawal = Withdrawal::with('user', 'walletType')->findOrFail($id);
        return view('admin.pages.preview-withdrawal', compact('withdrawal'));
    }

    public function approve($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status === 1) {
            return back()->with('success', 'Already approved');
        }

        DB::beginTransaction();
        try {
            // Idempotent Debit Check: 
            // If the withdrawal was not debited at submission (e.g. legacy records), debit it now.
            if (!$withdrawal->is_debited) {
                $userWallet = UserWallet::where('user_id', $withdrawal->user_id)
                    ->where('wallet_type_id', $withdrawal->wallet_type_id)
                    ->first();

                if (!$userWallet) {
                    throw new \Exception('User wallet not found');
                }

                if ($userWallet->amount < $withdrawal->amount) {
                    throw new \Exception('Insufficient balance for withdrawal');
                }

                $userWallet->amount = max(0, ($userWallet->amount ?? 0) - (float)$withdrawal->amount);
                $userWallet->save();

                $withdrawal->is_debited = 1;
            }

            // Update withdrawal status
            $withdrawal->status = 1; // 1 = approved
            $withdrawal->approved_at = now();
            $withdrawal->save();

            // Update transaction status
            $transaction = \App\Models\Transactions::where('reference_id', $withdrawal->id)
                ->where('reference_type', Withdrawal::class)
                ->first();

            if ($transaction) {
                TransactionService::approveTransaction($transaction, 'Withdrawal approved and processed');
            }

            // Notify User
            try {
                \Illuminate\Support\Facades\Mail::to($withdrawal->user->email)->send(new WithdrawalApproved($withdrawal->load('user', 'walletType')));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Withdrawal approval email failed: ' . $e->getMessage());
            }

            DB::commit();
            return back()->with('success', 'Withdrawal approved and wallet debited.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed to approve withdrawal: ' . $e->getMessage()]);
        }
    }

    public function reject($id, Request $request)
    {
        $request->validate([
            'admin_notes' => 'required|string|max:500'
        ]);

        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status === 2) {
            return back()->with('success', 'Already rejected');
        }

        DB::beginTransaction();
        try {
            // Refund the user's wallet only if it was previously debited
            if ($withdrawal->is_debited) {
                $userWallet = UserWallet::where('user_id', $withdrawal->user_id)
                    ->where('wallet_type_id', $withdrawal->wallet_type_id)
                    ->first();

                if ($userWallet) {
                    $userWallet->increment('amount', (float)$withdrawal->amount);
                }
                
                $withdrawal->is_debited = 0;
            }

            // Update withdrawal status
            $withdrawal->status = 2; // 2 = rejected
            $withdrawal->rejected_at = now();
            $withdrawal->admin_notes = $request->admin_notes;
            $withdrawal->save();

            // Update transaction status
            $transaction = \App\Models\Transactions::where('reference_id', $withdrawal->id)
                ->where('reference_type', Withdrawal::class)
                ->first();

            if ($transaction) {
                TransactionService::rejectTransaction($transaction, $request->admin_notes);
            }

            // Notify User
            try {
                \Illuminate\Support\Facades\Mail::to($withdrawal->user->email)->send(new WithdrawalRejected($withdrawal->load('user', 'walletType')));
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Withdrawal rejection email failed: ' . $e->getMessage());
            }

            DB::commit();
            return back()->with('success', 'Withdrawal rejected successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withErrors(['error' => 'Failed to reject withdrawal: ' . $e->getMessage()]);
        }
    }
}


