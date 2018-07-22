<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class profileDetails extends Model
{
    protected $fillable = [
        'age',
        'height',
        'weight',
        'experience',
        'pant-size',
        'shoe_size',
        'shirt_size',
        'hair_length',
        'hair_color',
        'ethnicity',
        'eye_color',
        'Actor',
        'Dancer',
        'Entertainer',
        'Event Staff',
        'Extra',
        'Model',
        'Musician',
        'Other',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
