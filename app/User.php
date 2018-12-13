<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Nicolaslopezj\Searchable\SearchableTrait;

class User extends Authenticatable {
  use Notifiable;
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
      'users.name' => 5,
      'users.last_name' => 5,
      'users.email' => 10,
      'users.lang' => 2,
      'users.role' => 5,
      /**
       * Joined tables
       */
      'posts.title' => 1,
      'posts.region' => 2,
      'posts.region' => 2,
      'profile_roles.role' => 3,
      'profile_details.age' => 3,
      'profile_details.height' => 3,
      'profile_details.pant_size' => 1,
      'profile_details.shoe_size' => 1,
      'profile_details.shirt_size' => 1,
      'profile_details.description' => 1,
      'profile_details.hair_length' => 1,
      'profile_details.hair_color' => 1,
      'profile_details.ethnicity' => 2,
      'profile_details.eye_color' => 1,
      'profile_details.gender' => 3,
    ],
    'joins' => [
      'posts' => ['users.id','posts.user_id'],
      'profile_roles' => ['users.id', 'profile_roles.user_id'],
      'profile_details' => ['users.id', 'profile_details.user_id'],
    ],
  ];

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
    'created_by',
    'name',
    'last_name',
    'email',
    'phone',
    'password',
  ];

  /**
   * The attributes that should be hidden for arrays.
   *
   * @var array
   */
  protected $hidden = [
    'password', 'remember_token',
  ];

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

  public function conversations() {
    return $this->belongsToMany('App\Conversation', 'conversation_user', 'user_id', 'conversation_id');
  }

  public function details() {
    return $this->hasOne('App\ProfileDetails', 'user_id');
  }

  public function galleryImages() {
    return $this->hasMany('App\GalleryImage');
  }

  public function profileRoles() {
    return $this->hasMany('App\ProfileRole', 'user_id');
  }

  public function createdBy() {
    return $this->hasOne('App\User', 'created_by');
  }

  public function usersCreated() {
    return $this->hasMany('App\User', 'created_by');
  }
}
