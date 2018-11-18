<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProfileRole extends Model {
    protected $fillable = ['user_id', 'role'];

    public static function getPossibleRoles() {
      $type = DB::select(DB::raw("SHOW COLUMNS FROM profile_roles WHERE Field = 'role'") )[0]->Type;
  
      preg_match('/^enum\((.*)\)$/', $type, $matches);
  
      $enum = array();
  
      foreach(explode(',', $matches[1]) as $value) {
        $val = trim($value, "'");
        $enum = array_add($enum, str_slug($val, '_'), str_slug($val, '_')); 
      }
  
      return $enum;
    }

    public function user() {
        return $this->hasOne('App\User');
    }

    public function users() {
        return $this->hasMany('App\User');
    }
}
