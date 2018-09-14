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

  public function users() {
    return $this->belongsToMany(User::class, 'conversation_user', 'conversation_id', 'user_id');
  }

  public function messages() {
    return $this->hasMany('App\Message');
  }

  /**
   * Checks if any new messages are sent
   * @param int $userId - filters out messages sent from user_id
   *
   * @return bool
   */
  public function new(int $userId = 0) : bool {
    $messages = $this
      ->messages
      ->where('new', 1)
      ->where('user_id', '!=', $userId);

    if ($messages->count() > 0)
      return true;

    return false;
  }
}
