<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Transactions extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;

    protected $table = 'transactions';

    protected $casts = [
        'amount' => 'decimal:8',
        'fee' => 'decimal:8',
        'exchange_rate' => 'decimal:8',
        'metadata' => 'array',
        'processed_at' => 'datetime',
    ];

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'username',
        'fullname',
        'amount',
        'status',
        'transaction_type',
        'reference_id',
        'reference_type',
        'description',
        'fee',
        'currency',
        'metadata',
        'payment_method',
        'payment_status',
        'user_notes',
        'tx_hash',
        'block_number',
        'from_address',
        'to_address',
        'exchange_rate',
        'exchange_from_currency',
        'exchange_to_currency',
    ];

    protected $dates = ['deleted_at'];

    // Transaction types
    const TYPE_DEPOSIT = 'deposit';
    const TYPE_WITHDRAWAL = 'withdrawal';
    const TYPE_TRANSFER = 'transfer';
    const TYPE_EXCHANGE = 'exchange';
    const TYPE_CARD_PURCHASE = 'card_purchase';
    const TYPE_CRYPTO_TRADE = 'crypto_trade';
    const TYPE_CHARGE_FEE = 'charge_fee';
    const TYPE_REFUND = 'refund';
    const TYPE_ADJUSTMENT = 'adjustment';

    // Status constants
    const STATUS_PENDING = 0;
    const STATUS_COMPLETED = 1;
    const STATUS_CANCELLED = 2;
    const STATUS_FAILED = 3;
    const STATUS_PROCESSING = 4;

    // Payment methods
    const PAYMENT_CRYPTO = 'crypto';
    const PAYMENT_BANK = 'bank';
    const PAYMENT_WIRE = 'wire';
    const PAYMENT_CARD = 'card';
    const PAYMENT_WALLET = 'wallet';

    // Payment status
    const PAYMENT_PENDING = 'pending';
    const PAYMENT_COMPLETED = 'completed';
    const PAYMENT_FAILED = 'failed';
    const PAYMENT_CANCELLED = 'cancelled';

    /**
     * Get the user that owns the transaction
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the related model (polymorphic)
     */
    public function reference()
    {
        return $this->morphTo();
    }

    /**
     * Scope for pending transactions
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope for completed transactions
     */
    public function scopeCompleted($query)
    {
        return $query->where('status', self::STATUS_COMPLETED);
    }

    /**
     * Scope for cancelled transactions
     */
    public function scopeCancelled($query)
    {
        return $query->where('status', self::STATUS_CANCELLED);
    }

    /**
     * Scope for failed transactions
     */
    public function scopeFailed($query)
    {
        return $query->where('status', self::STATUS_FAILED);
    }

    /**
     * Scope for processing transactions
     */
    public function scopeProcessing($query)
    {
        return $query->where('status', self::STATUS_PROCESSING);
    }

    /**
     * Scope for specific transaction types
     */
    public function scopeOfType($query, $type)
    {
        return $query->where('transaction_type', $type);
    }

    /**
     * Scope for specific payment methods
     */
    public function scopePaymentMethod($query, $method)
    {
        return $query->where('payment_method', $method);
    }

    /**
     * Scope for specific payment status
     */
    public function scopePaymentStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }

    /**
     * Get status text
     */
    public function getStatusTextAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'Pending',
            self::STATUS_COMPLETED => 'Completed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_FAILED => 'Failed',
            self::STATUS_PROCESSING => 'Processing',
            default => 'Unknown'
        };
    }

    /**
     * Get status badge class
     */
    public function getStatusBadgeClassAttribute()
    {
        return match($this->status) {
            self::STATUS_PENDING => 'bg-yellow-600/20 text-yellow-300 border-yellow-500/30',
            self::STATUS_COMPLETED => 'bg-green-600/20 text-green-300 border-green-500/30',
            self::STATUS_CANCELLED => 'bg-red-600/20 text-red-300 border-red-500/30',
            self::STATUS_FAILED => 'bg-gray-600/20 text-gray-300 border-gray-500/30',
            self::STATUS_PROCESSING => 'bg-blue-600/20 text-blue-300 border-blue-500/30',
            default => 'bg-gray-600/20 text-gray-300 border-gray-500/30'
        };
    }

    /**
     * Get transaction type text
     */
    public function getTransactionTypeTextAttribute()
    {
        return match($this->transaction_type) {
            self::TYPE_DEPOSIT => 'Deposit',
            self::TYPE_WITHDRAWAL => 'Withdrawal',
            self::TYPE_TRANSFER => 'Transfer',
            self::TYPE_EXCHANGE => 'Exchange',
            self::TYPE_CARD_PURCHASE => 'Card Purchase',
            self::TYPE_CRYPTO_TRADE => 'Crypto Trade',
            self::TYPE_CHARGE_FEE => 'Charge Fee',
            self::TYPE_REFUND => 'Refund',
            self::TYPE_ADJUSTMENT => 'Adjustment',
            default => ucfirst(str_replace('_', ' ', $this->transaction_type))
        };
    }

    /**
     * Get payment method text
     */
    public function getPaymentMethodTextAttribute()
    {
        return match($this->payment_method) {
            self::PAYMENT_CRYPTO => 'Cryptocurrency',
            self::PAYMENT_BANK => 'Bank Transfer',
            self::PAYMENT_WIRE => 'Wire Transfer',
            self::PAYMENT_CARD => 'Credit/Debit Card',
            self::PAYMENT_WALLET => 'Digital Wallet',
            default => ucfirst($this->payment_method ?? 'Unknown')
        };
    }

    /**
     * Get payment status text
     */
    public function getPaymentStatusTextAttribute()
    {
        return match($this->payment_status) {
            self::PAYMENT_PENDING => 'Pending',
            self::PAYMENT_COMPLETED => 'Completed',
            self::PAYMENT_FAILED => 'Failed',
            self::PAYMENT_CANCELLED => 'Cancelled',
            default => ucfirst($this->payment_status ?? 'Unknown')
        };
    }

    /**
     * Get total amount including fees
     */
    public function getTotalAmountAttribute()
    {
        return $this->amount + $this->fee;
    }

    /**
     * Check if transaction is pending
     */
    public function isPending()
    {
        return $this->status === self::STATUS_PENDING;
    }

    /**
     * Check if transaction is completed
     */
    public function isCompleted()
    {
        return $this->status === self::STATUS_COMPLETED;
    }

    /**
     * Check if transaction is cancelled
     */
    public function isCancelled()
    {
        return $this->status === self::STATUS_CANCELLED;
    }

    /**
     * Check if transaction is failed
     */
    public function isFailed()
    {
        return $this->status === self::STATUS_FAILED;
    }

    /**
     * Check if transaction is processing
     */
    public function isProcessing()
    {
        return $this->status === self::STATUS_PROCESSING;
    }

    /**
     * Mark transaction as completed
     */
    public function markAsCompleted($notes = null)
    {
        $this->update([
            'status' => self::STATUS_COMPLETED,
            'processed_at' => now(),
            'admin_notes' => $notes
        ]);
    }

    /**
     * Mark transaction as failed
     */
    public function markAsFailed($notes = null)
    {
        $this->update([
            'status' => self::STATUS_FAILED,
            'processed_at' => now(),
            'admin_notes' => $notes
        ]);
    }

    /**
     * Mark transaction as cancelled
     */
    public function markAsCancelled($notes = null)
    {
        $this->update([
            'status' => self::STATUS_CANCELLED,
            'processed_at' => now(),
            'admin_notes' => $notes
        ]);
    }
}
