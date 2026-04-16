<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;


class User extends Authenticatable implements HasMedia

{
    use HasApiTokens, HasFactory, Notifiable;

      use InteractsWithMedia;

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
        'firstname',
        'lastname',
        'username',
        'sex',
        'age',
        'country',
        'mobile_number',
        'roles',
        'email',
        'last_login',
        'password',
        'account_number',
        'account_name',
        'bank_name',
        'wallet_phrase',
    ];



    protected $table = 'users';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

    public function users_wallet()
    {
        return $this->hasOne('Wallet');
    }

    public function users_transaction()
    {
        return $this->hasOne('Transactions');
    }

    public function user_login_history()
    {
        return $this->hasOne('Login_history');
    }

    public function userWallets()
    {
        return $this->belongsToMany(WalletType::class,'user_wallet')->withPivot('wallet_address','amount');

    }

    /**
     * Get only active wallet types for the user
     */
    public function activeUserWallets()
    {
        return $this->belongsToMany(WalletType::class,'user_wallet')
            ->withPivot('wallet_address','amount')
            ->where('active', true);
    }



    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
