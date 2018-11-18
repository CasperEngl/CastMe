<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {
  protected $fillable = [
    'user_id',
    'title',
    'content',
    'banner',
    'images',
    'roles',
    'location',
  ];

  public function comments() {
    return $this->hasMany('App\Comment', 'post_id');
  }

  public function owner() {
    return $this->belongsTo('App\User', 'user_id');
  }

  public function postRoles() {
    return $this->hasMany('App\PostRole', 'post_id');
  }
}
