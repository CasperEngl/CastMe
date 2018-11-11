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

Route::middleware('App\Http\Middleware\Localization')->group(function() {
  // Homepage
  Route::get('/', 'PagesController@home')->name('pages.home');
  Route::get('terms', 'PagesController@terms')->name('pages.terms');
  Route::get('contact', 'PagesController@contact')->name('pages.contact');
  Route::post('contact', 'PagesController@contactPost')->name('pages.contact.post');
  Route::get('privacy', 'PagesController@privacy')->name('pages.privacy');
  Route::get('guides', 'PagesController@guides')->name('pages.guides');
  Route::get('about-us', 'PagesController@aboutUs')->name('pages.about-us');

  // Specific Profile
  Route::get('profile/{id}', 'ProfileController@index')->name('profile');

  // Posts
  Route::get('posts', 'PostController@list')->name('posts');

  // Singular Post
  Route::get('post/{id}', 'PostController@index')->name('post');
  Route::get('post/{id}/data', 'PostController@data')->name('post.data');

  // User has to be logged in to access these
  Route::group(['middleware' => ['auth']], function () {
    // Overview
    Route::get('overview', 'PagesController@overview')->name('overview');

    // Profile Settings
    Route::get('user/settings', 'ProfileController@settings')->name('user.settings');
    Route::post('user/settings/update', 'ProfileController@update')->name('user.settings.update');
    Route::get('user/settings/gallery/delete/{id}', 'ProfileController@deleteImage')->name('user.gallery.delete');

    // Subscription
    Route::get('user/subscription', 'SubscriptionController@index')->name('user.subscription');
    Route::post('user/subscription/create', 'SubscriptionController@create')->name('user.subscription.create');
    Route::post('user/subscription/swap', 'SubscriptionController@swap')->name('user.subscription.swap');

    // Invoice
    Route::get('user/subscription/invoice/{id}', 'SubscriptionController@invoice')->name('user.subscription.invoice');

    // START MEMBER
    // Conversation (Singular)
    Route::get('conversation/{id}', 'ConversationController@index')->name('conversation');
    Route::post('conversation/send/{id}', 'ConversationController@send')->name('conversation.send');
    Route::post('conversation/new', 'ConversationController@new')->name('conversation.new');

    // Conversations (List)
    Route::get('conversations', 'ConversationController@list')->name('conversations');

    // Post Comment
    Route::post('post/comment/new', 'CommentController@new')->name('comment.new');
    // END MEMBER

    // START SCOUT
    // Get own posts
    Route::get('posts/own', 'PostController@listOwn')->name('posts.own');

    // Create Post
    Route::get('post/new', 'PostController@new')->name('post.new');
    Route::post('post/add', 'PostController@add')->name('post.add');

    // Edit Post
    Route::get('post/{id}/edit', 'PostController@edit')->name('post.edit');
    Route::get('post/{id}/edit/data', 'PostController@data');
    Route::get('post/{id}/toggle', 'PostController@toggle')->name('post.toggle');
    Route::post('post/{id}/update', 'PostController@update')->name('post.update');
    // END SCOUT
  });

  Route::post('locale/set', 'LocaleController@set')->name('locale.set');
});

Route::get('logout', function () {
  if (Auth::check()) {
    Auth::logout();
  }

  return redirect()->intended('/login');
});

Auth::routes();
