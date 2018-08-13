<?php

namespace App\QuickPay;


use App\Orders;
use App\User;

class RegisterUser
{
    public $con;
    public $user;

    public function __construct(User $user)
    {
        $this->con = new Connection();
        $this->user = $user;

        $this->createSubscription();
    }

    private function createSubscription()
    {
        $client = $this->con->client;

        $orderId = $this->generateOrderId();
        $response = $client->request->post('/subscriptions', ['order_id' => $orderId, 'currency' => 'DKK', 'description' => 'CastMe.dk Subscription', 'text_on_statement' => 'CASTME DK']);
        $response = $response->asArray();

        $order = new Orders;

        $order->user_id = $this->user->id;
        $order->quickpay_id = $response['id'];
        $order->uid = $orderId;

        $order->save();


    }

    private function generateOrderId()
    {
        $id = hexdec(uniqid());

        $orders = Orders::where('uid', $id)->get();

        if ($orders !== null)
            $id += 123;

        return $id;
    }

}