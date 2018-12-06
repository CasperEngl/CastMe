<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Blade;
use Auth;

class AppServiceProvider extends ServiceProvider {
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {
    date_default_timezone_set('Europe/Amsterdam');

    Blade::if('free', function () {
      if (!Auth::check())
        return false;

      return in_array(Auth::user()->role, ['Admin', 'Moderator', 'Scout', 'Paid', 'Free']);
    });

    Blade::if('paid', function () {
      if (!Auth::check())
        return false;

      return in_array(Auth::user()->role, ['Admin', 'Moderator', 'Scout', 'Paid']);
    });

    Blade::if('scout', function () {
      if (!Auth::check())
        return false;

      return in_array(Auth::user()->role, ['Admin', 'Moderator', 'Scout']);
    });

    Blade::if('moderator', function() {
      if (!Auth::check())
        return false;

      return in_array(Auth::user()->role, ['Admin', 'Moderator']);
    });

    Blade::if('admin', function () {
      if (!Auth::check())
        return false;

      return in_array(Auth::user()->role, ['Admin']);
    });

    Blade::if('onlyuser', function () {
      if (!Auth::check())
        return false;

      return in_array(Auth::user()->role, ['Free', 'Paid', 'Admin']);
    });
  }

  /**
   * Register any application services.
   *
   * @return void
   */
  public function register() {
    if ( $this->app->environment() !== 'production' ) {
      $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
    }
  }
}
