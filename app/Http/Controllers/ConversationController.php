<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Crypt;
use App\Conversation;

class ConversationController extends Controller {
  public function index($id) {
    $replies = Conversation::where('receiver_id', $id)
      ->latest()
      ->get();

    return view('conversation.singular')->with([
      'form_url' => route('conversation.send'),
      'messages' => $replies
    ]);
  }

  public function list() {
    return view('conversation.list');
  }

  public function new(Request $request) {

    return redirect()->route('conversation', [
      'id' => Crypt::decrypt($request->input('user')),
    ]);
  }

  public function send(Request $request) {
    $user = Crypt::decrypt($request->input('user'));

    $message = new Conversation([
      'sender_id' => Auth::id(),
      'receiver_id' => $user,
      'content' => $request->input('content'),
      'read' => false,
    ]);

    $message->save();

    Flash::push('success', StringFormat::format(__('your message was sent!')));
    return redirect()->back();
  }
}
