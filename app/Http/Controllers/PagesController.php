<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;

class PagesController extends Controller {
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    
  }

  public function overview() {
    return view('overview');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function home() {
    $posts = Post::orderBy('id', 'desc')
      ->where('closed', 0)
      ->limit(8)
      ->get();
    $latestUsers = User::orderBy('id', 'desc')
      ->limit(1)
      ->get();
    $showcasedUsers = User::inRandomOrder()
      ->limit(1)
      ->get();

    return view('pages.home')->with([
      'posts' => $posts,
      'latestUsers' => $latestUsers,
      'showcasedUsers' => $showcasedUsers,
    ]);
  }

  public function terms() {
    return view('pages.terms');
  }

  public function contact() {
    return view('pages.contact');
  }
}
