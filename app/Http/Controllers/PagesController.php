<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Contact;
use Mail;

class PagesController extends Controller {
  protected $static;
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->static = true;
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
      'static' => $this->static,
    ]);
  }

  public function terms() {
    return view('pages.terms')->with([
      'static' => $this->static,
    ]);
  }

  public function privacy() {
    return view('pages.privacy')->with([
      'static' => $this->static,
    ]);
  }

  public function guides() {
    return view('pages.guides')->with([
      'static' => $this->static,
    ]);
  }

  public function aboutUs() {
    return view('pages.about-us')->with([
      'static' => $this->static,
    ]);
  }

  public function contact() {
    return view('pages.contact')->with([
      'static' => $this->static,
    ]);
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
          $message
            ->to(env('MAIL_CONTACT_RECEIVER_ADDRESS', 'support@castme.dk'), env('MAIL_FROM_NAME', 'Admin'))
            ->subject('Cast Me - Contact Form');
      }
    );

    session_push('success', sentence(__('thank you for contacting us. we will be with you soon.')));
    return redirect()->back();
  }

  //////// agent contact form start /////////

  public function contactAgent() {
    return view('pages.contactagent')->with([
      'static' => $this->static,
    ]);
  }

  public function contactAgentPost(Request $request) {
    $this->validate($request, [
      'name' => 'required',
      'email' => 'required|email',
      'company' => 'required|company',
      'cvr' => 'required|cvr',
      'message' => 'required'
    ]);

    Contact::create($request->all());

    Mail::send('email.contact',
       array(
          'name' => $request->get('name'),
          'email' => $request->get('email'),
          'user_message' => $request->get('message'),
          'cvr' => $request->get('cvr'),
          'company' => $request->get('company')
        ), 
        function($message) {
          $message
            ->to(env('MAIL_CONTACT_RECEIVER_ADDRESS', 'support@castme.dk'), env('MAIL_FROM_NAME', 'Admin'))
            ->subject('Cast Me - Contact Form');
      }
    );

    session_push('success', sentence(__('thank you for contacting us. we will be with you soon.')));
    return redirect()->back();
  }

}

  //////// agent contact form end /////////