<?php

namespace App\Http\Controllers;

use App\Orders;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('Subscription');
    }

    public function new()
    {
        $user = User::find(Auth::id());
        if(!$user->order)
            $order = Orders::create(['user_id' => Auth::id()]);
        else
            $order = $user->order;




        return $_POST;
    }


}
