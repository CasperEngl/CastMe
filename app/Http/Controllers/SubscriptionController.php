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

  public function subForm() {
    return view('form');
  }

  public function create(Request $request) {
    $user = Auth::user();
    $model = $request->input('sub');

    //Checks if user already have a subscription
    if ($user->subscribed('paid'))
      return redirect()->route('user.subscription')->withErrors([__('user already have active subscription')]);

    //Checks that $request->input('sub') is not manipulated
    if(!in_array($model, ['2_months', '3_months', '6_months', '12_months']))
      return redirect()->route('user.subscription')->withErrors([__('Unknown billing model')]);

    $user->newSubscription('paid', $model)->create($request->input('stripeToken'));

    Flash::push('success', __("You're now subscribed!"));
    return redirect()->route('user.subscription');
  }

  public function swap(Request $request) {
    $user = Auth::user();
    $model = $request->input('sub');

    if (!$user->subscribed('paid'))
      return redirect()->route('user.subscription')->withErrors([__('user does not have active subscription')]);

    if(!in_array($model, ['2_months', '3_months', '6_months', '12_months']))
      return redirect()->route('user.subscription')->withErrors([__('Unknown billing model')]);

    $user->subscription()->swap($model);

    Flash::push('success', __("Changed billing cycle"));
    return redirect()->route('user.subscription');
  }

  public function cancel() {
    $user = Auth::user();
    if ($user->subscribed('paid'))
      $user->subscription()->cancel();

    Flash::push('success', __("Successfully unsubscribed"));
    return redirect()->route('user.subscription');
  }
}
