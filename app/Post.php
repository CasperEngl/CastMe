<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Post extends Model {
  use SearchableTrait;

  protected $searchable = [
    /**
     * Columns and their priority in search results.
     * Columns with higher values are more important.
     * Columns with equal values have equal importance.
     *
     * @var array
     */
    'columns' => [
      /**
       * Posts table
       */
      'posts.title' => 5,
      'posts.region' => 3,
      'posts.location' => 7,
      'posts.content' => 1,
      /**
       * Joined tables
       */
      'users.name' => 10,
      'users.last_name' => 10,
      'users.email' => 5,
      'post_roles.role' => 5,
    ],
    'joins' => [
      'users' => ['posts.user_id','users.id'],
      'post_roles' => ['posts.id', 'post_roles.post_id'],
    ],
  ];

  protected $fillable = [
    'user_id',
    'title',
    'content',
    'banner',
    'images',
    'location',
    'region',
  ];

  public function comments() {
    return $this->hasMany('App\Comment', 'post_id');
  }

  public function owner() {
    return $this->belongsTo('App\User', 'user_id');
  }

  public function user() {
    return $this->belongsTo('App\User', 'user_id');
  }

  public function postRoles() {
    return $this->hasMany('App\PostRole', 'post_id');
  }
}
