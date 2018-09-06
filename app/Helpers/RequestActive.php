<?php

namespace App\Helpers;

use Request;

class RequestActive {
  /**
   * Return active value for given route
   * @param string $route the first number to add
   * @param boolean $output makes function return 'active' as string if true
   * @return boolean $output is false
   * @return string $output is true
   */

  public static function route($route, $output = false) {
    if (is_array($route)) {
      if ($output)
        return in_array(Request::route()->getName(), $route) ? 'active' : '';
      else
        return in_array(Request::route()->getName(), $route);
    } else {
      if ($output)
        return Request::route()->getName() === $route ? 'active' : '';  
      else
        return Request::route()->getName() === $route;
    }
  }
}