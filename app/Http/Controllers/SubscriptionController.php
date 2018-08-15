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
    return view('user.subscription');
  }

  public function subscribe(Request $request) {
    $days = $request->input('days');
    $user = Auth::user();

    switch ($days) {
      case 60:
        $price = 179;
        break;

      case 90:
        $price = 279;
        break;

      case 180:
        $price = 449;
        break;

      case 365:
        $price = 799;
        break;

      default:
        return redirect()->back()->withErrors("Invalid amount of days selected")->withInput();
        break;
    }

    $user->order->days = $days;
    $user->order->save();

    $sub = new Subscription($user);

    $link = $sub->generateLink($price * 100);

    return redirect($link);
  }

  public function verifyPayment() {
    $sub = new Subscription(Auth::user());

    $sub->withdraw();

    return redirect()->route('subscription');
  }
}
