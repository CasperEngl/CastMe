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

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use QuickPay\QuickPay;

// Homepage
Route::get('', 'HomeController@index')->name('home');

//User has to be logged in to access these
Route::group(['middleware' => ['auth']], function () {
  // Overview
  Route::get('overview', 'PagesController@overview')->name('overview');

  // Specific Profile
  Route::get('profile/{id}', 'ProfileController@user')->name('profile');

  Route::group(['prefix' => 'posts'], function () {
    // Posts
    Route::get('/', 'PostController@list')->name('posts');
    
    Route::middleware(['App\Http\Middleware\ScoutMiddleware'])->group(function () {
      Route::get('own', 'PostController@listOwn')->name('posts.own');
    });
  });

  Route::group(['prefix' => 'post'], function () {
    // Singular Post
    Route::get('{id}', 'PostController@index')->name('post');
    Route::get('{id}/data', 'PostController@data')->name('post.data');

    Route::middleware(['App\Http\Middleware\MemberMiddleware'])->group(function () {
      // Post Comment
      Route::post('comment/new', 'CommentController@new')->name('comment.new');
    });
    
    Route::middleware(['App\Http\Middleware\ScoutMiddleware'])->group(function () {
      // Create Post
      Route::get('new', 'PostController@new')->name('post.new');
      Route::post('add', 'PostController@add')->name('post.add');

      // Edit Post
      Route::get('{id}/edit', 'PostController@edit')->name('post.edit');
      Route::get('{id}/edit/data', 'PostController@data');
      Route::get('{id}/disable', 'PostController@disable')->name('post.disable');
      Route::get('{id}/enable', 'PostController@enable')->name('post.enable');
      Route::post('{id}/update', 'PostController@update')->name('post.update');
    });
  });

  Route::group(['prefix' => 'user'], function () {
    // Profile Settings
    Route::get('settings', 'ProfileController@index')->name('user.settings');
    Route::post('settings/update', 'ProfileController@update')->name('user.settings.update');
    
    // Subscription
    Route::get('subscription', 'SubscriptionController@index')->name('user.subscription');
    Route::post('subscription/create', 'SubscriptionController@create')->name('user.subscription.create');
    Route::post('subscription/swap', 'SubscriptionController@swap')->name('user.subscription.swap');

    // Invoice
    Route::get('subscription/invoice/{id}', 'SubscriptionController@invoice')->name('user.subscription.invoice');
  });

  Route::group(['prefix' => 'conversation', 'middleware' => 'App\Http\Middleware\MemberMiddleware'], function () {
    // Conversation (Singular)
    Route::get('{id}', 'ConversationController@index')->name('conversation');
    Route::post('send/{id}', 'ConversationController@send')->name('conversation.send');
  });

  Route::middleware(['App\Http\Middleware\MemberMiddleware'])->group(function () {
    // Conversations (List)
    Route::get('conversations', 'ConversationController@list')->name('conversations');
  });

  Route::group(['prefix' => 'locale'], function () {
    // Localization
    Route::get('/', 'LocaleController@index')->name('locale');
    Route::get('locale/{locale?}', 'LocaleController@get')->where('locale', '[a-zA-Z]+')->name('locale.get');
    Route::post('locale/set/{locale?}', 'LocaleController@set')->name('locale.set');
  });
});

Route::get('logout', function () {
  if (Auth::check()) {
    Auth::logout();
  }

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

  $response = $client->request->post('subscriptions/' . $id . '/session');

  $json = $response->asArray();

  return $json;
});

Route::any('dump', function () {
  $order = Auth::user()->order()->first();
  dd(strtotime($order->date) < strtotime('-30 day'));
});

Auth::routes();
