<?php

namespace App;

use App\QuickPay\Subscription;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Cashier\Billable;

class User extends Authenticatable {
  use Notifiable;
  use Billable;

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'name', 'email', 'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public function order() {
    return $this->hasOne('App\Orders', 'user_id');
  }

  public function comments() {
    return $this->hasMany('App\Comment');
  }

  public function posts() {
    return $this->hasMany('App\Post', 'user_id');
  }

  public function sentMessages() {
    return $this->hasMany('App\Message', 'from');
  }

  public function receivedMessages() {
    return $this->hasMany('App\Message', 'to');
  }

  public function payments() {
    return $this->hasMany('App\Payment');
  }

  public function conversations() {
    return $this->belongsToMany('App\Conversation');
  }

  public function activeSub() {
    return $this->subscribed('paid');
  }

  public function details() {
    return $this->hasOne('App\ProfileDetails', 'user_id');
  }
}
