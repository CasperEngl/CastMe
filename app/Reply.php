<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function message(){
        return $this->belongsTo('App\Message');
    }

    public function from()
    {
        return $this->hasOne('App\User', 'from');
    }

    public function to()
    {
        return $this->hasOne('App\User', 'to');
    }
}
