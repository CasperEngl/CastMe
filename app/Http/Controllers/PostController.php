<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {
  public function index() {
    return view('post');
  }

  public function new() {
    return view('post')->with([
                                'title' => __('New post'),
                                'post'  => new Post,
                              ]);
  }

  public function edit($id) {
    return view('post')->with([
                                'title' => __('Edit post'),
                                'post'  => Post::find($id),
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

    return redirect('/posts');
  }

  public function update() {

  }
}
