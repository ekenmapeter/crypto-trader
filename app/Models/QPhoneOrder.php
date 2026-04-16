<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QPhoneOrder extends Model
{
    use HasFactory;

    protected $table = 'qphone_orders';

    protected $fillable = [
        'user_id',
        'product_name',
        'product_image',
        'price',
        'quantity',
        'wallet_address',
        'payment_proof',
        'payment_coin',
        'status',
        'admin_notes',
        'paid_at',
        'approved_at',
        'rejected_at',
        'tx_reference'
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
        'price' => 'decimal:2',
        'quantity' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
