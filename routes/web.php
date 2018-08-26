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
use Illuminate\Http\Request;
use QuickPay\QuickPay;

// Homepage
Route::get('', 'HomeController@index')->name('home');

//User has to be logged in to access these
Route::group(['middleware' => ['auth']], function() {
    // Overview
    Route::get('overview', 'PagesController@overview')->name('overview');

    // Posts
    Route::get('posts', 'PostController@list')->name('posts');
    Route::get('posts/own', 'PostController@listOwn')->name('posts.own');

    // Post
    Route::get('post/{id}', 'PostController@index')->where('id', '[0-9]+')->name('post');
    Route::get('post/new', 'PostController@new')->name('post.new');
    Route::get('post/{id}/edit', 'PostController@edit')->where('id', '[0-9]+')->name('post.edit');
    Route::get('post/{id}/edit/data', 'PostController@data')->where('id', '[0-9]+');
    Route::get('post/{id}/data', 'PostController@data')->where('id', '[0-9]+')->name('post.data');
    Route::post('post/add', 'PostController@add')->name('post.add');
    Route::post('post/{id}/update', 'PostController@update')->where('id', '[0-9]+')->name('post.update');
    
    // Post Comment
    Route::post('post/comment/new', 'CommentController@new')->name('comment.new');
    
    // Profile Settings
    Route::get('user/settings', 'ProfileController@index')->name('user.settings');
    Route::get('user/settings/dump', 'ProfileController@settingsDump')->name('user.settings.settingsDump');
    Route::post('user/settings/update', 'ProfileController@update')->name('user.settings.update');
    Route::post('user/settings/dump', 'ProfileController@dump')->name('user.settings.dump');

    // Specific Profile
    Route::get('profile/{id}', 'ProfileController@user')->name('profile');

    // Subscription
    Route::get('user/subscription', 'SubscriptionController@index')->name('user.subscription');
    Route::get('user/subscription/verify', 'SubscriptionController@verifyPayment')->name('user.subscription.verify');
    Route::post('user/subscription/subscribe', 'SubscriptionController@subscribe')->name('user.subscription.subscribe');
    Route::post('user/subscription/dump', 'SubscriptionController@dump')->name('user.subscription.dump');

    // Conversation (Singular)
    Route::get('conversation/{id}', 'ConversationController@index')->where('id', '[0-9]+')->name('conversation');
    Route::post('conversation/send/{id}', 'ConversationController@send')->where('id', '[0-9+]')->name('conversation.send');

    // Conversations (List)
    Route::get('conversations', 'ConversationController@list')->name('conversations');

    // Localization
    Route::get('locale', 'LocaleController@index')->name('locale');
    Route::post('locale/set/{locale?}', 'LocaleController@set')->name('locale.set');

    //subscription Stripe
    Route::get('sub/make', 'SubscriptionController@subForm')->name('subform');
    Route::post('sub/make', 'SubscriptionController@create');
    Route::post('sub/dump', 'SubscriptionController@dump')->name('sub.dump');
});

Route::get('logout', function (){
    if( Auth::check() )
        Auth::logout();

    return redirect()->intended('/login');
});

Route::post('message/send', 'MessagesController@send');

Route::get('form', function () {
    return view('form');
});

Route::get('test', function () {
    $api_key = '5256684d74e913d6085cc4c1d839a7c4b8245907b84f31b43462bc1b72179598';
    $client = new QuickPay(":$api_key");

    $response = $client->request->get('subscriptions/120004902');

    $json = $response->asArray();

    return $json;
});

Route::get('lirik/{id}', function ($id) {
    $api_key = '5256684d74e913d6085cc4c1d839a7c4b8245907b84f31b43462bc1b72179598';
    $client = new QuickPay(":$api_key");

    $response = $client->request->post('subscriptions/'.$id . '/session');

    $json = $response->asArray();

    return $json;
});


Route::any('dump', function(){
    $order = Auth::user()->order()->first();
    dd(strtotime($order->date) < strtotime('-30 day'));


});

Auth::routes();
