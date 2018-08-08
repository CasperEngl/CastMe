<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConversationController extends Controller {
  public function index($id) {
    return view('conversation.singular');
  }

  public function list() {
    return view('conversation.list');
  }
}
