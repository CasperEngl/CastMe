<?php

namespace App;

use App\QuickPay\Subscription;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function order()
    {
        return $this->hasOne('App\Orders');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function sentMessages()
    {
        return $this->hasMany('App\Message', 'from');
    }

    public function receivedMessages()
    {
        return $this->hasMany('App\Message', 'to');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }

    public function activeSub()
    {
        $sub = new Subscription($this);

        return $sub->verifySubscription();
    }
}
