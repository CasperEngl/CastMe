<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\Flash;

class PostController extends Controller {
  public function index($id) {
    $post = Post::find($id);

    if ($post)
      return view('post')->with([
        'post' => $post,
      ]);
    else
      return redirect('posts')->withErrors([
        'Sorry, that post doesn\'t exist'
      ]);
  }

  public function new() {
    return view('post-build')->with([
      'title' => __('new post'),
      'post' => new Post,
      'type' => __('add')
    ]);
  }

  public function edit($id) {
    $user = Auth::user();
    $post = Post::find($id);

    if ($user->id !== $post->user_id) {
      return redirect('overview')->withErrors([
        'You do not own that post.',
      ]);
    }

    return view('post-build')->with([
      'title' => __('edit post'),
      'post' => $post,
      'type' => __('update'),
    ]);
  }

  public function list() {
    return view('posts')->with('posts', Post::orderBy('id', 'desc')->get());
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
                       'content'     => $request->input('message'),
                       'user_id'     => Auth::id()
                     ]);
    $post->save();

    Flash::push('success', 'Your post has been created!');
    return redirect('/posts');
  }

  public function update(Request $request) {
    Flash::push('success', 'Your post has been edited!');
    return redirect('/posts');
  }
}
