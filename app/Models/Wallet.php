<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model 
{

    public $timestamps = true;

       use HasFactory;

 
    /**

     * The attributes that are mass assignable.

     *

     * @var array

    */
     protected $table="wallets";
     
    public $fillable = [
        'id',
        'user_id',
        'amount',
        'updated_at',
        'created_at',
    ];


    protected $dates = ['deleted_at'];

    public function wallet()
    {
        return $this->belongsToMany('Transactions');
    }

}