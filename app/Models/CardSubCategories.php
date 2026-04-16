<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardSubCategories extends Model
{
    use HasFactory;

    /**

     * The attributes that are mass assignable.

     *

     * @var array

    */
     protected $table="card_sub_categories";
     
    public $fillable = [
        'card_id',
        'card_logo',
        'card_name',
        'card_country_name',
        'card_country_rate',
        'updated_at',
        'created_at',
    ];
}
