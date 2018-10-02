<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KycDocument extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'document_id',
        'url',
        'unique_id',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        
    ];

    /**
     * The services that belong to the user.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    /**
     * The services that belong to the user.
     */
    public function document()
    {
        return $this->belongsTo('App\Document');
    }
}
