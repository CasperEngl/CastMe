<?php

namespace App\Helpers;

class Format {
  public static function string($string) {
    return preg_replace_callback('/[.!?].*?\w/', function ($matches) {
      return strtoupper($matches[0]);
    }, ucfirst($string));
  }

  public static function stripDomain($string) {
    return preg_replace('/https|http|(:\/\/)|www\.|\/([^\/]*).*$/', '', $string);
  }
}