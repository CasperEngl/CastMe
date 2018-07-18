<?php

namespace App\QuickPay;


use App\User;

class Subscription
{
    public $user;
    private $order;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->order = $user->order()->first();
    }

    public function generateLink()
    {
        $link = '';

        return $link;
    }

    public function withdraw()
    {
        
    }
}