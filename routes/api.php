<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('locale/{locale?}', 'LocaleController@get')->name('locale.get');

//Stripe webhooks
Route::post(
  'stripe/webhook',
  '\Laravel\Cashier\Http\Controllers\WebhookController@handleWebhook'
);