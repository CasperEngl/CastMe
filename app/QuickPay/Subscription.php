<?php

namespace App\QuickPay;


use App\Payment;
use App\User;
use Carbon\Carbon;

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
                'continue_url' => env("APP_URL") . '/subscription/verify'
            ]
        );
        $response = $response->asArray();

        return $response['url'];
    }

    public function verifySubscription()
    {
        $payment = $this->user->payments()->latest()->first();
        if($payment == null)
            return false;

        if (strtotime($payment->created_at) < strtotime('-30 day'))
            return false; //expired

        if ($payment->accepted == 0)
            return false; //not accepted

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

        $order = $order->asArray();
        $orderId = 'sub' . uniqid();

        $response = $this->client->request->post("/subscriptions/{$this->order->quickpay_id}/recurring",
            [
                'order_id' => $orderId,
                'amount' => $order['link']['amount'],
                'auto_capture' => 1,
                'text_on_statement' => 'CASTME DK'
            ]
        );
        $response = $response->asArray();

        if ($response['accepted'] == "false" || $response['accepted'] == false)
            $response['accepted'] = 0;

        if ($response['accepted'] == "true" || $response['accepted'] == true)
            $response['accepted'] = 1;

        $order = $this->user->order;
        $payment = new Payment;

        $payment->q_order_id = $orderId;
        $payment->order_id = $order->id;
        $payment->user_id = $this->user->id;
        $payment->state = $response['state'];
        $payment->accepted = $response['accepted'];
        $payment->quickpay_id = $response['id'];

        $payment->save();

        if ( $payment->accepted ) {
            $order->from = Carbon::now();
            $order->save();
        }
    }
}