<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class ProfileController extends Controller {
  public function index() {
    return view('profile');
  }

  public function user($id) {
    return view('user')->with('user', User::find($id));
  }

  public function update(Request $request) {
    $user    = Auth::user();
    $details = $user->details;

    $user->name           = $request->input('first_name') ? $request->input('first_name') : $user->name;
    $user->last_name      = $request->input('last_name') ? $request->input('last_name') : $user->last_name;
    $user->email          = $request->input('email') ? $request->input('email') : $user->email;
    $details->age         = $request->input('age') ? $request->input('age') : $details->age;
    $details->height      = $request->input('height') ? $request->input('height') : $details->height;
    $details->weight      = $request->input('weight') ? $request->input('weight') : $details->weight;
    $details->experience  = $request->input('experience') ? $request->input('experience') : $details->experience;
    $details->pant_size   = $request->input('pant_size') ? $request->input('pant_size') : $details->pant_size;
    $details->shoe_size   = $request->input('shoe_size') ? $request->input('shoe_size') : $details->shoe_size;
    $details->shirt_size  = $request->input('shirt_size') ? $request->input('shirt_size') : $details->shirt_size;
    $details->description = $request->input('description') ? strip_tags($request->input('description')) : $details->description;

    $details->actor       = $request->input('actor') ? $request->input('actor') : 0;
    $details->dancer      = $request->input('dancer') ? $request->input('dancer') : 0;
    $details->entertainer = $request->input('entertainer') ? $request->input('entertainer') : 0;
    $details->event_staff = $request->input('event_staff') ? $request->input('event_staff') : 0;
    $details->extra       = $request->input('extra') ? $request->input('extra') : 0;
    $details->model       = $request->input('model') ? $request->input('model') : 0;
    $details->musician    = $request->input('musician') ? $request->input('musician') : 0;
    $details->other       = $request->input('other') ? $request->input('other') : 0;

    $details->hair_length = $request->input('hair_length') ? $request->input('hair_length') : $details->hair_length;
    $details->eye_color   = $request->input('eye_color') ? $request->input('eye_color') : $details->eye_color;
    $details->hair_color  = $request->input('hair_color') ? $request->input('hair_color') : $details->hair_color;
    $details->ethnicity   = $request->input('ethnicity') ? $request->input('ethnicity') : $details->ethnicity;

    $details->save();
    $user->save();

    return redirect()->back();
  }
}
