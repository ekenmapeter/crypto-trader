<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Crypto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */

    public function home()
    {

        $title = 'Home';

        return view('welcome', compact('title'));
    }
    
    public function termsConditions()
    {

        $title = 'Terms Conditions';

        return view('guest.terms-conditions', compact('title'));
    }



    public function getCryptoRate(Request $request)
    {

        $crypto = Crypto::findOrFail($request->id);
        $get_rate = $crypto->coin_rate;
       
        return $get_rate;
       

    }
    
    public function getCardCategory()
    {
        $categories = DB::table('card_categories')->get();
 
        return $categories;
    }

    public function getCrypto()
    {
        $get_crypto = DB::table('crypto')->get();
 
        return $get_crypto;
    }
 

    public function calculator()
    {

        $title = 'Gift Card Calculator';

        $categories = $this->getCardCategory();

        return view('calculator', compact('title', 'categories'));
    }

    
    public function cryptoCalculator()
    {

        $title = 'Crypto Calculator';

        $get_crypto = $this->getCrypto();

        return view('crypto-calculator', compact('title', 'get_crypto'));
    }

    public function contactSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $adminEmail = \App\Models\AdminSetting::first()?->admin_email ?? 'admin@example.com';
        
        \Illuminate\Support\Facades\Log::info('Attempting to send contact mail to: ' . $adminEmail);
        
        \Illuminate\Support\Facades\Mail::to($adminEmail)->send(new \App\Mail\ContactMessage($request->all()));

        return response()->json(['status' => 'success', 'message' => 'Your message has been sent successfully.']);
    }

} 