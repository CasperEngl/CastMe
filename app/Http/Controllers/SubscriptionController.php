<?php

namespace App\Http\Controllers;

use App\Orders;
use App\QuickPay\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use QuickPay\QuickPay;

class SubscriptionController extends Controller {
  public function index() {
    return view('Subscription');
  }

  public function subscribe(Request $request) {
    $amount = $request->input('amount');

    $sub = new Subscription(Auth::user());

    $link = $sub->generateLink($amount);

    return redirect($link);
  }

  public function verifyPayment() {
    $sub = new Subscription(Auth::user());

    $sub->withdraw();

    return redirect('/subscription');
  }
}
