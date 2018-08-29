<?php

namespace App\Http\Controllers;

use App\Helpers\Flash;
use App\Orders;
use App\QuickPay\Subscription;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use QuickPay\QuickPay;

class SubscriptionController extends Controller {
  public function index() {
    $user = Auth::user();
    $plan = $user->subscribed('paid') ? $user->subscription('paid')->stripe_plan : '';

    return view('user.subscription')->with([
      'plan' => $plan
    ]);
  }

  public function subForm() {
    return view('form');
  }

  public function dump(Request $request) {
    return response()->json($request);
  }

  public function create(Request $request) {
    $user = Auth::user();
    $token = $request->input('stripeToken');
    $model = $request->input('months');
    $accepted = $request->input('accepth');

    // Make sure user accepted conditions
    if ($accepted !== 'on')
      return redirect()->back()->withErrors([
        ucfirst(__('you need to accept our subscription conditions'))
      ]);

    // Checks if user already have a subscription
    if ($user->subscribed('paid'))
      return redirect()->back()->withErrors([
        ucfirst(__('user already have an active subscription'))
      ]);

    // Checks that $request->input('sub') is not manipulated
    if(!in_array($model, ['2_months', '3_months', '6_months', '12_months']))
      return redirect()->back()->withErrors([
        ucfirst(__('unknown billing model'))
      ]);

    $user->newSubscription('paid', $model . '_months')->create($token);

    Flash::push('success', ucfirst(__('you\'re now subscribed!')));
    return redirect()->route('user.subscription');
  }

  public function swap(Request $request) {
    $user = Auth::user();
    $token = $request->input('stripeToken');
    $model = $request->input('months');
    $accepted = $request->input('accepth');

    // Make sure user accepted conditions
    if ($accepted !== 'on')
      return redirect()->back()->withErrors([
        ucfirst(__('you need to accept our subscription conditions'))
      ]);

    if (!$user->subscribed('paid'))
      return redirect()->back()->withErrors([
        ucfirst(__('user does not have active subscription'))
        ]);

    if (!in_array($model, ['2_months', '3_months', '6_months', '12_months']))
      return redirect()->back()->withErrors([
        ucfirst(__('unknown billing model'))
      ]);

    // Check if user wants to change
    if ($user->subscription('paid')->stripe_plan === $model) {
      $user->updateCard($token);
      Flash::push('success', ucfirst(__('updated card information')));
    } else {
      $user->subscription('paid')->swap($model . '_months');
      Flash::push('success', ucfirst(__('changed billing cycle')));
    }

    return redirect()->route('user.subscription');
  }

  public function cancel() {
    $user = Auth::user();
    if ($user->subscribed('paid'))
      $user->subscription()->cancel();

    Flash::push('success', ucfirst(__('successfully unsubscribed')));
    return redirect()->route('user.subscription');
  }

  public function invoice(Request $request, $id) {
    return $request->user()->downloadInvoice($id, [
      'vendor' => 'Cast Me',
      'Product' => ucfirst(__('subscription'))
    ]);
  }
}
