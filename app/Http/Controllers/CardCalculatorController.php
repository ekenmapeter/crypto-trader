<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CardCategory;
use App\Models\CardSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CardCalculatorController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */

    public function getCardCategory()
    {
        $categories = DB::table('card_categories')->get();
 
        return $categories->id;
    }
 

    public function getSubcategories(Request $request)
    {
        $subcategories = DB::table('card_sub_categories')
            ->where('card_id', $request->card_id)
            ->get();
        
        if (count($subcategories) > 0) {
            return $subcategories;
        }
    }


    public function getSubcategoriesRate(Request $request)
    {
        $rate = DB::table('card_sub_categories_rate')
            ->where('card_id_id', $request->card_id_id)
            ->get();

        
        if (count($rate) > 0) {
            return $rate;
        }


    }

}

