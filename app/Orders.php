<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    protected $fillable = [
        'sender',
        'receiver',
        'title',
        'content',
        'read',
    ];

    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
