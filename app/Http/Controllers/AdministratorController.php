<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use App\Models\Withdrawal;
use App\Models\Transactions;
use App\Models\Notifications;
use App\Models\CardCategory;
use App\Models\Crypto;
use App\Models\CardSubCategories;
use App\Models\BuyCrypto;
use App\Models\CardSubCategoriesRate;
use App\Models\Activities;
use App\Models\Wallet;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;
use Redirect;
use App\Notifications\ApprovalEmailNotification;
use App\Notifications\DeclineEmailNotification;
use App\Models\UserWallet;
use App\Models\WalletType;
use App\Models\Verification;
use App\Models\WalletLinkRequest;
use App\Models\CardRequest;
use App\Models\QPhoneOrder;
use App\Models\Deposit;
use App\Models\AdminSetting;
class AdministratorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $title = 'Admin Dashboard';

        // Basic stats
        $totalUsers = User::all()->count();
        $totalTransactions = Transactions::all()->count();
        $pendingTransactions = Transactions::all()->where('status', 0)->count();
        $completeTransactions = Transactions::all()->where('status', 1)->count();
        $canceledTransactions = Transactions::all()->where('status', 2)->count();
        $activeCoins = WalletType::where('active', true)->count();
        $totalCoins = WalletType::count();

        // Additional stats for comprehensive dashboard
        $pendingKyc = Verification::where('status', 'pending')->count();
        $pendingWalletLinks = WalletLinkRequest::where('status', 'pending')->count();
        $pendingCardRequests = CardRequest::where('status', 'pending')->count();
        $pendingQPhoneOrders = QPhoneOrder::where('status', 'pending')->count();
        $pendingDeposits = Deposit::where('status', 'pending')->count();
        $pendingWithdrawals = Withdrawal::where('status', 0)->count();

        // Recent transactions for dashboard
        $recentTransactions = Transactions::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        $transactionsTable = Transactions::orderBy('created_at','desc')->paginate(5);

        return view('admin.admin-dashboard', compact(
            'title',
            'totalTransactions',
            'pendingTransactions',
            'canceledTransactions',
            'completeTransactions',
            'totalUsers',
            'transactionsTable',
            'activeCoins',
            'totalCoins',
            'pendingKyc',
            'pendingWalletLinks',
            'pendingCardRequests',
            'pendingQPhoneOrders',
            'pendingDeposits',
            'pendingWithdrawals',
            'recentTransactions'
        ));
    }


    public function adminTransaction()
    {
        $title = 'All Transactions';


    $totalUsers = User::all()->count();
    $totalTransactions = Transactions::all()->count();
    $pendingTransactions = Transactions::all()->where('status', 0)->count();
    $completeTransactions = Transactions::all()->where('status', 1)->count();
    $canceledTransactions = Transactions::all()->where('status', 2)->count();

    $transactionsTable= Transactions::orderBy('created_at','desc')->paginate(10);

    return view('admin.pages.all-transaction', compact('title','totalTransactions','pendingTransactions','canceledTransactions','completeTransactions','totalUsers','transactionsTable'));
    }


    public function adminActivities()
    {
        $title = 'All Activities';


    $totalActivities = Activities::where('user_id', 1)->count();

    $activitiesTable= Activities::where('user_id', 1)->orderBy('created_at','desc')->paginate(10);

    return view('admin.pages.all-activities', compact('title','totalActivities','activitiesTable'));
    }


    public function adminNotifications()
    {
        $title = 'All Notification';


    $totalNotofication = Notifications::all()->count();

    $notificationTable= Notifications::orderBy('created_at','desc')->paginate(10);

    return view('admin.pages.notification', compact('title','totalNotofication','notificationTable'));
    }


    public function viewCard()
    {
        $title = 'Card Section';


        $cardCategory = DB::table('card_categories')->paginate(10);

        $cardCategoryall = DB::table('card_categories')
            ->join('card_sub_categories', 'card_sub_categories.card_id', '=', 'card_categories.id')
            ->join('card_sub_categories_rate', 'card_sub_categories_rate.card_id_id', '=', 'card_sub_categories.card_id')->get();

    return view('admin.pages.view-card', compact('cardCategory'));
    }


    public function previewCard(Request $request , $id)
    {

    $title = 'Preview Card';

    $previewCard = DB::table('card_categories')
            ->join('card_sub_categories', 'card_sub_categories.card_id', '=', 'card_categories.id')
            ->where('card_sub_categories.card_id', '=', $id)->get();

     $subId =  $id;

    return view('admin.pages.preview-card', compact('title','previewCard','subId'));

    }


    public function editSubCard($id)
    {

    $title = 'Preview Sub Card';

    $editCard = DB::table('card_sub_categories')
            ->where('id', '=', $id)->first();


    return view('admin.pages.edit-subcard', compact('title','editCard'));

    }


    public function createNewSubCard($id)
    {

    $title = 'Create Sub Card';
    $cardID = DB::table('card_categories')->where('id', '=', $id)->first();

    $subId =  $id;
    return view('admin.pages.create-subcard', compact('title','cardID','subId'));

    }


    public function createNotification()
    {
        $title = 'Create Notification';


    return view('admin.pages.create-notification');
    }


    public function allUser()
    {
        $title = 'All Users';

        $totalUsers = User::all()->count();

        $usersTable= User::orderBy('created_at','desc')->paginate(10);


    return view('admin.pages.all-users', compact('totalUsers','usersTable','title'));
    }


    public function createNotify(Request $request)
    {
        $totalNotofication = Notifications::all()->count();
        $notificationTable= Notifications::orderBy('created_at','desc')->paginate(10);


        $notification = Notifications::create([
            'subject' => $request->subject,
            'message' => $request->message,
            'open' => 0,
        ]);

        Alert::html('Successful', 'Notifications has being sent to all your users' , 'success');
    return redirect()->route('notifications', compact('totalNotofication','notificationTable'));
    }

    public function createSubcard(Request $request)
    {

        $createSubcard = CardSubCategories::create([
            'card_id' => $request->card_id,
            'card_logo' => $request->card_logo,
            'card_name' => $request->card_name,
            'card_country_name' => $request->card_country_name,
            'card_country_rate' => $request->card_country_rate,
        ]);

        $createSubcardRate = CardSubCategoriesRate::create([

            'card_id' => $request->card_id,
            'card_id_id' => $createSubcard->id,
            'card_country_name' => $request->card_country_name,
            'rate' => $request->card_country_rate,
        ]);

        Alert::html('Successful', 'Sub Card Category has being created' , 'success');
    return redirect()->route('all-card');
    }

    public function updateSubcard(Request $request)
    {


    $editSubCard = CardSubCategories::find($request->id);


        CardSubCategories::where('id', $request->id)->update([

            'card_country_name' => $request->card_country_name,
            'card_country_rate' => $request->card_country_rate

        ]);

        CardSubCategoriesRate::where('card_id_id', $request->id)->update([

            'card_id_id' => $request->card_id,
            'card_country_name' => $request->card_country_name,
            'rate' => $request->card_country_rate

        ]);




        Alert::html('Successful', 'Card has being updated' , 'success');

    return redirect()->back();

    }


    public function userPreview($id)
    {

    $title = 'Preview User';

    $previewUser = DB::table('users')->where('id', $id)->first();
    $userWallets = UserWallet::where('user_id', $id)->with('walletType')->get();
    return view('admin.pages.preview-user', compact('title','previewUser', 'userWallets'));

    }

    public function updateUserBalance(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'wallet_type_id' => 'required|exists:wallet_type,id',
            'amount' => 'required|numeric'
        ]);

        $wallet = UserWallet::firstOrCreate(
            ['user_id' => $request->user_id, 'wallet_type_id' => $request->wallet_type_id],
            ['amount' => 0, 'wallet_address' => 'default_address']
        );

        $wallet->amount = $request->amount;
        $wallet->save();

        Alert::success('Success', 'User balance updated successfully!');
        return redirect()->back();
    }

    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            Alert::error('Error', 'User not found');
            return redirect()->back();
        }

        $username = $user->username;

        try {
            DB::beginTransaction();

            // 1. Cleanup Files from KYC Verifications
            $verifications = DB::table('user_verifications')->where('user_id', $id)->get();
            foreach ($verifications as $v) {
                $docs = DB::table('verification_documents')->where('verification_id', $v->id)->get();
                foreach ($docs as $doc) {
                    if ($doc->path) {
                        Storage::disk('public')->delete($doc->path);
                    }
                }
                DB::table('verification_documents')->where('verification_id', $v->id)->delete();
            }
            DB::table('user_verifications')->where('user_id', $id)->delete();

            // 2. Cleanup Files from Deposits (Payment Proofs)
            $deposits = DB::table('deposits')->where('user_id', $id)->get();
            foreach ($deposits as $d) {
                if ($d->payment_proof) {
                    Storage::disk('public')->delete($d->payment_proof);
                }
            }
            DB::table('deposits')->where('user_id', $id)->delete();

            // 3. Cleanup Files from Buy Crypto (Receipts)
            $buys = DB::table('buy_crypto')->where('user_id', $id)->get();
            foreach ($buys as $b) {
                if ($b->receipt_upload) {
                    $path = str_replace('/storage/', '', $b->receipt_upload);
                    Storage::disk('public')->delete($path);
                }
            }
            DB::table('buy_crypto')->where('user_id', $id)->delete();

            // 4. Cleanup Files from Crypto Receipts
            $receipts = DB::table('crypto_receipt')->where('user_id', $id)->get();
            foreach ($receipts as $r) {
                if ($r->receipt_upload) {
                    $path = str_replace('/storage/', '', $r->receipt_upload);
                    Storage::disk('public')->delete($path);
                }
            }
            DB::table('crypto_receipt')->where('user_id', $id)->delete();

            // 5. Spatie Media Library Cleanup
            foreach ($user->getMedia() as $media) {
                $media->delete();
            }

            // 6. Delete other associated database records
            $tables = [
                'activities', 
                'card_requests', 
                'messages', 
                'notifications', 
                'q_phone_orders', 
                'qphone_orders', 
                'secure_retirement_inquiries', 
                'swaps', 
                'transactions', 
                'user_wallet', 
                'wallets', 
                'wallet_link_requests', 
                'withdrawals',
                'sessions'
            ];

            foreach ($tables as $table) {
                if (Schema::hasTable($table)) {
                    DB::table($table)->where('user_id', $id)->delete();
                }
            }

            // 10. Delete User Record
            $user->delete();

            // Log Admin Activity
            Activities::create([
                'user_id' =>  Auth::id(),
                'subject' => 'Account Deleted',
                'open' => '0',
                'message' => 'You deleted '.$username.' (ID: '.$id.'), and all associated data/files to save space.',
            ]);

            DB::commit();
            Alert::success('User Deleted', $username . ' and all associated data have been permanently removed.');
        } catch (\Exception $e) {
            DB::rollback();
            Alert::error('Deletion Failed', 'Error: ' . $e->getMessage());
        }

        return redirect()->route('allusers');
    }

    public function notificationsPreview($id)
    {

    $title = 'Preview Notification';

    $previewNotification = DB::table('notifications')->where('id', $id)->first();
    return view('admin.pages.preview-notification', compact('title','previewNotification'));

    }



    public function activitiesPreview($id)
    {

    $title = 'Preview Activities';

    $previewActivities = DB::table('activities')->where('id', $id)->first();
    return view('admin.pages.preview-activities', compact('title','previewActivities'));

    }



     public function orderPreview($id)
    {
    $title = 'Preview Transactions';

    $previewTransaction = DB::table('transactions')->where('id', $id)->first();
    return view('admin.pages.preview-transaction', compact('title','previewTransaction'));

    }


    public function approveOrder($id)
    {

    $approveOrder = Transactions::find($id);



        $transactionAmount = $approveOrder->amount;
        Transactions::where('id', $id)->update(['status' => 1]);
        Wallet::where('user_id', $approveOrder->user_id)->increment('amount', $transactionAmount);
        /** Update User Wallet **/

        /** Create User Activities **/

        $activities = Activities::create([
            'user_id' => $approveOrder->user_id,
            'subject' => 'Transaction Successful',
            'message' => 'Dear '.$approveOrder->username.', your transaction with the ID '.$approveOrder->id.' and amount '.$approveOrder->amount.'  has being approved, you will be credited shortly',
            'open' => 0,
        ]);


        if ($approveOrder->transaction_type === 'Charge Fee') {
    // Update the record
    DB::table('user_wallet')
        ->where('wallet_type_id', $approveOrder->card_type)
        ->where('user_id', $approveOrder->user_id)
        ->update(['restrict_fee' => 1]);

    // Fetch the updated record
    $access = DB::table('user_wallet')
        ->where('wallet_type_id', $approveOrder->card_type)
        ->where('user_id', $approveOrder->user_id)
        ->first();
} else {
    // Handle the case where it's not 'Charge Fee'
}



        // Dispatch the ApprovalEmailNotification
        $user = User::find($approveOrder->user_id);
        $approveOrder = Transactions::find($id);
    $user->notify(new ApprovalEmailNotification($activities, $approveOrder));


        Alert::html('Successful', 'Transactions has being approved' , 'success');

    return redirect()->back();

    }


    public function rejectOrder($id)
    {

    $rejectOrder = Transactions::find($id);

        Transactions::where('id', $id)->update(['status' => 2]);

        Wallet::where('id', $rejectOrder->user_id)->update(['amount' => $rejectOrder->amount]);
        /** Update User Wallet **/

        /** Create User Activities **/

        $activities = Activities::create([
            'user_id' => $rejectOrder->user_id,
            'subject' => 'Card Transaction Rejected',
            'message' => 'Dear '.$rejectOrder->username.', Your card transaction with the ID '.$rejectOrder->id.' and amount '.$rejectOrder->amount.' has being rejected, please check your card and try again',
            'open' => 0,
        ]);

        $user = User::find($rejectOrder->user_id);
        $rejectOrder = Transactions::find($id);
        $user->notify(new DeclineEmailNotification($activities, $rejectOrder));
        Alert::html('Successful', 'Transactions has being rejected' , 'danger');

    return redirect()->back();

    }

     public function WithdrawRequest()
  {
    $title = 'Withdarw Request';

    $notificationSidebar = Notifications::count();
    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);

    $withdrawal_list = Withdrawal::orderBy('created_at', 'desc')->paginate(10);

    return view('admin.pages.withdraw-request', compact('title','withdrawal_list','notificationSidebar','notification'));
  }

  public function approveWithdrawal(Request $request)
  {

   $getUserWallet = Wallet::where('user_id', $request->user_id)->first();

        Withdrawal::where('id', $request->id)->update(['status' => 1]);
        Wallet::where('user_id', $getUserWallet->user_id)->decrement('amount', $request->amount);

        $Activities = Activities::create([
            'user_id' => 1,
            'subject' => 'Withdraw Request Approved',
            'open' => '0',
            'message' => 'You approved a request to withdrawal the sum of $'.$request->amount.' from '.$request->username.' to the following details'.$request->bank_name.', '.$request->account_name.', '.$request->account_number.'.'
        ]);

        $Activities = Activities::create([
            'user_id' => $request->user_id,
            'subject' => 'Withdraw Approved',
            'open' => '0',
            'message' => 'You request to withdrawal the sum of $'.$request->amount.' to the following details'.$request->bank_name.', '.$request->account_name.', '.$request->account_number.' has being Approve. You will get your money with 20 Minutes. Thanks for using our platform',
        ]);

        Alert::html('Successful', 'Your approval of $'.$request->amount.' from '.$request->username.' was successful' , 'success');
        return redirect()->back();

  }

   public function ViewBuyCrypto()
  {
    $title = 'View Buy Crypto';

    $notificationSidebar = Notifications::count();
    $notification = Notifications::orderBy('created_at', 'desc')->paginate(5);

    $view_buy_crypto = BuyCrypto::orderBy('created_at', 'desc')->paginate(10);

    return view('admin.pages.view-buy-crypto', compact('title','view_buy_crypto','notificationSidebar','notification'));
  }

  public function previewCryptoBuy($id)
    {

    $title = 'Preview Crypto Buy';

    $previewCryptoBuy = DB::table('buy_crypto')->where('id', $id)->first();
    return view('admin.pages.preview-crypto-buy', compact('title','previewCryptoBuy'));

    }

    public function index()
    {
        $title = 'Fund Account';
        
        // Use WalletType instead of Crypto for funding
        $getcoin = WalletType::orderBy('coin_name')
            ->get()
            ->map(function($coin) {
                // Calculate total circulation for this coin type
                $coin->total_balance = DB::table('user_wallet')
                    ->where('wallet_type_id', $coin->id)
                    ->sum('amount');
                return $coin;
            });

        $getuser = User::orderBy('created_at', 'desc')->get();

        return view('admin.pages.fund-account', compact('title', 'getcoin', 'getuser'));
    }

    public function fund(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,id',
            'crypto' => 'required|exists:wallet_type,id',
            'amount' => 'required|numeric|min:0',
        ]);

        $userId = $request->email;
        $walletTypeId = $request->crypto;
        $usdAmount = $request->amount;

        $targetUser = User::find($userId);
        $coin = WalletType::find($walletTypeId);

        // Fetch current price to convert USD to Crypto
        $cryptoAmount = 0;
        try {
            $response = \Illuminate\Support\Facades\Http::get("https://min-api.cryptocompare.com/data/price?fsym={$coin->short_code}&tsyms=USD");
            $priceData = $response->json();
            $price = $priceData['USD'] ?? 0;
            
            if ($price > 0) {
                $cryptoAmount = $usdAmount / $price;
            } else {
                return redirect()->back()->with('error', 'Could not fetch current price for ' . $coin->short_code);
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Price calculation failed. Please try again.');
        }

        // Ensure wallet exists for this specific user and coin
        UserWallet::firstOrCreate(
            ['user_id' => $userId, 'wallet_type_id' => $walletTypeId],
            ['amount' => 0]
        );

        // Increment balance with converted crypto amount
        UserWallet::where('user_id', $userId)
            ->where('wallet_type_id', $walletTypeId)
            ->increment('amount', $cryptoAmount);

        // Log Activity
        Activities::create([
            'user_id' => Auth::id(),
            'subject' => 'Account Funded',
            'open' => 0,
            'message' => 'You credited ' . number_format($cryptoAmount, 8) . ' ' . $coin->short_code . ' (Value: $' . number_format($usdAmount, 2) . ') to user: ' . $targetUser->username,
        ]);

        Alert::success('Successful', 'Fund of $'.number_format($usdAmount, 2).' to '.$targetUser->email.' was successful');
        return redirect()->back();
    }



    public function restrictFund()
        {

        $title = 'Restrict Fund';
        $getcoin = WalletType::where('active', true)->orderBy('coin_name')->paginate(20);
        $getuser = User::orderBy('created_at', 'desc')->get();

        return view('admin.pages.restrict-fund', compact('title','getcoin','getuser'));

        }

        public function editRestrict(Request $request)
        {

        WalletType::where('id', $request->crypto)->update(['restrict' => $request->amount]);

        Alert::html('Successful', 'Coin charge changed successfully' , 'success');
        return redirect()->back();

        }

        public function chargeFee($id)
        {
            $getcrypto = Crypto::where('id', $id)->first();
          $coin = WalletType::where('id', $getcrypto->id)->first();

        $title = 'Pay Transfer Charge';

        return view('user.pages.charge-fee', compact('title','coin', 'getcrypto'));

        }

        public function chargeSent(Request $request)
{
   $request->validate([
    'amount' => 'required|numeric|between:0.00000001,99999999.99999999', // Adjust the range as needed.
]);


    $getcoin = Crypto::where('id', $request->crypto)->first();

    // Create the transaction only if the validation passes.
    $transactions_create = Transactions::create([
        'user_id' => Auth::id(),
        'username' => Auth::user()->email,
        'amount' => $request->amount,
        'status' => 0,
        'card_type' => $request->crypto,
        'logo' => $getcoin->logo,
        'transaction_type' => 'Charge Fee',
    ]);

    Alert::success('Successful', 'You can also contact Customer Care for assistance');

    return redirect()->back();
}

