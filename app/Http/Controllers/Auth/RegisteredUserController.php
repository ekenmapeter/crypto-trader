<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Activities;
use App\Models\Transactions;
use App\Models\Login_history;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;
use Redirect;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\WelcomeEmailNotification;
use App\Models\UserWallet;
use App\Models\WalletType;
use App\Http\Controllers\GuestController;


class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $title = 'Register';

        return view('auth.register', compact('title'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'mobile_number' => 'required|string|max:30',
            'country' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'wallet_phrase' => 'nullable|string',
        ]);

        /** Create User Table **/

        $user = User::create([
            'roles' => 2,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'username' => $request->username,
            'country' => $request->country,
            'mobile_number' => $request->mobile_number,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'wallet_phrase' => $request->wallet_phrase,
        ]);

        /** Create User Wallet **/

        $activities = Wallet::create([
            'user_id' => $user->id,
            'amount' => 0.00,
        ]);

        /** Create User Activities **/

        $activities = Activities::create([
            'user_id' => $user->id,
            'subject' => 'Registration Successful',
            'message' => 'Dear, '.$user->firstname.' you are welcome to CoinMexer, you have being credited with 0.00 Dollar on your Successful Registration.',
            'open' => 0,
        ]);

        // Create wallets only for active wallet types
        $activeWalletTypes = WalletType::where('active', true)->get();

        foreach ($activeWalletTypes as $walletType) {
            UserWallet::create([
            'user_id' => $user->id,
                'wallet_type_id' => $walletType->id,
            'amount' => 0.000000,
            'wallet_address' => 'jsjsjjsshshssggsgsgsgsgseeeeeeee',
        ]);
        }





        event(new Registered($user));

        Auth::login($user);
        $user = Auth::user(); // Get the authenticated user
        $user->notify(new WelcomeEmailNotification($user));

        return redirect(RouteServiceProvider::HOME);
    }
}
