<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use Auth;
use Mail;

class ManageUserController extends Controller {
    public function index() {
        return view('admin.users.manage');
    }

    public function new() {
        return view('admin.users.create');
    }

    public function create(Request $request) {
        $registrant = Auth::user();

        $validator = $request->validate([
            'name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => title_case($request->name),
            'last_name' => title_case($request->last_name),
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make(str_random(20)),
            'created_by' => $registrant->id,
        ]);

        return response()->json($user);

        Mail::send('email.registered',
            array(
                'user' => $user,
                'registrant' => $registrant,
            ), 
            function($message) {
                $message
                    ->to($user->email, env('MAIL_FROM_NAME'))
                    ->subject(__('Cast Me - You are registered!'));
            }
        );

        session_push('success', $user->name . ' ' . __('was created.'));
        return redirect()->route('overview');
    }

    public function view($id) {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('overview')->withErrors([
                sentence(__('no user with that id exists.'))
            ]);
        }

        return response()->json($user);
    }
}
