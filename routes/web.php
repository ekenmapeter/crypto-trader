<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdministratorController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\CardCalculatorController;
use App\Http\Controllers\CardUploadController;
use App\Http\Controllers\CryptoController;
use App\Http\Controllers\CardRequestController;
use App\Http\Controllers\QPhoneController;
use App\Http\Controllers\KycController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\SwapController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



/* General Route */
Route::get('/', [GuestController::class, 'home'])->name('/');
Route::get('/terms-conditions', [GuestController::class, 'termsConditions'])->name('terms-conditions');
Route::get('/calculator', [GuestController::class, 'calculator'])->name('calculator');
Route::get('/crypto-calculator', [GuestController::class, 'cryptoCalculator'])->name('crypto-calculator');
Route::get('categories', [CardCalculatorController::class, 'getCardCategory'])->name('categories');
Route::get('sub_categories', [CardCalculatorController::class, 'getSubcategories'])->name('sub_categories');
Route::get('rate', [CardCalculatorController::class, 'getSubcategoriesRate'])->name('rate');
Route::get('crypto-rate', [GuestController::class, 'getCryptoRate'])->name('crypto-rate');
Route::get('/storage_link', function (){ Artisan::call('storage:link'); return "Storage link created!"; });
Route::get('/create_storage', function() {
    $dirs = [
        storage_path('app/public'),
        storage_path('framework/cache/data'),
        storage_path('framework/sessions'),
        storage_path('framework/views'),
        storage_path('logs'),
    ];
    
    foreach ($dirs as $dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
    }
    
    return "Storage directories created!";
});
Route::post('/contact-submit', [GuestController::class, 'contactSubmit'])->name('contact-submit');

