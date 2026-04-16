<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deposit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_type_id',
        'amount',
        'tx_reference',
        'payment_proof',
        'status',
        'credited_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'credited_at' => 'datetime',
    ];

    public function walletType()
    {
        return $this->belongsTo(WalletType::class);
    }
}


