<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileDetails extends Model {
  protected $fillable = [
    'age',
    'height',
    'weight',
    'pant_size',
    'shoe_size',
    'shirt_size',
    'description',
    'hair_length',
    'hair_color',
    'ethnicity',
    'eye_color',
    'roles',
    'user_id'
  ];

  public function user() {
    return $this->belongsTo('App\User');
  }
}
