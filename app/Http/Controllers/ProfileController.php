<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $details = $user->details;

        if ($user->name != $request->input('first_name'))
            $user->name = $request->input('first_name');

        if ($user->last_name != $request->input('last_name'))
            $user->last_name = $request->input('last_name');

        if ($user->email != $request->input('email'))
            $user->email = $request->input('email');

        if ($details->age != $request->input('age'))
            $details->age = $request->input('age');

        if ($details->height != $request->input('height'))
            $details->height = $request->input('height');

        if ($details->weight != $request->input('weight'))
            $details->weight = $request->input('weight');

        if ($details->experience != $request->input('experience'))
            $details->experience = $request->input('experience');

        if ($details->pant_size != $request->input('pant-size'))
            $details->pant_size = $request->input('pant-size');

        if ($details->shoe_size != $request->input('shoe_size'))
            $details->shoe_size = $request->input('shoe_size');

        if ($details->shirt_size !=$request->input('shirt_size'))
            $details->shirt_size = $request->input('shirt_size');

        if ($request->input('actor'))
            $details->actor = $request->input('actor');
        if ($request->input('dancer'))
            $details->dancer = $request->input('dancer');
        if ($request->input('entertainer'))
            $details->entertainer = $request->input('entertainer');
        if ($request->input('staff'))
            $details->event_staff = $request->input('event-staff');
        if ($request->input('extra'))
            $details->extra = $request->input('extra');
        if ($request->input('model'))
            $details->model = $request->input('model');
        if ($request->input('musician'))
            $details->musician = $request->input('musician');
        if ($request->input('other'))
            $details->other = $request->input('other');

        if ($details->hair_length != $request->input('hair_length'))
            $details->hair_length = $request->input('hair_length');

        if ($details->eye_color != $request->input('eye_color'))
            $details->eye_color = $request->input('eye_color');

        if ($details->hair_color != $request->input('hair_color'))
            $details->hair_color = $request->input('hair_color');

        if ($details->ethnicity != $request->input('ethnicity'))
            $details->ethnicity = $request->input('ethnicity');

        $details->save();
        $user->save();

        return redirect()->back();
    }
}
