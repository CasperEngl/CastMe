<?php

namespace App\QuickPay;


use QuickPay\QuickPay;

class Connection
{
    public $client;

    public function __construct()
    {
        $api_key = '5256684d74e913d6085cc4c1d839a7c4b8245907b84f31b43462bc1b72179598';
        $this->client = new QuickPay(":$api_key");

        return $this;
    }
}