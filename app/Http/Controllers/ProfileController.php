<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\GalleryImage;
use Storage;
use Intervention\Image\ImageManagerStatic as Image;

class ProfileController extends Controller {
  public function index($id) {
    $user = User::find($id);
    $avatar = Storage::disk('public')->exists($user->avatar) ? Storage::disk('public')->url($user->avatar) : false;
    $gravatarHash = md5(trim(strtolower(Auth::user()->email))) . '?s=200';
    $galleryImages = json_decode($user->details->gallery);
    $gallery = [];

    foreach ($galleryImages as $galleryImage) {
      $image = Storage::disk('public')->exists($galleryImage) ? Storage::disk('public')->url($galleryImage) : false;

      if ($image) {
        array_push($gallery, $image);
      }
    }

    if (!$user)
      return redirect()->back()->withErrors([
        ucfirst(__('unfortunately, that user does not exist'))
      ]);

    if ($user->role === 'Free' && $user->id !== Auth::id())
      return redirect()->back()->withErrors([
        ucfirst(__('oops, looks like that user is not a member yet.'))
      ]);

    return view('user.profile')->with([
      'user' => $user,
      'avatar' => $avatar,
      'gravatar' => $gravatarHash,
      'gallery' => $gallery,
    ]);
  }

  public function settings() {
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

  public function update(Request $request) {
    $user = Auth::user();
    $details = $user->details;

    $avatar = $request->file('avatar');

    if ($avatar) {
      if ($avatar->getSize() / 1000 > 2000)
        return redirect()->back()->withErrors([
          sentence('sorry, that avatar image is too big. max file size is 2 mb.')
        ]);

      if ($avatar->isValid() !== true)
        return redirect()->back()->withErrors([
          sentence('there was an issue with your image. please try uploading again, or find another avatar')
        ]);
      
      $storedFile = Storage::disk('public')->put('avatar', $avatar);
    }

    if ($images = $request->file('gallery')) {
      foreach ($images as $image) {
        if ($image->getSize() / 1000 > 2000)
          return redirect()->back()->withErrors([
            sentence('sorry. one of your gallery images was too big. max file size is 2 mb.')
          ]);
  
        if ($image->isValid() !== true)
          return redirect()->back()->withErrors([
            sentence('there was an issue with one of your images. please try uploading again, or find out which image might be causing any issues.')
          ]);

        $storedFile = Storage::disk('public')->put('gallery', $image);

        $newImage = new GalleryImage([
          'user_id' => Auth::id(),
          'image' => $storedFile,
        ]);
    
        $newImage->save();
      }
    }

    $roles = [];
    
    if ($request->input('roles.*')) {
      foreach ($request->input('roles.*') as $role) {
        if (!in_array(strtolower($role), ['actor', 'dancer', 'entertainer', 'event staff', 'extra', 'model', 'musician', 'other']))
          return redirect()->back()->withErrors([
            ucfirst(__('"' . $role . '" is not a valid role')),
          ]);

        $roles[] = $role;
      }
    }

    $user->name           = $request->input('first_name') ? title_case($request->input('first_name')) : title_case($user->name);
    $user->last_name      = $request->input('last_name') ? title_case($request->input('last_name')) : title_case($user->last_name);
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

    $details->roles       = json_encode($roles);

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
