<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $posts = Post::orderBy('id', 'desc')
      ->limit(4)
      ->get();

    return view('pages.home')->with('posts', $posts);
  }
}
