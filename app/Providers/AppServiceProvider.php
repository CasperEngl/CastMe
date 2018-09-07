<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Cashier\Cashier;
use Blade;
use Auth;

class AppServiceProvider extends ServiceProvider {
  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot() {
    Cashier::useCurrency('DKK', 'kr');
    date_default_timezone_set('Europe/Amsterdam');

    Blade::if('free', function () {
      return !in_array(Auth::user()-role, ['Free']);
    });

    Blade::if('paid', function () {
      return in_array(Auth::user()->role, ['Admin', 'Moderator', 'Scout', 'Paid']);
    });

    Blade::if('scout', function () {
      return in_array(Auth::user()->role, ['Admin', 'Moderator', 'Scout']);
    });

    Blade::if('moderator', function() {
      return in_array(Auth::user()->role, ['Admin', 'Moderator']);
    });

    Blade::if('admin', function () {
      return in_array(Auth::user()->role, ['Admin']);
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
