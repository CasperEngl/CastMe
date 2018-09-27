<?php

if (!function_exists('sentence')) {
  /**
   * Return string with uppercase letters after '.', '!' or '?'
   *
   * @param string $string
   * @return string
   */
  function sentence(string $string) : string {
    $string = strtolower($string);
    
    return preg_replace_callback('/[.!?].*?\w/', function ($matches) {
      return strtoupper($matches[0]);
    }, ucfirst($string));
  }
}

if (!function_exists('strip_domain')) {
  /**
   * Strips http(s) protocol and trailing routes
   *
   * @param string $string
   * @return string
   */
  function strip_domain(string $string) : string {
    return preg_replace('/https|http|(:\/\/)|www\.|\/([^\/]*).*$/', '', $string);
  }
}

if (!function_exists('active_route')) {
  /**
   * Find out if route is current route
   * 
   * @param string $route
   * @param bool $output
   * @return bool|string
   */
  function active_route(string $route, bool $output = false) {
    if ($output)
      return Request::route()->getName() === $route ? 'active' : '';  
    else
      return Request::route()->getName() === $route;
  }
}

if (!function_exists('active_routes')) {
  /**
   * Find out if route is current route
   * 
   * @param array $routes
   * @param bool $output
   * @return bool|string
   */
  function active_routes(array $routes, bool $output = false) {
    if ($output)
      return in_array(Request::route()->getName(), $routes) ? 'active' : '';
    else
      return in_array(Request::route()->getName(), $routes);
  }
}

if (!function_exists('session_push')) {
  /**
   * Push key and value to session
   * 
   * @param string $key
   * @param string $value
   */
  function session_push($key, $value) {
    $values = Session::get($key, []);

    if (is_array($value))
      $values = array_merge($values, $value);
    else
      $values[] = $value;

    Session::flash($key, $values);
  }
}