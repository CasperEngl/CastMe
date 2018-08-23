<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model {
  protected $fillable = [
    'sender_id',
    'receiver_id',
    'content',
    'read',
  ];

  public function sender() {
    return $this->belongsTo('App\User', 'sender_id');
  }

  public function receiver() {
    return $this->belongsTo('App\User', 'receiver_id');
  }
}
