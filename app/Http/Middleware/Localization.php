<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Session;
use Auth;
use Cookie;

class Localization {
  /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  \Closure                 $next
   *
   * @return mixed
   */
  public function handle($request, Closure $next) {
    if (Auth::check()) {
      $user = Auth::user();
      $locale = $user->lang;

      Cookie::queue('lang', $user->lang);
    } else if (!Cookie::get('lang')) {
      $locale = 'da';
      
      Cookie::queue('lang', $locale);
    } else {
      $locale = Cookie::get('lang');
    }

    App::setLocale($locale);

    return $next($request);
  }
}
