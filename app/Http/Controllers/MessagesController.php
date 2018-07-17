<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller
{
    public function index()
    {
        //list all user messages
    }

    public function create()
    {
        //show form to create new message
    }

    public function send(Request $request)
    {
        if (!Auth::check())
            return redirect('/login')->with('error', __('Login and try again'));

        if (!in_array(Auth::user()->role, ['Scout', 'Moderator', 'Admin']))
            return redirect('/home')->with('error', __('Permission denied'));

        $validatedData = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required',
        ]);

        return "WORKED";
    }

    public function read($id)
    {
        //show message
    }
}
