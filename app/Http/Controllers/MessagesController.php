<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller {
  public function index() {
    //list all user messages
  }

  public function create() {
    //show form to create new message
  }

  public function send(Request $request) {
    if ( !Auth::check() )
      return redirect()->route('login')->with('error', ucfirst(__('login and try again')));

    if ( !in_array(Auth::user()->role, ['Scout', 'Moderator', 'Admin']) )
      return redirect()->route('home')->with('error', ucfirst(__('permission denied')));

    $request->validate([
      'title'    => 'required|min:3|max:255',
      'content'  => 'required',
      'receiver' => 'required',
    ]);

    Message::create([
      'sender'   => Auth::id(),
      'receiver' => $request->input('receiver'),
      'title'    => $request->input('title'),
      'content'  => $request->input('content'),
      'read'     => 0,
    ]);

    return redirect()->route('messages')->with('success', ucfirst(__('message sent')));
  }

  public function read($id) {
    $message = Message::find($id);

    if ( !in_array(Auth::id(), [$message->sender->id, $message->receiver->id]) )
      return redirect()->route('messages')->with('error', ucfirst(__('permission denied')));

    if ( Auth::id() == $message->receiver->id )
      $message->seen = 1;

    $message->save();

    return view('message', ['message' => $message]);
  }
}
