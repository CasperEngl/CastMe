<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {
  public function conversation() {
    return $this->belongsTo('App\Conversation');
  }

  public function sender() {
    return $this->hasOne('App\User', 'sender');
  }

  public function receiver() {
    return $this->hasOne('App\User', 'receiver');
  }
}
