<?php

namespace App\Helpers;

class StringFormat {
  public static function format($string) {
    return preg_replace_callback('/[.!?].*?\w/', function ($matches) {
      return strtoupper($matches[0]);
    }, ucfirst($string));
  }
}