/**
 * Display all wallet types for admin management
 */
public function manageWalletTypes()
{
    $title = 'Manage Wallet Types';
    $walletTypes = WalletType::orderByDesc('active')
        ->orderBy('coin_name')
        ->paginate(10);

    return view('admin.pages.manage-wallet-types', compact('title', 'walletTypes'));
}

/**
 * Store a newly created wallet type
 */
public function storeWalletType(Request $request)
{
    $request->validate([
        'coin_name' => 'required|string|max:255',
        'short_code' => 'required|string|max:10|unique:wallet_type,short_code',
        'active' => 'required|boolean',
        'payment_wallet_address' => 'nullable|string|max:255',
        'payment_qr_code' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'payment_instructions' => 'nullable|string|max:1000',
    ]);

    $qrCodePath = null;
    if ($request->hasFile('payment_qr_code')) {
        $qrCodeFile = $request->file('payment_qr_code');
        $qrCodeName = time() . '_' . $qrCodeFile->getClientOriginalName();
        $qrCodeFile->move(public_path('images/crypto_logo'), $qrCodeName);
        $qrCodePath = $qrCodeName;
    }

    $logoPath = null;
    if ($request->hasFile('logo')) {
        $logoFile = $request->file('logo');
        $logoName = time() . '_' . $logoFile->getClientOriginalName();
        $logoFile->move(public_path('images/crypto_logo'), $logoName);
        $logoPath = $logoName;
    }

    WalletType::create([
        'coin_name' => $request->coin_name,
        'short_code' => $request->short_code,
        'active' => $request->active,
        'payment_wallet_address' => $request->payment_wallet_address,
        'payment_qr_code' => $qrCodePath,
        'logo' => $logoPath,
        'payment_instructions' => $request->payment_instructions,
    ]);

    Alert::success('Success', 'New coin added successfully!');
    return redirect()->route('admin.wallet-types.index');
}

