<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardCategory extends Model
{
    use HasFactory;

     /**

     * The attributes that are mass assignable.

     *

     * @var array

    */
     protected $table="card_categories";
     
    public $fillable = [
        'logo',
        'card_name',
        'updated_at',
        'created_at',
    ];
}
