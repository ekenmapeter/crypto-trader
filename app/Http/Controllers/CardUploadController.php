<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\CardCategory;
use App\Models\Transactions;
use App\Models\Activities;
use RealRashid\SweetAlert\Facades\Alert;
use Redirect;
use App\Notifications\ActivityEmailNotification;



class CardUploadController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    // Trade Single Card
         public function singleUpload(Request $request)
    {
                if ($request->hasFile('singlecard_upload')) {
                $id = Auth::id();
                $file1 = $request->file('singlecard_upload');
                $filename1 = Str::random(15) . '.' . $file1->extension();
        
                // Use the 'public' disk to store the file with a custom filename
                $dib_requestPath1 = $file1->storePubliclyAs('public/'.$id.'/cards_folder', $filename1);
        
                $updated_at = time();
                return $dib_requestPath1;
            } else {
                return 'No file uploaded.';
            }
      
    } 


    public function tradeSingleCard(Request $request)
    {
        

        $cat_id = $request->card_sub_categories;
        $re_get_card_type = DB::table('card_sub_categories')->where('id', $cat_id)->get('card_name');
        $re_get_card_country_type = DB::table('card_sub_categories')->where('id', $cat_id)->get('card_country_name');
        $re_get_card_logo = DB::table('card_sub_categories')->where('id', $cat_id)->get('card_logo');
         $get_card_type = json_decode($re_get_card_type, true);
         $get_card_country_type = json_decode($re_get_card_country_type, true);
         $get_card_logo = json_decode($re_get_card_logo, true);

        $transactions_create = Transactions::create([
            'user_id' => Auth::id(),
            'logo' =>  $get_card_logo[0]['card_logo'],
            'username' => Auth::user()->username,
            'amount' => $request->sum,
            'status' => 0,
            'card_type' => $get_card_type[0]['card_name'],
            'card_country_type' => $get_card_country_type[0]['card_country_name'],
            'card_amount' => $request->value1,
            'rate' => $request->rate,
            'transaction_type' => 'GiftCard',
            'card1' => $request->singlecard_upload,
        ]);

        Auth::user()->save();
        Alert::html('Successful', 'Your transaction was successful, you can review your transaction staus in 15mins' , 'success');
       
        
        return Redirect::back();
        
    }

    // End Trade Single Card




    // Trade Mutiple Card
   
        public function multipleUpload(Request $request)
    {
        if ($request->hasFile('image_url_1')) {
        $filename1 = time().$request->file('image_url_1')->getClientOriginalName();
        $path = $request->file('image_url_1')->storeAs('upload', $filename1, 'public');
        $fullpath = '/storage/'.$path;
        $updated_at = time();
        return $fullpath;
    }

        if($request->has('image_url_2')){

            $filename2 = time().$request->file('image_url_2')->getClientOriginalName();
            $path2 = $request->file('image_url_2')->storeAs('upload', $filename2, 'public');
            $fullpath2 = '/storage/'.$path2;
            $updated_at = time();
            return $fullpath2;
        }

        if($request->has('image_url_3')){

            $filename3 = time().$request->file('image_url_3')->getClientOriginalName();
            $path3 = $request->file('image_url_3')->storeAs('upload', $filename3, 'public');
            $fullpath3 = '/storage/'.$path3;
            $updated_at = time();
            return $fullpath3;

        }

        if($request->has('image_url_4')){

            $filename4 = time().$request->file('image_url_4')->getClientOriginalName();
            $path4 = $request->file('image_url_4')->storeAs('upload', $filename4, 'public');
            $fullpath4 = '/storage/'.$path4;
            $updated_at = time();
            return $fullpath4;

        }

        if($request->has('image_url_5')){

            $filename5 = time().$request->file('image_url_5')->getClientOriginalName();
            $path5 = $request->file('image_url_5')->storeAs('upload', $filename5, 'public');
            $fullpath5 = '/storage/'.$path5;
            $updated_at = time();
            return $fullpath5;

       }

        if ($request->has('image_url_6')) {

            $filename6 = time().$request->file('image_url_6')->getClientOriginalName();
            $path6 = $request->file('image_url_6')->storeAs('upload', $filename6, 'public');
            $fullpath6 = '/storage/'.$path6;
            $updated_at = time();
            return $fullpath6;
        }

        if($request->has('image_url_7')){

            $filename7 = time().$request->file('image_url_7')->getClientOriginalName();
            $path7 = $request->file('image_url_7')->storeAs('upload', $filename7, 'public');
            $fullpath7 = '/storage/'.$path7;
            $updated_at = time();
            return $fullpath7;
        }

        if($request->has('image_url_8')){

            $filename8 = time().$request->file('image_url_8')->getClientOriginalName();
            $path8 = $request->file('image_url_8')->storeAs('upload', $filename8, 'public');
            $fullpath8 = '/storage/'.$path8;
            $updated_at = time();
            return $fullpath8;

        }

        if($request->has('image_url_9')){

            $filename9 = time().$request->file('image_url_9')->getClientOriginalName();
            $path9 = $request->file('image_url_9')->storeAs('upload', $filename9, 'public');
            $fullpath9 = '/storage/'.$path9;
            $updated_at = time();
            return $fullpath9;

        }

        if($request->has('image_url_10')){

            $filename10 = time().$request->file('image_url_10')->getClientOriginalName();
            $path10 = $request->file('image_url_10')->storeAs('upload', $filename10, 'public');
            $fullpath10 = '/storage/'.$path10;
            $updated_at = time();
            return $fullpath10;

        }else{

            return 'Something happen';
        }
            
    }



    public function tradeMultipleCard(Request $request)
    {
           
        $get_logo = CardCategory::findOrFail($request->card_categories);
     
        $cat_id = $request->card_sub_categories;
        $re_get_card_type = DB::table('card_sub_categories')->where('id', $cat_id)->get('card_name');
        $re_get_card_country_type = DB::table('card_sub_categories')->where('id', $cat_id)->get('card_country_name');
        $re_get_card_logo = DB::table('card_sub_categories')->where('id', $cat_id)->get('card_logo');

        $get_card_type = json_decode($re_get_card_type, true);
        $get_card_country_type = json_decode($re_get_card_country_type, true);
        $get_card_logo = json_decode($re_get_card_logo, true);


 
        $transactions_create = Transactions::create([
            'user_id' => Auth::id(),
            'username' => Auth::user()->username,
            'amount' => $request->sum,
            'status' => 0,
            'logo' => $get_card_logo[0]['card_logo'],
            'card_type' => $get_card_type[0]['card_name'],
            'card_country_type' => $get_card_country_type[0]['card_country_name'],
            'card_amount' => $request->value1,
            'rate' => $request->rate,
            'transaction_type' => 'GiftCard',
            'card1' => $request->image_url_1,
            'card2' => $request->image_url_2,
            'card3' => $request->image_url_3,
            'card4' => $request->image_url_4,
            'card5' => $request->image_url_5,
            'card6' => $request->image_url_6,
            'card7' => $request->image_url_7,
            'card8' => $request->image_url_8,
            'card9' => $request->image_url_9,
            'card10' => $request->image_url_10,
        ]);
        
        // Dispatch the ActivityEmailNotification
        $user = Auth::user(); // Get the authenticated user
        $user->notify(new ActivityEmailNotification($transactions_create));


        Auth::user()->save();
        
        Alert::html('Successful', 'Your transaction was successful, you can review your transaction staus in 15mins' , 'success');
       
        
        return Redirect::back();
        
    }
}

