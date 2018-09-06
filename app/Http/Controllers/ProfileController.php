<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Helpers\Format;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller {
  public function index() {
    $user = Auth::user();

    if (Storage::disk('public')->exists($user->avatar))
      $avatar = Storage::disk('public')->url($user->avatar);

    return view('user.settings')->with([
      'avatar' => $avatar ?? null,
    ]);
  }

  public function settingsDump() {
    return view('user.settingsDump');
  }

  public function user($id) {
    $user = User::find($id);
    $avatar = Storage::disk('public')->exists($user->avatar);
    $gravatarHash = md5(trim(strtolower(Auth::user()->email))) . '?s=200';
    $profile_types = [];

    if ($avatar) {
      $avatar = Storage::disk('public')->url($user->avatar);
    }
      

    if (!$user)
      return redirect()->back()->withErrors([
        ucfirst(__('unfortunately, that user does not exist'))
      ]);

    !$user->details->actor ?: $profile_types[] = title_case('Actor');
    !$user->details->dancer ?: $profile_types[] = title_case('Dancer');
    !$user->details->entertainer ?: $profile_types[] = title_case('Entertainer');
    !$user->details->event_staff ?: $profile_types[] = title_case('Event Staff');
    !$user->details->extra ?: $profile_types[] = title_case('Extra');
    !$user->details->model ?: $profile_types[] = title_case('Model');
    !$user->details->musician ?: $profile_types[] = title_case('Musician');

    return view('user.profile')->with([
      'user' => $user,
      'avatar' => $avatar,
      'gravatar' => $gravatarHash,
      'profile_types' => $profile_types,
    ]);
  }

  public function update(Request $request) {
    $user = Auth::user();
    $details = $user->details;

    $avatar = $request->file('avatar');

    if ($avatar) {
      if ($avatar->getSize() / 1000 > 2000)
        return redirect()->back()->withErrors([
          Format::string('Sorry, that avatar image is too big. Max file size is 2 MB.')
        ]);

      if ($avatar->isValid() !== true)
        return redirect()->back()->withErrors([
          Format::string('there was an issue with your image. please try uploading again, or find another avatar')
        ]);

      $storedFile = Storage::disk('public')->put('avatar', $avatar);
    }

    $user->name           = $request->input('first_name') ? $request->input('first_name') : $user->name;
    $user->last_name      = $request->input('last_name') ? $request->input('last_name') : $user->last_name;
    $user->email          = $request->input('email') ? $request->input('email') : $user->email;
    $user->avatar         = $avatar ? $storedFile : $user->avatar;
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

  public function dump(Request $request) {
    dd($request->all());
  }
}
