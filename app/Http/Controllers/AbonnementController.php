<?php

namespace App\Http\Controllers;

use App\Orders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use QuickPay\QuickPay;

class AbonnementController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        if(!$user->order)
            $order = Orders::create(['user_id' => Auth::id()]);
        else
            $order = $user->order;

        if($this->orderExist()){}

        $params = array(
            "version" => "v10",
            "merchant_id" => 50185,
            "agreement_id" => 191766,
            "order_id" => 289933311,
            "amount" => 500,
            "currency" => "DKK",
            "type" => "subscription",
            "payment_methods" => "visa,mastercard,dankort",
            "continueurl" => "http://castme2.test/dump",
            "cancelurl" => "http://castme2.test/dump",
            "callbackurl" => "http://castme2.test/dump",
        );

        $params["checksum"] = $this->sign($params, "3be59393a276ae48ac4675f568ecc5e5dff2e66cc2c6632fb4dc6f647a226fb6");

        return view('abonnement')->with('params', $params);
    }

    protected function sign($params, $api_key) {
        $flattened_params = $this->flatten_params($params);
        ksort($flattened_params);
        $base = implode(" ", $flattened_params);

        return hash_hmac("sha256", $base, $api_key);
    }

    protected function flatten_params($obj, $result = array(), $path = array()) {
        if (is_array($obj)) {
            foreach ($obj as $k => $v) {
                $result = array_merge($result, $this->flatten_params($v, $result, array_merge($path, array($k))));
            }
        } else {
            $result[implode("", array_map(function($p) { return "[{$p}]"; }, $path))] = $obj;
        }

        return $result;
    }

    protected function orderExist(){
//        $api_key = '5256684d74e913d6085cc4c1d839a7c4b8245907b84f31b43462bc1b72179598';
//        $client = new QuickPay(":$api_key");
//
//        $user = User::find(Auth::id());
//        $response = $client->request->get('/subscriptions?order_id=9909');
//        $response = $response->asArray();
//
//        if($response[0]['accepted'])
//            $client->request->delete('/subscriptions/' . $response[0]['id'] . '/link');

    }
}
