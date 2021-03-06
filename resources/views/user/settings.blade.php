<?php

use App\ProfileRole;

?>

@extends('layouts.master') 
@section('content')
<h2 class="page-header">{{ ucfirst(__('profile information')) }}</h2>

{{ Form::open(['url' => route('user.settings.update'), 'files' => 'true']) }}
  <div class="card">
    <div class="card-body">

      <a href="{{ route('profile', ['id' => Auth::id()]) }}" class="btn btn-castme">{{ ucfirst(__('your profile as viewed by agents')) }}</a>

      <div class="mb-4">
        {{ Form::label('avatar', ucfirst(__('avatar upload')), [
          'class' => 'text-muted mt-4'
        ]) }}
        {{ Form::file('avatar', [
            'class' => 'file mb-4'
          ]) }}
        <div id="avatar-errors" class="my-2"></div>
      </div>

      @if ($avatar)
      <div class="d-flex flex-wrap justify-content-center">
        <h2 class="w-100 text-center text-muted">{{ ucfirst(__('avatar')) }}</h2>
        <figure class="mb-4 avatar justify-content-center">
          <img src="{{ $avatar }}" alt="{{ __('avatar') }}">
        </figure>
      </div>
      @endif

      {{ Form::label('gallery', ucfirst(__('gallery images')), [
        'class' => 'text-muted mt-4'
      ]) }}
      <small class="form-text text-muted mb-2">{{ sentence(__('you can upload a maximum of 5 images to your profile gallery.')) }}</small>
      {{ Form::file('gallery[]', [
        'class' => 'w-100 mb-2',
        'multiple' => true,
      ]) }}

      <small class="form-text text-muted">{{ sentence(__('click an image to delete it')) }}</small>
      <div class="profile-gallery">
        @foreach (Auth::user()->galleryImages as $key => $galleryImage)
        <a class="profile-gallery__image" onclick="return confirm('{{ sentence(__('are you sure you want to delete this image?')) }}')" href="{{ route('user.gallery.delete', ['id' => $galleryImage->id]) }}">
          <img src="{{ Storage::disk('public')->url($galleryImage->image) }}" alt="">
        </a>
        @endforeach
      </div>

      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            {{ Form::label('first_name', ucfirst(__('first name')), [
              'class' => 'text-muted'
              ]) }}
            {{ Form::text('first_name', Auth::user()->name ?? '', [
              'class' => 'form-control',
              'placeholder' => ''
            ]) }}
          </div>
        </div>
        <div class="col-md-6">
          <div class="form-group">
            {{ Form::label('last_name', ucfirst(__('last name')), [
              'class' => 'text-muted'
              ]) }}
            {{ Form::text('last_name', Auth::user()->last_name ?? '', [
              'class' => 'form-control',
              'placeholder' => ''
            ]) }}
          </div>
        </div>
      </div>

 {{ Form::label('gallery', ucfirst(__('NB: your email and phone number will ONLY be visible to system admins, and not agents.')), [
        'class' => 'text mt-4'
      ]) }}

     <div class="row">
        <div class="col">
          <div class="form-group">
            {{ Form::label('phone', ucfirst(__('phone')), [
              'class' => 'text-muted'
              ]) }}
            {{ Form::text('phone', Auth::user()->phone ?? '', [
              'class' => 'form-control',
              'placeholder' => ''
            ]) }}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            {{ Form::label('email', ucfirst(__('email')), [
              'class' => 'text-muted'
              ]) }}
            {{ Form::text('email', Auth::user()->email ?? '', [
              'class' => 'form-control',
              'placeholder' => ''
            ]) }}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            {{ Form::label('phone', ucfirst(__('phone')), [
              'class' => 'text-muted'
              ]) }}
            {{ Form::text('phone', Auth::user()->phone ?? '', [
              'class' => 'form-control',
              'placeholder' => ''
            ]) }}
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-sm">
          <div class="form-group">
            {{ Form::label('age', ucfirst(__('age')), [
              'class' => 'text-muted'
              ]) }}
            {{ Form::text('age', Auth::user()->details->age ?? '', [
              'class' => 'form-control',
              'placeholder' => ''
            ]) }}
          </div>
        </div>
        <div class="col-12 col-sm">
          <div class="form-group">
            {{ Form::label('height', ucfirst(__('height')), [
              'class' => 'text-muted'
              ]) }}
            {{ Form::text('height', Auth::user()->details->height ?? '', [
              'class' => 'form-control',
              'placeholder' => ''
            ]) }}
            <small class="form-text text-muted">{{ ucfirst(__('height must be in centimeters')) }}</small>
          </div>
        </div>
        <div class="col-12 col-sm">
          <div class="form-group">
            {{ Form::label('weight', ucfirst(__('weight')), [
              'class' => 'text-muted'
              ]) }}
            {{ Form::text('weight', Auth::user()->details->weight ?? '', [
              'class' => 'form-control',
              'placeholder' => ''
            ]) }}
            <small class="form-text text-muted">{{ ucfirst(__('we only support weight in kilos')) }}</small>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12 col-sm">
          <div class="form-group">
            {{ Form::label('pant_size', ucfirst(__('pant size')), [
              'class' => 'text-muted'
              ]) }}
            {{ Form::text('pant_size', Auth::user()->details->pant_size ?? '', [
              'class' => 'form-control',
              'placeholder' => ''
            ]) }}
          </div>
        </div>
        <div class="col-12 col-sm">
          <div class="form-group">
            {{ Form::label('shoe_size', ucfirst(__('shoe size')), [
              'class' => 'text-muted'
              ]) }}
            {{ Form::text('shoe_size', Auth::user()->details->shoe_size ?? '', [
              'class' => 'form-control',
              'placeholder' => ''
            ]) }}
          </div>
        </div>
        <div class="col-12 col-sm">
          <div class="form-group">
            {{ Form::label('shirt_size', ucfirst(__('shirt size')), [
              'class' => 'text-muted'
              ]) }}
            {{ Form::text('shirt_size', Auth::user()->details->shirt_size ?? '', [
              'class' => 'form-control',
              'placeholder' => ''
            ]) }}
          </div>
        </div>
      </div>

      {{ Form::label('description', ucfirst(__('profile description')), [
        'class' => 'h5 text-muted'
      ]) }}
      {{ Form::textarea('description', Auth::user()->details->description ?? '', [
        'class' => 'tinymce'
      ]) }}

      <div class="row">
        <div class="col">
          <div class="form-group">
            <h5 class="text-muted">{{ ucfirst(__('profile type')) }}</h5>
            <p class="text-muted">{{ ucfirst(__('select multiple if applicable')) }}</p>
            <ul class="pagination">
              @foreach (ProfileRole::getPossibleRoles() as $profileRole)
              <li class="page-item">
                {{ Form::label(str_slug($profileRole, '_'), ucfirst(__(str_replace('_', ' ', $profileRole))), [
                  'class' => 'page-link'
                ]) }}
              </li>
              @endforeach

              <div class="display-none">
                @foreach (ProfileRole::getPossibleRoles() as $profileRole)
                {{ Form::checkbox('roles[]', str_slug($profileRole, '_'), array_where(Auth::user()->profileRoles->toArray(), function($value, $key) use ($profileRole) {
                  return str_slug($value['role'], '_') === str_slug($profileRole, '_');
                }), [
                  'id' => str_slug($profileRole, '_'),
                ]) }}
                @endforeach
              </div>
            </ul>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <h5 class="text-muted">{{ ucfirst(__('gender')) }}</h5>
            <ul class="pagination">
              <li class="page-item">
                {{ Form::label('gender-male', ucfirst(__('male')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('gender-female', ucfirst(__('female')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('gender-other', ucfirst(__('other')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <div class="display-none">
                <input type="radio" name="gender" value="male" id="gender-male" {{ (Auth::user()->details->gender == 'male') ? 'checked' : '' }}>
                <input type="radio" name="gender" value="female" id="gender-female" {{ (Auth::user()->details->gender == 'female') ? 'checked' : '' }}>
                <input type="radio" name="gender" value="other" id="gender-other" {{ (Auth::user()->details->gender == 'other') ? 'checked' : '' }}>
              </div>
            </ul>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <h5 class="text-muted">{{ ucfirst(__('hair length')) }}</h5>
            <ul class="pagination">
              <li class="page-item">
                {{ Form::label('hair_length-bald', ucfirst(__('bald')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_length-balding', ucfirst(__('balding')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_length-short', ucfirst(__('short')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_length-medium', ucfirst(__('medium')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_length-long', ucfirst(__('long')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_length-super_long', ucfirst(__('super long')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <div class="display-none">
                <input type="radio" name="hair_length" value="Bald" id="hair_length-bald" {{ (Auth::user()->details->hair_length == 'Bald') ? 'checked' : '' }}>
                <input type="radio" name="hair_length" value="Balding" id="hair_length-balding" {{ (Auth::user()->details->hair_length == 'Balding') ? 'checked' : '' }}>
                <input type="radio" name="hair_length" value="Short" id="hair_length-short" {{ (Auth::user()->details->hair_length == 'Short') ? 'checked' : '' }}>
                <input type="radio" name="hair_length" value="Medium" id="hair_length-medium" {{ (Auth::user()->details->hair_length == 'Medium') ? 'checked' : '' }}>
                <input type="radio" name="hair_length" value="Long" id="hair_length-long" {{ (Auth::user()->details->hair_length == 'Long') ? 'checked' : '' }}>
                <input type="radio" name="hair_length" value="Super Long" id="hair_length-super_long" {{ (Auth::user()->details->hair_length == 'Super Long') ? 'checked' : '' }}>
              </div>
            </ul>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <h5 class="text-muted">{{ ucfirst(__('hair color')) }}</h5>
            <ul class="pagination">
              <li class="page-item">
                {{ Form::label('hair_color-black', ucfirst(__('black')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_color-brown', ucfirst(__('brown')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_color-dark_brown', ucfirst(__('dark brown')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_color-blonde', ucfirst(__('blonde')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_color-dirty_blonde', ucfirst(__('dirty blonde')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_color-auburn', ucfirst(__('auburn')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_color-red', ucfirst(__('red')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_color-ginger', ucfirst(__('ginger')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_color-platinum', ucfirst(__('platinum')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_color-white', ucfirst(__('white')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('hair_color-grey', ucfirst(__('grey')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <div class="display-none">
                <input type="radio" name="hair_color" value="Black" id="hair_color-black" {{ (Auth::user()->details->hair_color == 'Black') ? 'checked' : '' }}>
                <input type="radio" name="hair_color" value="Brown" id="hair_color-brown" {{ (Auth::user()->details->hair_color == 'Brown') ? 'checked' : '' }}>
                <input type="radio" name="hair_color" value="Dark brown" id="hair_color-dark_brown" {{ (Auth::user()->details->hair_color == 'Dark Brown') ? 'checked' : '' }}>
                <input type="radio" name="hair_color" value="Blonde" id="hair_color-blonde" {{ (Auth::user()->details->hair_color == 'Blonde') ? 'checked' : '' }}>
                <input type="radio" name="hair_color" value="Dirty blonde" id="hair_color-dirty_blonde" {{ (Auth::user()->details->hair_color == 'Dirty Blonde') ? 'checked' : '' }}>
                <input type="radio" name="hair_color" value="Auburn" id="hair_color-auburn" {{ (Auth::user()->details->hair_color == 'Auburn') ? 'checked' : '' }}>
                <input type="radio" name="hair_color" value="Red" id="hair_color-red" {{ (Auth::user()->details->hair_color == 'Red') ? 'checked' : '' }}>
                <input type="radio" name="hair_color" value="Ginger" id="hair_color-ginger" {{ (Auth::user()->details->hair_color == 'Ginger') ? 'checked' : '' }}>
                <input type="radio" name="hair_color" value="Platinum" id="hair_color-platinum" {{ (Auth::user()->details->hair_color == 'Platinum') ? 'checked' : '' }}>
                <input type="radio" name="hair_color" value="White" id="hair_color-white" {{ (Auth::user()->details->hair_color == 'White') ? 'checked' : '' }}>
                <input type="radio" name="hair_color" value="Grey" id="hair_color-grey" {{ (Auth::user()->details->hair_color == 'Grey') ? 'checked' : '' }}>
              </div>
            </ul>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <h5 class="text-muted">{{ ucfirst(__('ethnicity')) }}</h5>
            <ul class="pagination">
              <li class="page-item">
                {{ Form::label('african', ucfirst(__('african')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('afro_american', ucfirst(__('afro american')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('asian', ucfirst(__('asian')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('caucasian', ucfirst(__('caucasian')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('indian', ucfirst(__('indian')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('latino', ucfirst(__('latino')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('mediterranean', ucfirst(__('mediterranean')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('middle_eastern', ucfirst(__('middle eastern')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('pakistanis', ucfirst(__('pakistanis')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('scandinavian', ucfirst(__('scandinavian')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('spanish', ucfirst(__('spanish')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('mix', ucfirst(__('mix')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <div class="display-none">
                <input type="radio" name="ethnicity" value="African" id="african" {{ (Auth::user()->details->ethnicity == 'African') ? 'checked' : '' }}>
                <input type="radio" name="ethnicity" value="Afro american" id="afro_american" {{ (Auth::user()->details->ethnicity == 'Afro American') ? 'checked' : '' }}>
                <input type="radio" name="ethnicity" value="Asian" id="asian" {{ (Auth::user()->details->ethnicity == 'Asian') ? 'checked' : '' }}>
                <input type="radio" name="ethnicity" value="Caucasian" id="caucasian" {{ (Auth::user()->details->ethnicity == 'Caucasian') ? 'checked' : '' }}>
                <input type="radio" name="ethnicity" value="Indian" id="indian" {{ (Auth::user()->details->ethnicity == 'Indian') ? 'checked' : '' }}>
                <input type="radio" name="ethnicity" value="Latino" id="latino" {{ (Auth::user()->details->ethnicity == 'Latino') ? 'checked' : '' }}>
                <input type="radio" name="ethnicity" value="Mediterranean" id="mediterranean" {{ (Auth::user()->details->ethnicity == 'Mediterranean') ? 'checked' : '' }}>
                <input type="radio" name="ethnicity" value="Middle eastern" id="middle_eastern" {{ (Auth::user()->details->ethnicity == 'Middle Eastern') ? 'checked' : '' }}>
                <input type="radio" name="ethnicity" value="Pakistanis" id="pakistanis" {{ (Auth::user()->details->ethnicity == 'Pakistanis') ? 'checked' : '' }}>
                <input type="radio" name="ethnicity" value="Scandinavian" id="scandinavian" {{ (Auth::user()->details->ethnicity == 'Scandinavian') ? 'checked' : '' }}>
                <input type="radio" name="ethnicity" value="Spanish" id="spanish" {{ (Auth::user()->details->ethnicity == 'Spanish') ? 'checked' : '' }}>
                <input type="radio" name="ethnicity" value="Mix" id="mix" {{ (Auth::user()->details->ethnicity == 'Mix') ? 'checked' : '' }}>
              </div>
            </ul>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <h5 class="text-muted">{{ ucfirst(__('eye color')) }}</h5>
            <ul class="pagination">
              <li class="page-item">
                {{ Form::label('eye_color-amber', ucfirst(__('amber')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('eye_color-blue', ucfirst(__('blue')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('eye_color-brown', ucfirst(__('brown')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('eye_color-grey', ucfirst(__('grey')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('eye_color-green', ucfirst(__('green')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('eye_color-hazel', ucfirst(__('hazel')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('eye_color-other', ucfirst(__('other')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <div class="display-none">
                <input type="radio" name="eye_color" value="Amber" id="eye_color-amber" {{ (Auth::user()->details->eye_color == 'Amber') ? 'checked' : '' }}>
                <input type="radio" name="eye_color" value="Blue" id="eye_color-blue" {{ (Auth::user()->details->eye_color == 'Blue') ? 'checked' : '' }}>
                <input type="radio" name="eye_color" value="Brown" id="eye_color-brown" {{ (Auth::user()->details->eye_color == 'Brown') ? 'checked' : '' }}>
                <input type="radio" name="eye_color" value="Grey" id="eye_color-grey" {{ (Auth::user()->details->eye_color == 'Grey') ? 'checked' : '' }}>
                <input type="radio" name="eye_color" value="Green" id="eye_color-green" {{ (Auth::user()->details->eye_color == 'Green') ? 'checked' : '' }}>
                <input type="radio" name="eye_color" value="Hazel" id="eye_color-hazel" {{ (Auth::user()->details->eye_color == 'Hazel') ? 'checked' : '' }}>
                <input type="radio" name="eye_color" value="Other" id="eye_color-other" {{ (Auth::user()->details->eye_color == 'Other') ? 'checked' : '' }}>
              </div>
            </ul>
          </div>
        </div>
      </div>

    </div>

    <button class="card-footer btn btn-castme" type="submit">{{ ucfirst(__('save changes')) }}</button>
  </div>
{{ Form::close() }}
@endsection