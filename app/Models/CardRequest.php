<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CardRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'card_type',
        'cardholder_name',
        'email',
        'phone_number',
        'address',
        'proof_of_address_file',
        'wallet_address',
        'status',
        'admin_notes',
        'card_number',
        'expiry_date',
        'cvv',
        'approved_at',
        'rejected_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'rejected_at' => 'datetime',
    ];

    /**
     * Get the user that owns the card request
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate card details when approved
     */
    public function generateCardDetails()
    {
        $this->card_number = $this->generateCardNumber();
        $this->expiry_date = $this->generateExpiryDate();
        $this->cvv = $this->generateCVV();
        $this->save();
    }

    /**
     * Generate a random card number
     */
    private function generateCardNumber()
    {
        $prefix = '8050';
        $middle = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $suffix = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
        $last = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);

        return $prefix . ' ' . $middle . ' ' . $suffix . ' ' . $last;
    }

    /**
     * Generate expiry date (5 years from now)
     */
    private function generateExpiryDate()
    {
        $date = now()->addYears(5);
        return $date->format('m/y');
    }

    /**
     * Generate CVV
     */
    private function generateCVV()
    {
        return str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
    }

    /**
     * Approve the card request
     */
    public function approve($adminNotes = null)
    {
        $this->status = 'approved';
        $this->admin_notes = $adminNotes;
        $this->approved_at = now();
        $this->generateCardDetails();
        $this->save();
    }

    /**
     * Reject the card request
     */
    public function reject($adminNotes = null)
    {
        $this->status = 'rejected';
        $this->admin_notes = $adminNotes;
        $this->rejected_at = now();
        $this->save();
    }

    /**
     * Check if card request is pending
     */
    public function isPending()
    {
        return $this->status === 'pending';
    }

    /**
     * Check if card request is approved
     */
    public function isApproved()
    {
        return $this->status === 'approved';
    }

    /**
     * Check if card request is rejected
     */
    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    /**
     * Get masked card number for display
     */
    public function getMaskedCardNumber()
    {
        if (!$this->card_number) {
            return 'XXXX XXXX XXXX XXXX';
        }

        $parts = explode(' ', $this->card_number);
        if (count($parts) === 4) {
            return $parts[0] . ' XXXX XXXX ' . $parts[3];
        }

        return $this->card_number;
    }
}
