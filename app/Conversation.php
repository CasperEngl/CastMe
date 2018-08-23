<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model {
  protected $fillable = [
    'sender',
    'receiver',
    'content',
    'read',
  ];

  public function replies() {
    return $this->hasMany('App\Reply', 'sender');
  }
}
