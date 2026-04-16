<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminSetting extends Model
{
    use HasFactory;

    protected $fillable = ['admin_email', 'site_name', 'support_email', 'bank_name', 'account_name', 'account_number', 'routing_number', 'paypal_email'];
}
