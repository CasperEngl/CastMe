<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function list()
    {
        return view('posts')->with('posts', Post::all());
    }
}
