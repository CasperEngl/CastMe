<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Comment;
use App\PostRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Storage;

class PostController extends Controller {
  public function __construct() {
    $this->middleware('App\Http\Middleware\MemberMiddleware', [
      'except' => [
        'index',
        'list',
      ]
    ]);
    $this->middleware('App\Http\Middleware\ScoutMiddleware', [
      'only' => [
        'new',
        'edit',
        'listOwn',
        'add',
        'update',
        'toggle',
      ]
    ]);
  }

  public function index($id) {
    $post = Post::find($id);
    
    if ($post->closed && $post->user_id !== Auth::id())
      return redirect()->back()->withErrors([
        ucfirst(__('that post no longer exists.'))
      ]);

    if ($post)
      return view('post.singular')->with([
        'post' => $post,
        'comments' => $post->comments,
        'owner' => Auth::id() === $post->owner->id,
      ]);
    else
      return redirect()->route('post.list')->withErrors([
        ucfirst(__('sorry, that post doesn\'t exist'))
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

  public function list() {
    $posts = Post::orderBy('id', 'desc')->get();

    return view('post.list', [
      'title' => ucfirst(__('posts')),
      'posts' => $posts,
      'own' => false,
    ]);
  }

  public function new() {
    $user = Auth::user();

    return view('post.build')->with([
      'title' => ucfirst(__('new job post')),
      'post' => new Post,
      'form_url' => route('post.add'),
      'type' => ucfirst(__('add'))
    ]);
  }

  public function edit($id) {
    $user = Auth::user();
    $post = Post::find($id);

    if ($user->id !== $post->user_id && !in_array($user->role, ['Admin', 'Moderator']))
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

  public function listOwn() {
    $posts = Post::orderBy('id', 'desc')
      ->where('user_id', Auth::id())
      ->get();

    return view('post.list', [
      'title' => ucfirst(__('your posts')),
      'posts' => $posts,
      'own' => true,
    ]);
  }

  public function add(Request $request) {
    $request->validate([
      'title'   => 'required|max:255',
      'image.*' => 'nullable|url',
      'roles.*' => 'nullable|string',
    ]);

    if ($banner = $request->file('banner')) {
      if ($banner->getSize() / 1000 > 2000) {
        return redirect()->back()->withErrors([
          sentence(__('Sorry, that avatar image is too big. Max file size is 2 MB.')),
        ]);
      }

      if ($banner->isValid() !== true) {
        return redirect()->back()->withErrors([
          sentence(__('there was an issue with your image. please try uploading again, or find another avatar')),
        ]);
      }

      $storedFile = Storage::disk('public')->put('banner', $banner);
    }

    $post = new Post([
      'title'   => $request->input('title', false),
      'images'  => json_encode($request->input('image.*')),
      'content' => $request->input('content'),
      'location' => $request->input('location'),
      'banner'  => isset($storedFile) ? $storedFile : 'placeholder/banner.png',
      'user_id' => Auth::id()
    ]);

    $post->save();

    if ($request->input('roles.*')) {
      foreach ($request->input('roles.*') as $role) {
        if (!in_array(strtolower($role), PostRole::getPossibleRoles())) {
          return redirect()->back()->withErrors([
            ucfirst(__('"' . $role . '" is not a valid role')),
          ]);
        }

        // Create the post role
        PostRole::create([
          'post_id' => $post->id,
          'role' => str_replace('_', ' ', $role),
        ]);
      }
    }

    session_push('success', sentence(__('your post has been created!')));
    return redirect()->route('posts');
  }

  public function update(Request $request, $id) {
    $post = Post::find($id);
    $postRoles = $post->postRoles;

    $request->validate([
      'title'   => 'required|max:255',
      'image.*' => 'nullable|url',
      'roles.*' => 'nullable|string',
    ]);

    if ($banner = $request->file('banner')) {
      if ($banner->getSize() / 1000 > 2000) {
        return redirect()->back()->withErrors([
          sentence(__('Sorry, that avatar image is too big. Max file size is 2 MB.')),
        ]);
      }

      if ($banner->isValid() !== true) {
        return redirect()->back()->withErrors([
          sentence(__('there was an issue with your image. please try uploading again, or find another avatar')),
        ]);
      }

      $storedFile = Storage::disk('public')->put('banner', $banner);
    }

    if ($post->user_id !== Auth::id() && !in_array(Auth::user()->role, ['Admin', 'Moderator']))
      return redirect()->route('overview')->withErrors([
        ucfirst(__('unauthorized access'))
      ]);

    if ($request->input('roles.*')) {
      // Delete post roles
      foreach ($postRoles as $postRole) {
        $postRole->delete();
      }

      foreach ($request->input('roles.*') as $role) {
        if (!in_array(strtolower($role), PostRole::getPossibleRoles())) {
          return redirect()->back()->withErrors([
            ucfirst(__('"' . $role . '" is not a valid role')),
          ]);
        }

        // Create the post role
        PostRole::create([
          'post_id' => $post->id,
          'role' => str_replace('_', ' ', $role),
        ]);
      }
    }

    $post->title    = $request->input('title');
    $post->images   = json_encode($request->input('image.*'));
    $post->banner   = isset($storedFile) ? $storedFile : $post->banner;
    $post->content  = $request->input('content');
    $post->location = $request->input('location');

    $post->save();

    return redirect()->route('post', ['id' => $post->id]);
  }

  public function toggle(int $id) {
    $post = Post::find($id);

    if ($post->user_id !== Auth::id() && !in_array(Auth::user()->role, ['Admin', 'Moderator']))
      return redirect()->back()->withErrors([
        ucfirst(__('oops, looks like that post doesn\'t belong to you.'))
      ]);

    $post->closed = !$post->closed;
    $post->save();

    // If the post is closed
    if ($post->closed) {
      session_push('success', sentence(__('your post is now disabled. it will no longer be visible to the public.')));
      return redirect()->route('posts');
    } else { // If the post is not closed
      session_push('success', sentence(__('your post is now enabled. it is now visible to the public.')));
      return redirect()->route('post', ['id' => $post->id]);
    }
  }

  public function search(Request $request) {
    $posts = Post::search($request->q, null, true)
      ->with('user')
      ->with('postRoles')
      ->get()
      ->unique();

    return view('post.list', [
      'title' => ucfirst(__('posts')),
      'posts' => $posts,
      'own' => false,
    ]);
  }
}
