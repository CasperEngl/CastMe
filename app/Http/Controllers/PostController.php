<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller {
  public function index() {
    return view('post');
  }

  public function new() {
    return view('post')->with([
      'title' => __('New post'),
      'post' => new Post,
    ]);
  }

  public function edit($id) {
    return view('post')->with([
      'title' => __('Edit post'),
      'post' => Post::find($id),
    ]);
  }

  public function list() {
    return view('posts')->with('posts', Post::orderBy('id', 'desc')->get());
  }

  public function send() {
    
  }
}
