<?php

namespace App\Http\Controllers;

use App\Helpers\Flash;
use App\Helpers\Format;
use Illuminate\Foundation\Auth\User;
use Illuminate\Http\Request;
use Auth;
use Crypt;
use App\Conversation;
use Illuminate\Support\Facades\DB;

class ConversationController extends Controller {
  public function index($id) {
    if (Auth::id() === (int)$id) {
      return redirect()->back()->withErrors([
        Format::string(__('you cannot message yourself.'))
      ]);
    }

    $replies = Conversation::where('receiver_id', $id)
      ->where('sender_id', Auth::id())
      ->orWhere('receiver_id', Auth::id())
      ->where('sender_id', $id)
      ->get();

    return view('conversation.singular')->with([
      'form_url' => route('conversation.send', ['id' => $id]),
      'messages' => $replies
    ]);
  }

  public function list() {
    $conversations = Conversation::where('receiver_id', Auth::id())->get();

    return view('conversation.list')->with([
      'conversations' => $conversations
    ]);
  }

  public function new(Request $request) {

    return redirect()->route('conversation', [
      'id' => $request->input('user'),
    ]);
  }

  public function send(Request $request, User $user) {
    $message = new Conversation([
      'sender_id' => Auth::id(),
      'receiver_id' => $user->id,
      'content' => $request->input('content'),
      'read' => false,
    ]);

    $message->save();

    Flash::push('success', Format::string(__('your message was sent!')));
    return redirect()->back();
  }
}
