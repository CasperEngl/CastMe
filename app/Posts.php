<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $fillable = [
        'user_id', 'title', 'content',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function owner()
    {
        return $this->belongsTo('App\User');
    }
}
