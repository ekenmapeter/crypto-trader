<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'verification_id',
        'type',
        'path',
    ];

    public function verification()
    {
        return $this->belongsTo(Verification::class);
    }
}


