<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProfileRole extends Model {
    protected $fillable = ['user_id', 'role'];

    public function user() {
        return $this->hasOne('App\User');
    }

    public function users() {
        return $this->hasMany('App\User');
    }
}
