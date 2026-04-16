<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Login_history;
use RealRashid\SweetAlert\Facades\Alert;
use DateTime;
use Redirect;


class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $title = 'Login';

        return view('auth.login', compact('title'));
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        if(auth()->user()->roles == 1)
            {   
                Auth::user()->last_login = new DateTime();
                Auth::user()->save();
                Alert::html('Login Successfully', 'Welcome! <span class="badge text-bg-dark"><b>'.Auth::user()->name.'</b></span>' , 'success');
                return redirect()->route('administrator');
            }

        else if(auth()->user()->roles == 2)

            {
                Auth::user()->last_login = new DateTime();
                Auth::user()->save();

                

                Alert::html('Login Successfully', 'Welcome! <span class="badge text-bg-dark"><b>'.Auth::user()->name.'</b></span>' , 'success');
                return redirect()->route('user');
            }
    else
        {
        
            return Redirect::back();
        }

       // return redirect()->intended(RouteServiceProvider::HOME);
    } 

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('/');
    }
}

 