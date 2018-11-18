<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PostRole extends Model {
    protected $fillable = ['post_id', 'role'];

    public static function getPossibleRoles() {
      $type = DB::select(DB::raw("SHOW COLUMNS FROM post_roles WHERE Field = 'role'") )[0]->Type;
  
      preg_match('/^enum\((.*)\)$/', $type, $matches);
  
      $enum = array();
  
      foreach(explode(',', $matches[1]) as $value) {
        $val = trim($value, "'");
        $enum = array_add($enum, str_slug($val, '_'), str_slug($val, '_'));
      }
  
      return $enum;
    }

    public function post() {
        return $this->hasOne('App\Post');
    }

    public function posts() {
        return $this->hasMany('App\Post');
    }
}
