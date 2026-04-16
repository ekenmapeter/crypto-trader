<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Swap extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'from_wallet_type_id',
        'to_wallet_type_id',
        'from_amount',
        'to_amount',
        'rate',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function fromWalletType()
    {
        return $this->belongsTo(WalletType::class, 'from_wallet_type_id');
    }

    public function toWalletType()
    {
        return $this->belongsTo(WalletType::class, 'to_wallet_type_id');
    }
}