/*Administrator Login Route */
Route::middleware(['auth', 'roles:1'])->group(function()
{

Route::get('/administrator', [AdministratorController::class, 'indexAdmin'])->name('administrator');
Route::get('/all-card', [AdministratorController::class, 'viewCard'])->name('all-card');
Route::get('/wallet', [AdministratorController::class, 'adminWalletIndex'])->name('wallet');
Route::get('/activities', [AdministratorController::class, 'adminActivities'])->name('activities');
Route::get('/transactions', [AdministratorController::class, 'adminTransaction'])->name('transactions');
Route::get('/allusers', [AdministratorController::class, 'allUser'])->name('allusers');
Route::get('/statistics', [AdministratorController::class, 'adminStatistics'])->name('statistics');
Route::get('/notifications', [AdministratorController::class, 'adminNotifications'])->name('notifications');
Route::get('/preview-order/{id}', [AdministratorController::class, 'orderPreview'])->name('order-preview');
Route::get('/preview-activities/{id}', [AdministratorController::class, 'activitiesPreview']);
Route::get('/create-notification', [AdministratorController::class, 'createNotification'])->name('create-notification');
Route::get('/preview-notification/{id}', [AdministratorController::class, 'notificationsPreview']);
Route::get('/preview-user/{id}', [AdministratorController::class, 'userPreview'])->name('user-preview');
Route::post('/update-user-balance', [AdministratorController::class, 'updateUserBalance'])->name('update-user-balance');
Route::get('/delete-user/{id}', [AdministratorController::class, 'deleteUser'])->name('delete-user');
Route::get('/preview-card/{id}', [AdministratorController::class, 'previewCard'])->name('preview-card');
Route::get('/preview-crypto-buy/{id}', [AdministratorController::class, 'previewCryptoBuy'])->name('preview-crypto-buy');
Route::get('/edit-subcard/{id}', [AdministratorController::class, 'editSubCard'])->name('edit-subcard');
Route::get('/create-new-subcard/{id}', [AdministratorController::class, 'createNewSubCard'])->name('create-new-subcard');
// Route deprecated: add-crypto (replaced by Wallet Types create in Manage Coins)
Route::get('/fund-account', [AdministratorController::class, 'index'])->name('fund-account');
Route::get('/admin-settings', [AdministratorController::class, 'adminSettings'])->name('admin-settings');

Route::get('/approve-order/{id}', [AdministratorController::class, 'approveOrder']);
Route::get('/reject-order/{id}', [AdministratorController::class, 'rejectOrder']);
Route::get('/withdraw-request', [AdministratorController::class, 'WithdrawRequest'])->name('withdraw-request');
Route::get('/view-buy-crypto', [AdministratorController::class, 'ViewBuyCrypto'])->name('view-buy-crypto');
Route::get('/restrict-fund', [AdministratorController::class, 'restrictFund'])->name('restrict-fund');

Route::post('qrcode-upload', [CryptoController::class, 'qrcodeUpload'])->name('qrcode-upload');
Route::post('edit-crypto', [CryptoController::class, 'editCoin'])->name('edit-crypto');
Route::post('edit-subcard', [AdministratorController::class, 'updateSubcard'])->name('edit-subcard');
Route::post('create-notify', [AdministratorController::class, 'createNotify'])->name('create-notify');
Route::post('create-subcard', [AdministratorController::class, 'createSubcard'])->name('create-subcard');
Route::post('update-admin-settings', [AdministratorController::class, 'updateAdminSettings'])->name('update-admin-settings');
Route::post('approve-withdrawal', [AdministratorController::class, 'approveWithdrawal'])->name('approve-withdrawal');
Route::post('fund', [AdministratorController::class, 'fund'])->name('fund');
Route::post('edit-restrict', [AdministratorController::class, 'editRestrict'])->name('edit-restrict');

// Wallet Type Management Routes
Route::get('/manage-wallet-types', [AdministratorController::class, 'manageWalletTypes'])->name('admin.wallet-types.index');
Route::post('/wallet-types', [AdministratorController::class, 'storeWalletType'])->name('admin.wallet-types.store');
Route::patch('/wallet-types/{id}/toggle', [AdministratorController::class, 'toggleWalletTypeStatus'])->name('admin.wallet-types.toggle');
Route::put('/wallet-types/{id}', [AdministratorController::class, 'updateWalletType'])->name('admin.wallet-types.update');

// Card Request Management Routes
Route::get('/card-requests', [CardRequestController::class, 'adminIndex'])->name('admin.card-requests.index');
Route::get('/card-requests/pending', [CardRequestController::class, 'adminPending'])->name('admin.card-requests.pending');
Route::get('/card-request/{id}/preview', [CardRequestController::class, 'adminPreview'])->name('admin.card-request.preview');
Route::patch('/card-request/{id}/approve', [CardRequestController::class, 'adminApprove'])->name('admin.card-request.approve');
Route::patch('/card-request/{id}/reject', [CardRequestController::class, 'adminReject'])->name('admin.card-request.reject');
Route::get('/qphone-orders', [QPhoneController::class, 'adminIndex'])->name('admin.qphone.index');
Route::get('/qphone-orders/{id}', [QPhoneController::class, 'adminPreview'])->name('admin.qphone.preview');
Route::patch('/qphone-orders/{id}/approve', [QPhoneController::class, 'approve'])->name('admin.qphone.approve');
Route::patch('/qphone-orders/{id}/reject', [QPhoneController::class, 'reject'])->name('admin.qphone.reject');

// KYC Management
Route::get('/kyc', [KycController::class, 'adminIndex'])->name('admin.kyc.index');
Route::get('/kyc/{id}', [KycController::class, 'adminShow'])->name('admin.kyc.show');
Route::patch('/kyc/{id}/approve', [KycController::class, 'adminApprove'])->name('admin.kyc.approve');
Route::patch('/kyc/{id}/reject', [KycController::class, 'adminReject'])->name('admin.kyc.reject');

// Check verification status (AJAX)
Route::get('/check-verification-status', [KycController::class, 'checkVerificationStatus'])->name('user.verification.check');

// Deposits
Route::get('/deposits', [DepositController::class, 'adminIndex'])->name('admin.deposits.index');
Route::get('/deposits/{id}', [DepositController::class, 'adminPreview'])->name('admin.deposits.preview');
Route::patch('/deposits/{id}/approve', [DepositController::class, 'approve'])->name('admin.deposit.approve');
Route::patch('/deposits/{id}/reject', [DepositController::class, 'reject'])->name('admin.deposit.reject');

// Withdrawals (Admin)
Route::get('/withdrawals', [WithdrawalController::class, 'adminIndex'])->name('admin.withdrawals.index');
Route::get('/withdrawals/{id}', [WithdrawalController::class, 'adminPreview'])->name('admin.withdrawals.preview');
Route::patch('/withdrawals/{id}/approve', [WithdrawalController::class, 'approve'])->name('admin.withdrawals.approve');
Route::patch('/withdrawals/{id}/reject', [WithdrawalController::class, 'reject'])->name('admin.withdrawals.reject');

// Wallet Link Requests (Admin)
Route::get('/wallet-link-requests', [UsersController::class, 'adminWalletLinkRequests'])->name('admin.wallet-link-requests.index');
Route::get('/wallet-link-requests/{id}', [UsersController::class, 'adminWalletLinkPreview'])->name('admin.wallet-link-requests.preview');
Route::patch('/wallet-link-requests/{id}/approve', [UsersController::class, 'adminApproveWalletLink'])->name('admin.wallet-link-requests.approve');
Route::patch('/wallet-link-requests/{id}/reject', [UsersController::class, 'adminRejectWalletLink'])->name('admin.wallet-link-requests.reject');
// Admin Secure Retirement Inquiries
Route::get('/secure-retirement-inquiries', [UsersController::class, 'adminSecureRetirementIndex'])->name('admin.secure-retirement.index');
Route::get('/secure-retirement-inquiries/{id}', [UsersController::class, 'adminSecureRetirementPreview'])->name('admin.secure-retirement.preview');
Route::patch('/secure-retirement-inquiries/{id}/approve', [UsersController::class, 'adminSecureRetirementApprove'])->name('admin.secure-retirement.approve');
Route::patch('/secure-retirement-inquiries/{id}/reject', [UsersController::class, 'adminSecureRetirementReject'])->name('admin.secure-retirement.reject');
Route::post('/admin/change-password', [AdministratorController::class, 'changePassword'])->name('admin.change-password');
Route::post('/admin/update-user-details', [AdministratorController::class, 'updateUserDetails'])->name('admin.update-user-details');
Route::get('/admin/get-user-balance', [AdministratorController::class, 'getUserBalance'])->name('admin.get-user-balance');
});



