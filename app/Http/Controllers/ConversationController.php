<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

  public function send(Request $request) {
    dd($request->all());
  }
}
