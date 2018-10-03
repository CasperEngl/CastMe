<?php

namespace App\Http\Controllers;

use App\Helpers\Flash;
use App\Helpers\Format;
use App\Message;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Auth;
use App\Conversation;
use App\User;
/**
 * @mixin \Eloquent
 */
class ConversationController extends Controller {
  public function __construct() {
    $this->middleware('App\Http\Middleware\MemberMiddleware');
    $this->middleware('App\Http\Middleware\ScoutMiddleware', [
      'only' => [
        'new'
      ]
    ]);
  }

  public function index($id) {
    try { //Find conversation
      $conversation = Conversation::findOrFail($id);
    } catch (ModelNotFoundException $exception) { //Conversation could not be found
      return redirect()->route('conversations')->withErrors([
        ucfirst(__('conversation not found'))
      ]);
    }

    //Don't allow user to read conversation if he's not part of it
    if(!$conversation->users->contains(Auth::user()))
      return redirect()->route('conversations')->withErrors([
        ucfirst(__('conversation not found'))
      ]);

    if ($conversation->new()) {
      $users = $conversation->users;

      foreach ($users as $user) {
        if ($user->id !== Auth::id())
          Message::where('user_id', $user->id)->update([
            'new' => 0,
          ]);
      }
    }

    return view('conversation.singular')->with([
      'form_url' => route('conversation.send', ['id' => $id]),
      'messages' => $conversation->messages,
      'users' => $conversation->users,
    ]);
  }

  public function list() {    
    $conversations = Auth::user()->conversations;

    return view('conversation.list')->with([
      'conversations' => $conversations
    ]);
  }

  public function new(Request $request) {
    // Check if user is taking part in conversation
    if (!in_array(Auth::id(), $request->input('users')))
      return redirect()->back()->withErrors([
        sentence(__('you are not part of this conversation.'))
      ]);

    // If only one unique user id is in the array, that means user tries to message themselves
    if (count(array_unique($request->input('users'))) === 1)
      return redirect()->back()->withErrors([
        sentence(__('you cannot message yourself'))
      ]);

    if ($id = $this->checkIfExist($request->input('users')))
      return redirect()->route('conversation', ['id' => $id]);

    $conversation = new Conversation();
    $conversation->save();

    foreach ( $request->input('users') as $userId ) {
      User::find($userId)->conversations()->attach($conversation->id);
    }

    return redirect()->route('conversation', [
      'id' => $conversation->id,
    ]);
  }

  private function checkIfExist(Array $users) : int {
    $users = User::whereIn('id', $users)->get();
    $conversations = Conversation::with('users')->get();

    foreach ( $conversations as $conversation ) {
      if($users->diff($conversation->users)->count() == 0)
        return $conversation->id;
    }

    return 0;
  }

  public function send(Request $request, $conversationId) {
    $message = new Message();
    $message->user_id = Auth::id();
    $message->content = $request->input('content');
    $message->conversation_id = $conversationId;
    $message->save();

    session_push('success', sentence(__('your message was sent!')));
    return redirect()->back();
  }
}
