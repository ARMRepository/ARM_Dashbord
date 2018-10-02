<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'percentage',
        'from',
        'to',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'created_at', 'updated_at'
    ];
}
