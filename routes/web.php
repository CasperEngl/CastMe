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
    Route::get('/overview', function () {
        return view('overview');
    });
    Route::get('/posts', function () {
        return view('posts');
    });
    Route::get('/profile', function () {
        return view('profile');
    });
    Route::get('/', function () {
        return view('overview');
    });
    Route::get('/abonnement', 'AbonnementController@index');
});

Route::get('/logout', function (){
    if( Auth::check() )
        Auth::logout();

    return redirect()->intended('/login');
});

Route::post('/send', 'MessagesController@send');

Route::get('/form', function () {
    return view('form');
});

Route::get('/test', function () {

    $api_key = 'API_KEY';
    $client = new QuickPay(":$api_key");

    $response = $client->request->get('/subscriptions?order_id=9909');

    $json = json_encode($response->asObject());

    return json_decode($json);
});

Route::any('dump', function(){
   dd( Request::all());
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


