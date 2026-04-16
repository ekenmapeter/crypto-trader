<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SecureRetirementInquiry extends Model
{
    use HasFactory;

    protected $table = 'secure_retirement_inquiries';

    protected $fillable = [
        'user_id',
        'full_name',
        'email',
        'phone',
        'account_type',
        'current_provider',
        'rollover_amount',
        'preferred_custodian',
        'notes',
        'status',
        'processed_at',
    ];

    protected $casts = [
        'processed_at' => 'datetime',
        'rollover_amount' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
