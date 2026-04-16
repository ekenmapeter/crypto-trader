<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\InteractsWithMedia;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model

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
        'user_id',
		'wallet_type_id',
		'amount',
		'wallet_address',
		'restrict_fee',
    ];



    protected $table = 'user_wallet';
    public $timestamps = true;


    protected $dates = ['deleted_at'];

    /**
     * Get the wallet type for this user wallet
     */
    public function walletType()
    {
        return $this->belongsTo(WalletType::class, 'wallet_type_id');
    }

    /**
     * Get the user for this wallet
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }




    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [

    ];
}
