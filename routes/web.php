<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use QuickPay\QuickPay;

//User has to be logged in to access these
Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'PagesController@overview');
    Route::get('/overview', 'PagesController@overview');

    //Post
    Route::get('/posts', 'PostController@list');

    //Profile
    Route::get('/profile', 'ProfileController@index');

    //subscription
    Route::get('/subscription', 'SubscriptionController@index');
    Route::get('/subscription/verify', 'SubscriptionController@verifyPayment');
    Route::post('/subscription/subscribe', 'SubscriptionController@subscribe');
});

Route::get('/logout', function (){
    if( Auth::check() )
        Auth::logout();

    return redirect()->intended('/login');
});

Route::post('/message/send', 'MessagesController@send');

Route::get('/form', function () {
    return view('form');
});

Route::get('/test', function () {
    $api_key = '5256684d74e913d6085cc4c1d839a7c4b8245907b84f31b43462bc1b72179598';
    $client = new QuickPay(":$api_key");

    $response = $client->request->get('/subscriptions/120004902');

    $json = $response->asArray();

    return $json;
});

Route::get('/lirik', function () {
    $api_key = '5256684d74e913d6085cc4c1d839a7c4b8245907b84f31b43462bc1b72179598';
    $client = new QuickPay(":$api_key");

    $response = $client->request->put('/subscriptions/119900685/link', ['amount' => 200]);

    $json = $response->asArray();

    return $json;
});


Route::any('dump', function(){
    $order = Auth::user()->order()->first();
    dd(strtotime($order->date) < strtotime('-30 day'));


});

Auth::routes();
