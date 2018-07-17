<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function reply()
    {
        return $this->hasMany('App\Reply', 'message_id');
    }

    public function from()
    {
        return $this->hasOne('App\User', 'sender');
    }

    public function to()
    {
        return $this->hasOne('App\User', 'receiver');
    }

}
