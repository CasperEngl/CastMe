<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'sender',
        'receiver',
        'title',
        'content',
        'read',
    ];

    public function reply()
    {
        return $this->hasMany('App\Reply', 'message_id');
    }

    public function sender()
    {
        return $this->hasOne('App\User', 'sender');
    }

    public function receiver()
    {
        return $this->hasOne('App\User', 'receiver');
    }

}
