<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email', 
        'password',
        'mobile',
        'picture',
        'device_token',
        'device_id',
        'device_type',
        'login_by',
        'social_unique_id',
        'XRP',
        'ETH',
        'BTC',
        'dest_tag',
        'eth_address',
        'btc_address',
        'wallet_amount',
        'coin_address',
        'referral_by',
        'status',
        'email_token',
        'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function transaction()
    {
        return $this->hasMany('App\TransactionHistory', 'user_id');
    }
}
