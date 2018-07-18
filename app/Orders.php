<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'uid',
        'status',
        'user_id',
        'quickpay_id',
    ];

    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
