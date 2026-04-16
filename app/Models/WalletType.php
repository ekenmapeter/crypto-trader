<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class WalletType extends Model

{
    use HasFactory, Notifiable;


    // Define your media collections here
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('card');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'logo',
        'coin_name',
        'short_code',
        'active',
        'payment_wallet_address',
        'payment_qr_code',
        'payment_instructions',
        'restrict',
    ];



    protected $table = 'wallet_type';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

    public function users_wallet()
    {
        return $this->hasOne('Wallet');
    }


    public function userWallets()
    {
        return $this->belongsToMany(User::class,'user_wallet');

    }




    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];

    /**
     * Scope to get only active wallet types
     */
    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    /**
     * Scope to get only inactive wallet types
     */
    public function scopeInactive($query)
    {
        return $query->where('active', false);
    }
}