/**
 * Toggle wallet type active status
 */
public function toggleWalletTypeStatus($id)
{
    $walletType = WalletType::findOrFail($id);
    $walletType->active = !$walletType->active;
    $walletType->save();

    $status = $walletType->active ? 'activated' : 'deactivated';
    Alert::success('Success', 'Coin ' . $walletType->coin_name . ' has been ' . $status);

    return redirect()->back();
}

/**
 * Update wallet type details
 */
public function updateWalletType(Request $request, $id)
{
    $request->validate([
        'coin_name' => 'required|string|max:255',
        'short_code' => 'required|string|max:10',
        'active' => 'required|boolean',
        'payment_wallet_address' => 'nullable|string|max:255',
        'payment_qr_code' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        'payment_instructions' => 'nullable|string|max:1000',
    ]);

    $walletType = WalletType::findOrFail($id);

    // Handle QR code upload
    if ($request->hasFile('payment_qr_code')) {
        // Delete old QR code if exists
        if ($walletType->payment_qr_code && file_exists(public_path('images/crypto_logo/' . $walletType->payment_qr_code))) {
            unlink(public_path('images/crypto_logo/' . $walletType->payment_qr_code));
        }

        $qrCodeFile = $request->file('payment_qr_code');
        $qrCodeName = time() . '_' . $qrCodeFile->getClientOriginalName();
        $qrCodeFile->move(public_path('images/crypto_logo'), $qrCodeName);
        $qrCodePath = $qrCodeName;
    } else {
        $qrCodePath = $walletType->payment_qr_code;
    }

    // Handle logo upload
    if ($request->hasFile('logo')) {
        if ($walletType->logo && file_exists(public_path('images/crypto_logo/' . $walletType->logo))) {
            unlink(public_path('images/crypto_logo/' . $walletType->logo));
        }
        
        $logoFile = $request->file('logo');
        $logoName = time() . '_' . $logoFile->getClientOriginalName();
        $logoFile->move(public_path('images/crypto_logo'), $logoName);
        $logoPath = $logoName;
    } else {
        $logoPath = $walletType->logo;
    }

    $walletType->update([
        'coin_name' => $request->coin_name,
        'short_code' => $request->short_code,
        'active' => $request->active,
        'payment_wallet_address' => $request->payment_wallet_address,
        'payment_qr_code' => $qrCodePath,
        'logo' => $logoPath,
        'payment_instructions' => $request->payment_instructions,
    ]);

    Alert::success('Success', 'Wallet type updated successfully!');
    return redirect()->back();
}