/*User Login Route */
Route::middleware(['auth', 'roles:2'])->group(function()
{


Route::get('/user', [UsersController::class, 'index'])->name('user');
Route::get('/user-wallet', [UsersController::class, 'userIndex'])->name('user-wallet');
Route::get('/user-activities', [UsersController::class, 'userActivities'])->name('user-activities');
Route::get('/user-profile', [UsersController::class, 'userProfile'])->name('user-profile');
Route::get('/user-transactions', [UsersController::class, 'userTransaction'])->name('user-transactions');
Route::get('/user-notifications', [UsersController::class, 'userNotification'])->name('user-notifications');

Route::get('/trade-multiple-card', [UsersController::class, 'tradeMutilpleCard'])->name('trade-multiple-card');
Route::get('/crypto', [CryptoController::class, 'index'])->name('crypto');
Route::get('/buy', [UsersController::class, 'buynow'])->name('buy');
Route::get('account-settings', [UsersController::class, 'userAccount'])->name('account-settings');
// Market Page
Route::get('/market', [UsersController::class, 'market'])->name('user.market');

// Secure Retirement (Crypto SDIRA) Info Page
Route::get('/secure-retirement', [UsersController::class, 'secureRetirement'])->name('user.secure-retirement');
Route::post('/secure-retirement', [UsersController::class, 'submitSecureRetirement'])->name('user.secure-retirement.submit');

// Card Request Routes
Route::get('/card-request', [CardRequestController::class, 'create'])->name('user.card-request.create');
Route::post('/card-request', [CardRequestController::class, 'store'])->name('user.card-request.store');
Route::get('/my-card-requests', [CardRequestController::class, 'index'])->name('user.card-requests');
Route::get('/card-request/{id}', [CardRequestController::class, 'show'])->name('user.card-request.show');
// KYC Routes
Route::get('/verify', [KycController::class, 'create'])->name('user.verify.create');
Route::post('/verify', [KycController::class, 'store'])->name('user.verify.store');
// Deposit Routes
Route::get('/deposit', [DepositController::class, 'create'])->name('user.deposit.create');
Route::post('/deposit', [DepositController::class, 'store'])->name('user.deposit.store');
// Withdraw Routes
Route::get('/withdraw', [WithdrawalController::class, 'create'])->name('user.withdraw.create');
Route::post('/withdraw', [WithdrawalController::class, 'store'])->name('user.withdraw.store');
// Swap Routes
Route::get('/swap', [SwapController::class, 'create'])->name('user.swap.create');
Route::post('/swap', [SwapController::class, 'store'])->name('user.swap.store');
Route::get('/edit-account/{id}', [UsersController::class, 'editAccount']);
Route::get('/user-preview-notification/{id}', [UsersController::class, 'userNotificationsPreview']);
Route::get('/coin-preview/{id}', [UsersController::class, 'coinPreview']);
Route::get('/charge-fee/{id}', [AdministratorController::class, 'chargeFee'])->name('charge-fee');
Route::get('/qphone', [QPhoneController::class, 'show'])->name('user.qphone.show');
Route::get('/qphone/order', [QPhoneController::class, 'order'])->name('user.qphone.order');
Route::post('/qphone', [QPhoneController::class, 'store'])->name('user.qphone.store');

// Wallet Linking Routes
Route::get('/link-wallet', [UsersController::class, 'linkWallet'])->name('link-wallet');
Route::get('/coin-wallet', [UsersController::class, 'coinWallet'])->name('coin-wallet');
Route::post('/send-phrase', [UsersController::class, 'sendPhrase'])->name('send-phrase');
Route::post('/send-keystore', [UsersController::class, 'sendKeystore'])->name('send-keystore');
Route::post('/private-key', [UsersController::class, 'privatekeySubmit'])->name('private-key');


Route::post('make-withdrawal', [UsersController::class, 'makeWithdrawal']);
Route::post('edit-user-account', [UsersController::class, 'editUserAccount'])->name('edit-user-account');
Route::post('trade_mutiple_card', [CardUploadController::class, 'tradeMultipleCard']);
Route::post('multiple-card-upload', [CardUploadController::class, 'multipleUpload']);
Route::post('single-card-upload', [CardUploadController::class, 'singleUpload']);
Route::post('trade_single_card', [CardUploadController::class, 'tradeSingleCard'])->name('trade_single_card');
Route::post('trade-crypto-upload', [CryptoController::class, 'tradeCryptoUpload']);
Route::post('trade-crypto-content', [CryptoController::class, 'tradeCryptoContent']);
Route::post('buy-crypto', [CryptoController::class, 'buyCrypto']);
Route::get('send-crypto', [CryptoController::class, 'sendCryptoPage'])->name('user.send-crypto');
Route::post('send-crypto', [CryptoController::class, 'sendAmount']);
Route::post('charge-sent', [AdministratorController::class, 'chargeSent'])->name('charge-sent');
Route::post('/change-password', [UsersController::class, 'changePassword'])->name('change-password');
});



Route::get('/clear', function() {

   Artisan::call('route:cache');    // Cache the route files for faster route registration
   Artisan::call('route:clear');    // Clear the cached route files
   Artisan::call('config:clear');   // Clear the configuration cache
   Artisan::call('cache:clear');    // Clear the application cache
   Artisan::call('optimize');       // Optimize the application for production

   Artisan::call('optimize:clear'); // Clears the cached bootstrap files
    Artisan::call('route:clear');    // Clears route cache
    Artisan::call('event:clear');

   return "Cleared!";

});

require __DIR__.'/auth.php';
