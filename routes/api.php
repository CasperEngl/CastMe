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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::prefix('locale')->group(function () {
  // Localization
  Route::post('get/{locale}', 'LocaleController@get')->where('locale', '[a-zA-Z]+')->name('locale');
  Route::post('user/{id}', 'LocaleController@user')->name('locale.user');
});
