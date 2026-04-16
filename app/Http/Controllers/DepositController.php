<?php

namespace App\Http\Controllers;

use App\Models\Deposit;
use App\Models\UserWallet;
use App\Models\WalletType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class DepositController extends Controller
{
    public function create()
    {
        $walletTypes = WalletType::where('active', true)->orderBy('coin_name')->get();
        return view('user.pages.deposit', [
            'title' => 'Deposit',
            'walletTypes' => $walletTypes,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'wallet_type_id' => 'required|exists:wallet_type,id',
            'amount' => 'nullable|numeric|min:0',
            'tx_reference' => 'nullable|string|max:255',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:4096',
        ]);

        $proofPath = null;
        if ($request->hasFile('payment_proof')) {
            $proofPath = $request->file('payment_proof')->store('deposit_proofs', 'public');
        }

        $deposit = Deposit::create([
            'user_id' => Auth::id(),
            'wallet_type_id' => $request->wallet_type_id,
            'amount' => $request->amount,
            'tx_reference' => $request->tx_reference,
            'payment_proof' => $proofPath,
            'status' => 'pending',
        ]);

        // Notify Admin
        try {
            $adminEmail = \App\Models\AdminSetting::first()?->admin_email ?? 'admin@coinledger.com';
            \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\DepositSubmitted($deposit->load('user', 'walletType')));
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Deposit notification failed: ' . $e->getMessage());
        }

        return redirect()->route('user.deposit.create')->with('success', 'Deposit submitted for review.');
    }

    // Admin
    public function adminIndex()
    {
        $deposits = Deposit::with('user', 'walletType')->latest()->paginate(30);
        return view('admin.pages.deposits', compact('deposits'));
    }

    public function adminPreview($id)
    {
        $deposit = Deposit::with('user', 'walletType')->findOrFail($id);
        return view('admin.pages.preview-deposit', compact('deposit'));
    }

    public function approve($id)
    {
        $deposit = Deposit::with('walletType')->findOrFail($id);
        if ($deposit->status === 'approved') {
            return back()->with('success', 'Already approved');
        }

        // credit user's wallet for this wallet type
        $userWallet = UserWallet::firstOrCreate([
            'user_id' => $deposit->user_id,
            'wallet_type_id' => $deposit->wallet_type_id,
        ], [
            'amount' => 0,
        ]);
        $userWallet->amount = ($userWallet->amount ?? 0) + (float)($deposit->amount ?? 0);
        $userWallet->save();

        $deposit->status = 'approved';
        $deposit->credited_at = now();
        $deposit->save();

        // Notify User
        try {
            Mail::to($deposit->user->email)->send(new \App\Mail\DepositApproved($deposit->load('user', 'walletType')));
        } catch (\Exception $e) {
            Log::error('Deposit approval notification failed: ' . $e->getMessage());
        }

        return back()->with('success', 'Deposit approved and wallet credited.');
    }

    public function reject($id)
    {
        $deposit = Deposit::findOrFail($id);
        $deposit->status = 'rejected';
        $deposit->save();
        return back()->with('success', 'Deposit rejected.');
    }
}


