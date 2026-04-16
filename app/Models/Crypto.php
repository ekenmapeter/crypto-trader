<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crypto extends Model
{
    use HasFactory;

     protected $table="crypto";
     
    public $fillable = [
        'logo',
        'coin_name',
        'qr_code',
        'wallet_address',
        'coin_rate',
        'restrict',
        'updated_at',
        'created_at',
    ];
}
