<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Contact;
use Mail;

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

  public function contactPost(Request $request) {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email',
      'message' => 'required'
    ]);

    Contact::create($request->all());

    Mail::send('email.contact',
       array(
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'user_message' => $request->get('message')
        ), 
        function($message) {
          $message->from('system@castme.dk');
          $message->to('support@castme.dk', 'Admin')->subject('Cast Me - Contact Form');
      }
    );

    session_push('success', sentence(__('thank you for contacting us. we will be with you soon.')));
    return redirect()->back();
  }
}
