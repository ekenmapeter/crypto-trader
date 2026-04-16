<?php

namespace App\Http\Controllers;

use App\Models\Crypto;
use App\Models\CryptoReceipt;
use App\Models\BuyCrypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Transactions;
use App\Models\Notifications;
use App\Models\Activities;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Redirect;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Session;
use App\Notifications\CryptoEmailNotification;
use App\Models\UserWallet;


class CryptoController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
      {
        $title = 'Trade Crypto';

        $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);

        $notificationSidebar = Notifications::where('open', '=', 0)->count();

        $getcoin = Crypto::orderBy('created_at', 'desc')->paginate(20);

        return view('user.pages.crypto', compact('title','notificationSidebar','notification', 'getcoin'));
      }


      public function addCrypto()
      {
        $title = 'Add New Crypto';

        $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);

        $notificationSidebar = Notifications::where('open', '=', 0)->count();
        $getcoin = Crypto::orderBy('created_at', 'desc')->paginate(20);

        return view('admin.pages.add-new-crypto', compact('title','notificationSidebar','notification', 'getcoin'));
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

                public function qrcodeUpload(Request $request)
        {
            if (!$request->has('qrcode_upload')) {
                return response()->json(['message' => 'Missing file'], 422);
            }

            $file1 = $request->file('qrcode_upload');
            $filename1 = Str::random(15) . "." . $request->file('qrcode_upload')->extension();
            $publicPath = public_path('qr_codes');
            $file1->move($publicPath, $filename1);

            $updated_at = time();

            return $filename1;
        }


        public function editCoin(Request $request)
        {

            try {

                $crypto = Crypto::findOrFail($request->id);

                $crypto->wallet_address = $request->wallet_address;
                $crypto->coin_rate = $request->coin_rate;
                $crypto->qr_code = $request->qrcode_upload;

                $crypto->save();

                return redirect()->back()->with('success', 'Crypto updated successfully.');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', 'An error occurred while updating the crypto.');
            }
        }


    public function tradeCryptoUpload(Request $request)

        {
            if (!$request->has('receipt_upload')) {
            return response()->json(['message' => 'Missing file'], 422);
        }


            $filename = time().$request->file('receipt_upload')->getClientOriginalName();
            $path = $request->file('receipt_upload')->storeAs('upload', $filename, 'public');
            $fullpath = '/storage/'.$path;
            $updated_at = time();
            return $fullpath;
        }


    public function tradeCryptoContent(Request $request)
        {

            $payout = $request->amount * $request->coin_rate;
           $fullname = Auth::user()->firstname . ' ' . Auth::user()->lastname;

                $crypto_create = CryptoReceipt::create([
                    'user_id' => Auth::id(),
                    'fullname' => $fullname,
                    'username' => Auth::user()->username,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->mobile_number,
                    'amount' => $request->amount,
                    'status' => 0,
                    'coin_name' => $request->coin_name,
                    'coin_id' => $request->coin_id,
                    'logo' =>$request->logo,
                    'coin_rate' => $request->coin_rate,
                    'receipt_upload' => $request->receipt_upload,
                    'recieve_wallet_address' => $request->wallet_address,
                    'payout' => $payout,
                ]);

                $transactions_create = Transactions::create([
                    'user_id' => Auth::id(),
                    'username' => Auth::user()->username,
                    'amount' => $payout,
                    'status' => 0,
                    'card_type' => $request->coin_name,
                    'card_country_type' => 'None',
                    'card_amount' => $request->amount,
                    'logo' =>$request->logo,
                    'rate' => $request->coin_rate,
                    'transaction_type' => 'Crypto',
                    'card1' => $request->receipt_upload,
                ]);

        Auth::user()->save();
        // Dispatch the ActivityEmailNotification
        $user = Auth::user(); // Get the authenticated user
        $user->notify(new CryptoEmailNotification($transactions_create));
        Alert::html('Successful', 'Your transaction was successful, you can review your transaction staus in 15mins' , 'success');


        return Redirect::back();
        }

        public function buyCrypto(Request $request)
        {
            // Handle receipt upload if provided
            $receiptPath = null;
            if ($request->hasFile('receipt_upload')) {
                $filename = time() . $request->file('receipt_upload')->getClientOriginalName();
                $path = $request->file('receipt_upload')->storeAs('receipts', $filename, 'public');
                $receiptPath = '/storage/' . $path;
            }

            $buy_crypto = BuyCrypto::create([
                'coin_id'        => $request->coin_id ?? $request->wallet_type_id,
                'user_id'        => Auth::id(),
                'coin_name'      => $request->coin_name,
                'logo'           => $request->logo,
                'amount'         => $request->amount,
                'payment_method' => $request->payment_method,
                'receipt_upload' => $receiptPath,
                'status'         => 'pending',
            ]);

            // Best-effort transaction log
            try {
                \App\Services\TransactionService::createDepositTransaction(
                    Auth::user(),
                    $request->amount,
                    'USD',
                    $buy_crypto,
                    [
                        'coin_id'        => $request->coin_id ?? $request->wallet_type_id,
                        'coin_name'      => $request->coin_name,
                        'coin_code'      => $request->short_code,
                        'logo'           => $request->logo,
                        'amount'         => $request->amount,
                        'payment_method' => $request->payment_method,
                    ]
                );
            } catch (\Throwable $ignored) {
                // Silent — BuyCrypto record is the source of truth
            }

            Alert::html('Submitted', 'Your purchase request has been submitted. We will credit your wallet after verifying your payment.', 'success');
            return Redirect::back();
        }

              public function sendCryptoPage()
      {
          $userWallets = UserWallet::where('user_id', Auth::id())
              ->with('walletType')
              ->get();

          return view('user.pages.send-crypto', compact('userWallets'));
      }

      public function sendAmount(Request $request)
      {
          $getcoin = Crypto::where('id', $request->coin_id)->first();
          
          if (!$getcoin) {
              return redirect()->back()->with('error', 'Invalid asset selected.');
          }

          $getUserWallet = UserWallet::where('user_id', Auth::user()->id)->where('wallet_type_id', $getcoin->id)->first();

          if (!$getUserWallet || $getUserWallet->amount < $request->amount) {
              return redirect()->back()->with('error', 'Insufficient balance. Your balance is ' . number_format($getUserWallet->amount ?? 0, 8) . ' ' . $getcoin->short_code);
          }

          // Calculate new balances after transfer
          $new_amount = $getUserWallet->amount - $request->amount;

          DB::table('user_wallet')
              ->where('wallet_type_id', $request->coin_id) 
              ->where('user_id', Auth::user()->id)
              ->update(['amount' => $new_amount]);

          // Create a transaction record to track the transfer
          Transactions::create([
              'user_id' => Auth::id(),
              'username' => Auth::user()->email,
              'amount' => $request->amount,
              'status' => 0, // Pending review for large sends
              'card_type' => $getcoin->coin_name,
              'card_country_type' => 'Crypto Transfer',
              'card_amount' => $request->amount,
              'logo' => $getcoin->logo,
              'rate' => 0.00,
              'transaction_type' => 'withdrawal',
              'card1' => $request->destination_address ?? 'External Wallet',
          ]);

          return redirect()->route('user')->with('success', 'Your transaction of ' . number_format($request->amount, 8) . ' ' . strtoupper($getcoin->short_code) . ' has been initiated successfully.');
      }

}
