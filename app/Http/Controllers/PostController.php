<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\Flash;

class PostController extends Controller {
  public function index($id) {
    $post = Post::findOrFail($id);
    $comments = $post->comments;

    if ($post)
      return view('post.singular')->with([
        'post' => $post,
        'comments' => $comments
      ]);
    else
      return redirect()->route('post.list')->withErrors([
        'Sorry, that post doesn\'t exist'
      ]);
  }

  public function data($id) {
    $post = Post::find($id);

    if ($post)
      return response()->json($post);
    else
      return response()->json([
        'error' => 'Could not find any posts with that id',
      ]);
  }

  public function new() {
    $user = Auth::user();

    if (!in_array($user->role, ['Scout', 'Moderator', 'Admin']))
      return redirect()->route('overview')->withErrors([
        'You do not have access to create posts.'
      ]);

    return view('post.build')->with([
      'title' => ucfirst(__('new post')),
      'post' => new Post,
      'form_url' => route('post.add'),
      'type' => ucfirst(__('add'))
    ]);
  }

  public function edit($id) {
    $user = Auth::user();
    $post = Post::find($id);

    if ($user->id !== $post->user_id)
      return redirect()->route('overview')->withErrors([
        'You do not own that post.',
      ]);

    return view('post.build')->with([
      'title' => ucfirst(__('edit post')),
      'post' => $post,
      'form_url' => route('post.update', [
        'id' => $id,
      ]),
      'type' => ucfirst(__('update')),
    ]);
  }

  public function list() {
    return view('post.list')->with('posts', Post::orderBy('id', 'desc')->get());
  }

  public function add(Request $request) {
    if (!in_array(Auth::user()->role, ['Admin', 'Moderator', 'Scout']))
      return abort(403, 'Unauthorized action.');

    $request->validate([
      'title'   => 'required|max:255',
      'image.*' => 'nullable|url',
    ]);

    $post = new Post([
      'title'       => $request->input('title', false),
      'actor'       => $request->input('actor', false),
      'dancer'      => $request->input('dancer', false),
      'entertainer' => $request->input('entertainer', false),
      'event_staff' => $request->input('event_staff', false),
      'extra'       => $request->input('extra', false),
      'model'       => $request->input('model', false),
      'musician'    => $request->input('musician', false),
      'images'      => json_encode($request->input('image.*')),
      'content'     => $request->input('content'),
      'user_id'     => Auth::id()
    ]);

    $post->save();

    Flash::push('success', 'Your post has been created!');
    return redirect()->route('posts');
  }

  public function update(Request $request, $id) {
    if (!in_array(Auth::user()->role, ['Admin', 'Moderator', 'Scout']))
      return abort(403, 'Unauthorized action.');

    $request->validate([
      'title'   => 'required|max:255',
      'image.*' => 'nullable|url',
    ]);

    $post = Post::find($id);

    if ($post->user_id !== Auth::id())
      return redirect()->route('overview')->with(['errors' => ['Unauthorized access']]);

    $post->title       = $request->input('title');
    $post->actor       = $request->input('actor', false);
    $post->dancer      = $request->input('dancer', false);
    $post->entertainer = $request->input('entertainer', false);
    $post->event_staff = $request->input('event_staff', false);
    $post->extra       = $request->input('extra', false);
    $post->model       = $request->input('model', false);
    $post->musician    = $request->input('musician', false);
    $post->images      = json_encode($request->input('image.*'));
    $post->content     = $request->input('content');

    $post->save();

    return redirect()->route('posts');
  }

  public function dump(Request $request) {
    dd($request->all());
  }
}
