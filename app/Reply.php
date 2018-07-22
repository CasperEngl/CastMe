<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {
  public function message() {
    return $this->belongsTo('App\Message');
  }

  public function sender() {
    return $this->hasOne('App\User', 'sender');
  }

  public function receiver() {
    return $this->hasOne('App\User', 'receiver');
  }
}
