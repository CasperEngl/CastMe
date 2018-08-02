<?php

use Illuminate\Support\Facades\Session;

class Flash {
  public static function push($key, $value) {
    $values = Session::get($key, []);

    if (is_array($value))
      $values = array_merge($values, $value);

    else
      $values[] = $value;

    Session::flash($key, $values);

  }
}