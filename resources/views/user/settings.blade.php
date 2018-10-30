@extends('layouts.master') 
@section('content')
<h2 class="page-header">{{ ucfirst(__('profile information')) }}</h2>

{{ Form::open(['url' => route('user.settings.update'), 'files' => 'true']) }}
  <div class="card">
    <div class="card-body">

      <a href="{{ route('profile', ['id' => Auth::id()]) }}" class="btn btn-castme">{{ ucfirst('Your profile') }}</a>

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
        <figure class="mb-4 circle avatar justify-content-center">
          <img src="{{ $avatar }}" alt="{{ __('avatar') }}">
        </figure>
      </div>
      @endif

      <div id="ImageInputs"></div>

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
            {{ Form::label('') }}
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
              <li class="page-item">
                {{ Form::label('actor', ucfirst(__('actor')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('dancer', ucfirst(__('dancer')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('entertainer', ucfirst(__('entertainer')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('event_staff', ucfirst(__('event staff')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('extra', ucfirst(__('extra')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('model', ucfirst(__('model')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('musician', ucfirst(__('musician')), [
                  'class' => 'page-link'
                ]) }}
              </li>
              <li class="page-item">
                {{ Form::label('other', ucfirst(__('other')), [
                  'class' => 'page-link'
                ]) }}
              </li>

              <div class="display-none">
                {{ Form::checkbox('roles[]', 'actor', Auth::user()->details->roles && in_array('actor', json_decode(Auth::user()->details->roles)), [
                  'id' => 'actor'
                ]) }}
                {{ Form::checkbox('roles[]', 'dancer', Auth::user()->details->roles && in_array('dancer', json_decode(Auth::user()->details->roles)), [
                  'id' => 'dancer'
                ]) }}
                {{ Form::checkbox('roles[]', 'entertainer', Auth::user()->details->roles && in_array('entertainer', json_decode(Auth::user()->details->roles)), [
                  'id' => 'entertainer'
                ]) }}
                {{ Form::checkbox('roles[]', 'event staff', Auth::user()->details->roles && in_array('event staff', json_decode(Auth::user()->details->roles)), [
                  'id' => 'event_staff'
                ]) }}
                {{ Form::checkbox('roles[]', 'extra', Auth::user()->details->roles && in_array('extra', json_decode(Auth::user()->details->roles)), [
                  'id' => 'extra'
                ]) }}
                {{ Form::checkbox('roles[]', 'model', Auth::user()->details->roles && in_array('model', json_decode(Auth::user()->details->roles)), [
                  'id' => 'model'
                ]) }}
                {{ Form::checkbox('roles[]', 'musician', Auth::user()->details->roles && in_array('musician', json_decode(Auth::user()->details->roles)), [
                  'id' => 'musician'
                ]) }}
                {{ Form::checkbox('roles[]', 'other', Auth::user()->details->roles && in_array('other', json_decode(Auth::user()->details->roles)), [
                  'id' => 'other'
                ]) }}
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
                {{ Form::label('class', ucfirst(__('mix')), [
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
                <input type="radio" name="ethnicity" value="Scandinavian" id="Scandinavian" {{ (Auth::user()->details->ethnicity == 'Scandinavian') ? 'checked' : '' }}>
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