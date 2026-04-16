<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
    use HasFactory;

    protected $table = 'user_verifications';

    protected $fillable = [
        'user_id',
        'country',
        'document_type',
        'ssn_last4',
        'status',
        'admin_notes',
        'submitted_at',
        'reviewed_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'submitted_at' => 'datetime',
        'reviewed_at' => 'datetime',
    ];

    public function documents()
    {
        return $this->hasMany(VerificationDocument::class, 'verification_id');
    }
}


