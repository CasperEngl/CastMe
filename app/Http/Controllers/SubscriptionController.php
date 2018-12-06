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
}
