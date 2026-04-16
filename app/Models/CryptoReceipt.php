<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CryptoReceipt extends Model
{
    use HasFactory;

     protected $table="crypto-receipt";
     
    public $fillable = [
        'user_id',
        'fullname',
        'username',
        'email',
        'phone',
        'coin_name',
        'coin_id',
        'coin_rate',
        'status',
        'receipt_upload',
        'recieve_wallet_address',
        'amount',
        'payout',
        'updated_at',
        'created_at',
    ];
}