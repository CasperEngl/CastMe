<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\ProfileDetails;
use Auth;
use Mail;

class ManageUserController extends Controller {
    public function __construct() {
        $this->middleware('App\Http\Middleware\ModeratorMiddleware');
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

        $details = ProfileDetails::create();
        $details->user_id = $user->id;
        $details->save();

        Mail::send('email.registered',
            array(
                'user' => $user,
                'registrant' => $registrant,
            ), 
            function($message) use ($user) {
                $message
                    ->to($user->email, env('MAIL_FROM_NAME'))
                    ->subject(__('Cast Me - You are registered!'));
            }
        );

        session_push('success', $user->name . ' ' . __('was created.'));
        return redirect()->route('overview');
    }

    public function toggle(int $id) {
        $user = User::find($id);

        $user->disabled = !$user->disabled;
        $user->save();

        // If the user is closed
        if ($user->disabled) {
            session_push('success', $user->name . ' ' . __('is now disabled. they will no longer be visible to the public.'));
            return redirect()->route('profile', ['id' => $user->id]);
        } else { // If the user is not closed
            session_push('success', $user->name . ' ' . __('is now enabled. they are now visible to the public.'));
            return redirect()->route('profile', ['id' => $user->id]);
        }
    }
}
