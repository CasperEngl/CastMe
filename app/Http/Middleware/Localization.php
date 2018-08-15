<?php

namespace App\Http\Middleware;

use Closure;
use App;
use Session;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Session::has('locale')) {
            App::setLocale(Session::get('locale'));

            return $next($request);
        }

        // read the language from the request header
        $locale = $request->header('Content-Language');

        // if the header is missed
        if(!$locale){
            // take the default local language
            $locale = $this->app->config->get('app.locale');
        }

        // check the languages defined is supported
        if (!array_key_exists($locale, $this->app->config->get('app.supported_languages'))) {
            // respond with error
            return abort(403, 'Language not supported.');
        }

        // set the local language
        $this->app->setLocale($locale);

        // get the response after the request is done
        $response = $next($request);

        // set Content Languages header in the response
        $response->headers->set('Content-Language', $locale);

        // return the response
        return $response;
    }
}
