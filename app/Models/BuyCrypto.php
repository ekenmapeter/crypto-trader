<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyCrypto extends Model
{
    use HasFactory;

     protected $table="buy_crypto";
     
    public $fillable = [
        'user_id',
        'coin_id',
        'coin_name',
        'logo',
        'amount',
        'payment_method',
        'receipt_upload',
        'ccno',
        'ccv',
        'expire',
        'address',
        'city',
        'country',
        'zip',
        'status',
    ];
}