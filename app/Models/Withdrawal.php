<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'wallet_type_id',
        'method',
        'amount',
        'destination_address',
        'bank_name',
        'account_name',
        'account_number',
        'wire_details',
        'username',
        'phone',
        'status',
        'is_debited',
        'approved_at',
        'rejected_at',
        'admin_notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    public function walletType()
    {
        return $this->belongsTo(WalletType::class);
    }

    /**
     * Get the status text
     */
    public function getStatusTextAttribute()
    {
        return match($this->status) {
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Rejected',
            default => 'Unknown'
        };
    }

    /**
     * Check if withdrawal is pending
     */
    public function isPending()
    {
        return $this->status === 0;
    }

    /**
     * Check if withdrawal is approved
     */
    public function isApproved()
    {
        return $this->status === 1;
    }

    /**
     * Check if withdrawal is rejected
     */
    public function isRejected()
    {
        return $this->status === 2;
    }
}
