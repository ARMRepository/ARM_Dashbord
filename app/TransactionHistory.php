<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionHistory extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'price',
        'payment_mode',
        'payment_id',
        'status',
        'user_id',
        'ico',
        'ico_price',
        'promocode',
        'bonus_point',
        'referral_code',
        
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
