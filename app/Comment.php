<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model {
  use SoftDeletes;
  
  protected $fillable = [
    'user_id', 'post_id', 'content',
  ];

  public function post() {
    return $this->belongsTo('App\Post', 'post_id');
  }

  public function owner() {
    return $this->belongsTo('App\User', 'user_id');
  }
}
