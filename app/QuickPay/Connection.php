<?php

namespace App\QuickPay;


use QuickPay\QuickPay;

class Connection
{
    public $client;

    public function __construct()
    {
        $api_key = env("QUICKPAY_API_KEY");
        $this->client = new QuickPay(":$api_key");

        return $this;
    }
}