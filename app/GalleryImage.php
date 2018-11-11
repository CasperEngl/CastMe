<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GalleryImage extends Model
{
    protected $fillable = ['user_id', 'image', 'title', 'description'];

    public function owner() {
        return $this->belongsTo('App\User');
    }
}
