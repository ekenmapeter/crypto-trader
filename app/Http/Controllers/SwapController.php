<?php

namespace App\Http\Controllers;

use App\Models\Swap;
use App\Models\UserWallet;
use App\Models\WalletType;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SwapController extends Controller
{
    public function create()
    {
        $walletTypes = WalletType::where('active', true)->orderBy('coin_name')->get();
        $userWallets = UserWallet::where('user_id', Auth::id())
            ->with('walletType')
            ->get();
        return view('user.pages.swap', [
            'title' => 'Swap',
            'walletTypes' => $walletTypes,
            'userWallets' => $userWallets,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'from_wallet_type_id' => 'required|exists:wallet_type,id|different:to_wallet_type_id',
            'to_wallet_type_id' => 'required|exists:wallet_type,id',
            'from_amount' => 'required|numeric|min:0.00000001',
            'rate' => 'required|numeric|min:0',
        ]);

        $fromWallet = UserWallet::where('user_id', Auth::id())
            ->where('wallet_type_id', $request->from_wallet_type_id)
            ->first();
        if (!$fromWallet || ($fromWallet->amount ?? 0) < (float)$request->from_amount) {
            return back()->with('error', 'Insufficient balance');
        }

        $toAmount = (float)$request->from_amount * (float)$request->rate;

        // Get wallet type information for transaction details
        $fromWalletType = WalletType::find($request->from_wallet_type_id);
        $toWalletType = WalletType::find($request->to_wallet_type_id);

        DB::beginTransaction();
        try {
            // debit from coin
            $fromWallet->amount = ($fromWallet->amount ?? 0) - (float)$request->from_amount;
            $fromWallet->save();

            // credit to coin
            $toWallet = UserWallet::firstOrCreate([
                'user_id' => Auth::id(),
                'wallet_type_id' => $request->to_wallet_type_id,
            ], [ 'amount' => 0 ]);
            $toWallet->amount = ($toWallet->amount ?? 0) + $toAmount;
            $toWallet->save();

            // Create swap record
            $swap = Swap::create([
                'user_id' => Auth::id(),
                'from_wallet_type_id' => $request->from_wallet_type_id,
                'to_wallet_type_id' => $request->to_wallet_type_id,
                'from_amount' => $request->from_amount,
                'to_amount' => $toAmount,
                'rate' => $request->rate,
                'status' => 'completed',
            ]);

            // Create transaction record for the swap
            $metadata = [
                'from_wallet_type_id' => $request->from_wallet_type_id,
                'to_wallet_type_id' => $request->to_wallet_type_id,
                'from_coin' => $fromWalletType->short_code,
                'to_coin' => $toWalletType->short_code,
                'from_amount' => $request->from_amount,
                'to_amount' => $toAmount,
                'rate' => $request->rate,
                'swap_id' => $swap->id,
                'from_wallet_id' => $fromWallet->id,
                'to_wallet_id' => $toWallet->id
            ];

            TransactionService::createTransaction([
                'user_id' => Auth::id(),
                'username' => Auth::user()->username,
                'transaction_type' => \App\Models\Transactions::TYPE_EXCHANGE,
                'reference_id' => $swap->id,
                'reference_type' => Swap::class,
                'amount' => $request->from_amount,
                'description' => "Swap {$request->from_amount} {$fromWalletType->short_code} to {$toAmount} {$toWalletType->short_code}",
                'currency' => $fromWalletType->short_code,
                'exchange_rate' => $request->rate,
                'exchange_from_currency' => $fromWalletType->short_code,
                'exchange_to_currency' => $toWalletType->short_code,
                'payment_method' => \App\Models\Transactions::PAYMENT_WALLET,
                'payment_status' => \App\Models\Transactions::PAYMENT_COMPLETED,
                'status' => \App\Models\Transactions::STATUS_COMPLETED,
                'metadata' => $metadata
            ]);

            DB::commit();

            return redirect()->route('user')->with('success', 'Swap completed successfully.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Swap failed. Please try again.');
        }
    }
}


