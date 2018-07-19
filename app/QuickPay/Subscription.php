<?php

namespace App\QuickPay;


use App\Payment;
use App\User;

class Subscription
{
    public $user;
    private $client;
    private $order;

    public function __construct(User $user)
    {
        $this->user = $user;
        $this->order = $user->order()->first();
        $this->client = new Connection();
        $this->client = $this->client->client;

    }

    public function generateLink($amount)
    {
        $response = $this->client->request->put("/subscriptions/{$this->order->quickpay_id}/link",
            [
                'amount' => $amount,
                'continue_url' => 'http://castme2.test/abonnement/verify'
            ]
        );
        $response = $response->asArray();

        return $response['url'];
    }

    public function verifySubscription()
    {
        if($this->user->payments()->latest()->first() == null)
            return false;

        if (strtotime($this->user->payments()->latest()->first()->created_at) < strtotime('-30 day'))
            return false; //expired

        return true;
    }

    public function verifyPayment()
    {
        $payment = $this->user->payments()->latest()->first();
        if($payment == null)
            return false;

        $order = $this->client->request->get('/payments/' . $payment->quickpay_id);
        $order = $order->asArray();

        if($order['accepted'] == false)
            return false;

        return true;
    }

    public function withdraw()
    {
        $order = $this->client->request->get('/subscriptions/' . $this->order->quickpay_id);
//        dd($order);
        $order = $order->asArray();
        $orderId = 'sub' . uniqid();

        dump($orderId);

        $response = $this->client->request->post("/subscriptions/{$this->order->quickpay_id}/recurring",
            [
                'order_id' => $orderId,
                'amount' => $order['link']['amount'],
                'auto_capture' => 1,
                'text_on_statement' => 'CASTME DK'
            ]
        );
        $response = $response->asArray();

        if ($response['state'] == "false" || $response['state'] == false)
            $response['state'] = 0;

        if ($response['state'] == "true" || $response['state'] == true)
            $response['state'] = 1;

        $payment = new Payment;

        $payment->order_id = $orderId;
        $payment->user_id = $this->user->id;
        $payment->state = $response['state'];
        $payment->accepted = $response['accepted'];
        $payment->quickpay_id = $response['id'];

        $payment->save();
    }
}