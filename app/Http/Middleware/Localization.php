<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Session;
use Auth;

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
    $user = Auth::user();

    if ($user) {
      App::setLocale($user->lang);
    }

    return $next($request);
  }
}
