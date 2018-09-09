<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helpers\Flash;
use App\Helpers\Format;
use Storage;

class PostController extends Controller {
  public function index($id) {
    $post = Post::find($id);

    if ($post)
      return view('post.singular')->with([
        'post' => $post,
        'comments' => $post->comments,
        'owner' => Auth::id() === $post->owner->id,
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
    $posts = Post::orderBy('id', 'desc')->get();

    return view('post.list', [
      'title' => ucfirst(__('posts')),
      'posts' => $posts,
    ]);
  }

  public function listOwn() {
    $posts = Post::orderBy('id', 'desc')
      ->where('user_id', Auth::id())
      ->get();

    return view('post.list', [
      'title' => ucfirst(__('your posts')),
      'posts', $posts
    ]);
  }

  public function add(Request $request) {
    if (!in_array(Auth::user()->role, ['Admin', 'Moderator', 'Scout']))
      return abort(403, 'Unauthorized action.');

    $banner = $request->file('banner');

    if ($banner) {
      if ($banner->getSize() / 1000 > 2000) {
        return redirect()->back()->withErrors([
          Format::string('Sorry, that avatar image is too big. Max file size is 2 MB.'),
        ]);
      }

      if ($banner->isValid() !== true) {
        return redirect()->back()->withErrors([
          Format::string('there was an issue with your image. please try uploading again, or find another avatar'),
        ]);
      }

      $storedFile = Storage::disk('public')->put('banner', $banner);
    }

    $request->validate([
      'title'   => 'required|max:255',
      'image.*' => 'nullable|url',
    ]);

    $roles = [];
    
    if ($request->input('roles.*')) {
      foreach ($request->input('roles.*') as $role) {
        if (!in_array($role, ['actor', 'dancer', 'entertainer', 'event_staff', 'extra', 'model', 'musician', 'other'])) {
          return redirect()->back()->withErrors([
            ucfirst(__('"' . $role . '" is not a valid role')),
          ]);
        }

        $roles[] = $role;
      }
    }

    $post = new Post([
      'title'   => $request->input('title', false),
      'roles'   => json_encode($roles),
      'images'  => json_encode($request->input('image.*')),
      'content' => $request->input('content'),
      'banner'  => isset($storedFile) ? $storedFile : 'banner.svg',
      'user_id' => Auth::id()
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

    foreach ($request->input('roles.*') as $role) {
      if (!in_array($role, ['actor', 'dancer', 'entertainer', 'event_staff', 'extra', 'model', 'musician', 'other'])) {
        return redirect()->back()->withErrors([
          ucfirst(__('"' . $role . '" is not a valid role')),
        ]);
      }

      $roles[] = $role;
    }

    $post->title    = $request->input('title');
    $post->roles    = json_encode($roles);
    $post->images   = json_encode($request->input('image.*'));
    $post->content  = $request->input('content');

    $post->save();

    return redirect()->route('posts');
  }

  public function dump(Request $request) {
    dd($request->all());
  }
}
