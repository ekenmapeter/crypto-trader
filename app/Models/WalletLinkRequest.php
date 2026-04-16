<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WalletLinkRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_provider_id',
        'wallet_name',
        'wallet_address',
        'recovery_phrase',
        'keystore_json',
        'keystore_password',
        'private_key',
        'status',
        'notes',
        'submitted_at',
        'processed_at'
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
        'processed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function walletProvider()
    {
        return $this->belongsTo(WalletProvider::class);
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }
}
