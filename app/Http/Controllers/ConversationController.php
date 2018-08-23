<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Crypt;

class ConversationController extends Controller {
  public function index($id) {
    return view('conversation.singular')->with([
      'form_url' => route('conversation.send', [
        'id' => $id,
      ]),
    ]);
  }

  public function list() {
    return view('conversation.list');
  }

  public function new(Request $request) {
    $user = Crypt::decrypt($request->input('user'));

    return response()->json([
      'user_crypt' => $request->input('user'),
      'user' => $user,
    ]);
  }

  public function send(Request $request) {
    dd($request->all());
  }
}