public function adminSettings()
{
    $title = 'Admin Settings';
    $setting = AdminSetting::first();
    return view('admin.pages.admin-settings', compact('title', 'setting'));
}

public function updateAdminSettings(Request $request)
{
    $request->validate([
        'admin_email' => 'nullable|email',
        'site_name' => 'nullable|string|max:255',
        'support_email' => 'nullable|email',
        'bank_name' => 'nullable|string|max:255',
        'account_name' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:255',
        'routing_number' => 'nullable|string|max:255',
        'paypal_email' => 'nullable|email'
    ]);

    $setting = AdminSetting::first();
    $data = [
        'admin_email' => $request->admin_email,
        'site_name' => $request->site_name,
        'support_email' => $request->support_email,
        'bank_name' => $request->bank_name,
        'account_name' => $request->account_name,
        'account_number' => $request->account_number,
        'routing_number' => $request->routing_number,
        'paypal_email' => $request->paypal_email,
    ];

    if (!$setting) {
        AdminSetting::create($data);
    } else {
        $setting->update($data);
    }

    Alert::success('Success', 'Settings updated successfully!');
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

        Alert::success('Success', 'Admin password changed successfully!');
        return redirect()->back();
    }

    public function updateUserDetails(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:users,id',
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$request->id,
            'email' => 'required|string|email|max:255|unique:users,email,'.$request->id,
            'password' => 'nullable|string|min:8',
        ]);

        $user = User::find($request->id);
        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->username = $request->username;
        $user->email = $request->email;
        
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        
        $user->save();

        // Log Activity for Admin
        Activities::create([
            'user_id' => Auth::id(),
            'subject' => 'User Updated',
            'open' => 0,
            'message' => 'You updated details for user: '.$user->username.' (ID: '.$user->id.')',
        ]);

        // Log Activity for User
        Activities::create([
            'user_id' => $user->id,
            'subject' => 'Profile Updated by Admin',
            'open' => 0,
            'message' => 'Admin has updated your profile details.',
        ]);

        Alert::success('Success', 'User details updated successfully!');
        return redirect()->back();
    }

    public function getUserBalance(Request $request)
    {
        $userId = $request->user_id;
        $walletTypeId = $request->wallet_type_id;

        $wallet = \App\Models\UserWallet::where('user_id', $userId)
            ->where('wallet_type_id', $walletTypeId)
            ->first();

        return response()->json([
            'balance' => $wallet ? (float)$wallet->amount : 0
        ]);
    }
}
