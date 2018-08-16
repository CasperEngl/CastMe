<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\StringFormat;
use App;
use Session;
use File;
use Response;
use Auth;

class LocaleController extends Controller {
    protected $supported_languages;

    public function __construct() {
        $this->supported_languages = config('app.supported_languages');
    }

    // Parse accept languages and return array list
    protected function parse_accept_language($acceptLanguage) {
        // Prioritized languages
        $languages = [];
        // If we have a comma-separated language list
        // we'll wanna split them up into an array
        $acceptedLanguages = strstr($acceptLanguage, ',') ? explode(',',
            str_replace(' ', '', $acceptLanguage)) : [$acceptLanguage];
        // Parse each found language and generate
        // an array of prioritized languages
        foreach ($acceptedLanguages as $acceptedLanguage) {
            $acceptedLanguage = strstr($acceptedLanguage, ';') ? explode(';', $acceptedLanguage) : $acceptedLanguage;
            if (is_array($acceptedLanguage)) {
                $weight = explode('=', $acceptedLanguage[1])[1];
                $languages[(string)$weight][] = $acceptedLanguage[0];
            } else {
                $languages['1.0'][] = $acceptedLanguage;
            }
        }
        // Reverse sort priority list
        // 1.0 -> 0.0
        krsort($languages);
        return array_flatten($languages);
    }

    protected function supported_languages_preg() {
        // Start preg creation
        $preg = '/^';

        foreach ($this->supported_languages as $key => $value) {
            $preg .= $key . '|';

            end($supported_languages);
            if ($key === key($supported_languages))
                $preg .= $key;
        }

        $preg .= '$/';
        // End preg creation

        return $preg;
    }

    protected function return_preg_language_matches($preg, $accept_language) {
        preg_match(
            $preg,
            $this->parse_accept_language($accept_language)[0],
            $match
        );

        return $match;
    }

    public function index() {
        return App::getLocale();
    }

    public function set(Request $request) {
        $user = Auth::user();

        if ($user) {
            $user->lang = $request->input('locale') ? $request->input('locale') : $user->lang;
            $user->save();

            App::setLocale($user->lang);
        } else {
            return redirect()->back()->withErrors([
                StringFormat::format(__('sorry, could not save your language setting. please try again. if the issue persists, please contact the site administrator.'))
            ]);
        }

        return redirect()->back();
    }

    public function get($locale = null, Request $request) {
        if ($locale !== null) {
            $file_path = base_path('resources/lang/' . $locale . '.json');

            if (File::exists($file_path)) {
                $json = json_decode(file_get_contents($file_path), true);

                return response()->json($json);
            } else {
                return response()->json([
                    'error' => 'Locale file does not exist.',
                ]);
            }
        } else {
            $preg = $this->supported_languages_preg();

            return response()->json(print_r($request->session()));

            if (Session::get('locale'))
                $accept_language = $request->session()->get('locale');
            else
                $accept_language = $request->server('HTTP_ACCEPT_LANGUAGE');

            // Check if client language (HTTP_ACCEPT_LANGUAGE) is in supported languages with preg
            $client_lang = $this->return_preg_language_matches($preg, $accept_language);
            $file_path = base_path('resources/lang/' . $client_lang[0] . '.json');

            if (isset($client_lang[0]) && File::exists($file_path)) {
                return response()->json([
                    'lang' => $client_lang[0]
                ]);
            } else {
                return response()->json([
                    'lang' => App::getLocale(),
                ]);
            }
        }
    }
}
