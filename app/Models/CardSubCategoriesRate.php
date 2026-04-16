<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardSubCategoriesRate extends Model
{
    use HasFactory;

    /**

     * The attributes that are mass assignable.

     *

     * @var array

    */
     protected $table="card_sub_categories_rate";
     
    public $fillable = [
        'card_id',
        'card_id_id',
        'card_country_name',
        'rate',
        'updated_at',
        'created_at',
    ];
}