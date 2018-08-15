<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Session;
use File;
use Response;

class LocaleController extends Controller
{
    public function index() {
        return App::getLocale();
    }

    public function set($locale) {
        Session::put('locale', $locale);
        return redirect()->back();
    }

    public function get($locale = null) {
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
            return response()->json([
                'lang' => App::getLocale(),
            ]);
        }
    }
}
