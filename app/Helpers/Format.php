<?php

if (!function_exists('sentence')) {
  /**
   * Return string with uppercase letters after '.', '!' or '?'
   *
   * @param string $string
   * @return string
   */
  function sentence($string) {
    return preg_replace_callback('/[.!?].*?\w/', function ($matches) {
      return strtoupper($matches[0]);
    }, ucfirst($string));
  }
}

if (!function_exists('stripDomain')) {
  /**
   * Strips http(s) protocol and trailing routes
   *
   * @param string $string
   * @return string
   */
  function stripDomain($string) {
    return preg_replace('/https|http|(:\/\/)|www\.|\/([^\/]*).*$/', '', $string);
  }
}