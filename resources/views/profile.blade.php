@extends('master') 
@section('content')
<main class="container">
  <h2 class="page-header">{{ title_case(__('profile information')) }}</h2>

  <div class="row">

    <div class="col-lg-4">
      <img src="https://www.gravatar.com/avatar/<?php echo md5(trim(strtolower(Auth::User()->email))) ?>" alt="" style="margin: 1rem 0; max-width: 80px;">
      <input name="profile-picture-upload" type="file" class="file">
    </div>
    <div class="col-lg-8">
      <form action="/profile/update" method="POST">
        <div class="card">
          <div class="card-body">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first_name" class="text-muted">{{ title_case(__('first name')) }}</label>
                  <input type="text" name="first_name" class="form-control" id="first_name" placeholder="John/Jane" value="{{ Auth::User()->name ?? '' }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="last_name" class="text-muted">{{ title_case(__('last name')) }}</label>
                  <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Doe" value="{{ Auth::User()->last_name ?? '' }}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="email" class="text-muted">{{ title_case(__('email')) }}</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="{{ Auth::User()->email ?? '' }}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="age" class="text-muted">{{ title_case(__('age')) }}</label>
                  <input type="number" name="age" class="form-control" id="age" placeholder="27" value="{{ Auth::User()->details->age ?? '' }}">
                </div>
              </div>
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="height" class="text-muted">{{ title_case(__('height')) }}</label>
                  <input type="number" name="height" class="form-control" id="height" placeholder="175" value="{{ Auth::User()->details->height ?? '' }}">
                  <small class="form-text text-muted">{{ __('Height must be in centimeters.') }}</small>
                </div>
              </div>
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="weight" class="text-muted">{{ title_case(__('weight')) }}</label>
                  <input type="number" name="weight" class="form-control" id="weight" placeholder="80" value="{{ Auth::User()->details->weight ?? '' }}">
                  <small class="form-text text-muted">{{ __('We only support weight in kilos.') }}</small>
                </div>
              </div>
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="experience" class="text-muted">{{ title_case(__('experience')) }}</label>
                  <input type="number" name="experience" class="form-control" id="experience" placeholder="5" value="{{ Auth::User()->details->experience ?? '' }}">
                  <small class="form-text text-muted">{{ __('Experience is in whole years to keep it simple.') }}</small>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="pant_size" class="text-muted">{{ title_case(__('pants size')) }}</label>
                  <input type="number" name="pant_size" class="form-control" id="pant_size" placeholder="30" value="{{ Auth::User()->details->pant_size ?? '' }}">
                </div>
              </div>
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="shoe_size" class="text-muted">{{ title_case(__('shoe size')) }}</label>
                  <input type="number" name="shoe_size" class="form-control" id="shoe_size" placeholder="42" value="{{ Auth::User()->details->shoe_size ?? '' }}">
                </div>
              </div>
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="shirt_size" class="text-muted">{{ title_case(__('shirt size')) }}</label>
                  <input type="number" name="shirt_size" class="form-control" id="shirt_size" placeholder="40" value="{{ Auth::User()->details->shirt_size ?? '' }}">
                </div>
              </div>
            </div>

            <h5 class="text-muted">{{ title_case(__('profile description')) }}</h5>
            <textarea name="description" class="tinymce">{{ Auth::User()->details->description ?? '' }}</textarea>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <h5 class="text-muted">{{ title_case(__('profile type')) }}</h5>
                  <p class="text-muted">{{ __('Select multiple if applicable') }}</p>
                  <ul class="pagination">
                    <div class="display-none">
                      <input type="checkbox" name="actor" value="1" id="profile_type-actor" {{ Auth::User()->details->actor ? 'checked' : '' }}>
                      <input type="checkbox" name="dancer" value="1" id="profile_type-dancer" {{ Auth::User()->details->dancer ? 'checked' : '' }}>
                      <input type="checkbox" name="entertainer" value="1" id="profile_type-entertainer" {{ Auth::User()->details->entertainer ? 'checked' : '' }}>
                      <input type="checkbox" name="event_staff" value="1" id="profile_type-event_staff" {{ Auth::User()->details->event_staff ? 'checked' : '' }}>
                      <input type="checkbox" name="extra" value="1" id="profile_type-extra" {{ Auth::User()->details->extra ? 'checked' : '' }}>
                      <input type="checkbox" name="model" value="1" id="profile_type-model" {{ Auth::User()->details->model ? 'checked' : '' }}>
                      <input type="checkbox" name="musician" value="1" id="profile_type-musician" {{ Auth::User()->details->musician ? 'checked' : '' }}>
                      <input type="checkbox" name="other" value="1" id="profile_type-other" {{ Auth::User()->details->other ? 'checked' : '' }}>
                    </div>
                    <li class="page-item">
                      <label for="profile_type-actor" class="page-link" href="#">{{ title_case(__('actor')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="profile_type-dancer" class="page-link" href="#">{{ title_case(__('dancer')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="profile_type-entertainer" class="page-link" href="#">{{ title_case(__('entertainer')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="profile_type-event_staff" class="page-link" href="#">{{ title_case(__('event staff')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="profile_type-extra" class="page-link" href="#">{{ title_case(__('extra')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="profile_type-model" class="page-link" href="#">{{ title_case(__('model')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="profile_type-musician" class="page-link" href="#">{{ title_case(__('musician')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="profile_type-other" class="page-link" href="#">{{ title_case(__('other')) }}</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <h5 class="text-muted">{{ title_case(__('hair length')) }}</h5>
                  <ul class="pagination">
                    <div class="display-none">
                      <input type="radio" name="hair_length" value="Bald" id="hair_length-bald" {{ (Auth::User()->details->hair_length == 'Bald') ? 'checked' : '' }}>
                      <input type="radio" name="hair_length" value="Balding" id="hair_length-balding" {{ (Auth::User()->details->hair_length == 'Balding') ? 'checked' : '' }}>
                      <input type="radio" name="hair_length" value="Short" id="hair_length-short" {{ (Auth::User()->details->hair_length == 'Short') ? 'checked' : '' }}>
                      <input type="radio" name="hair_length" value="Medium" id="hair_length-medium" {{ (Auth::User()->details->hair_length == 'Medium') ? 'checked' : '' }}>
                      <input type="radio" name="hair_length" value="Long" id="hair_length-long" {{ (Auth::User()->details->hair_length == 'Long') ? 'checked' : '' }}>
                      <input type="radio" name="hair_length" value="Super Long" id="hair_length-super_long" {{ (Auth::User()->details->hair_length == 'Super Long') ? 'checked' : '' }}>
                    </div>
                    <li class="page-item">
                      <label for="hair_length-bald" class="page-link" href="#">{{ title_case(__('bald')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_length-balding" class="page-link" href="#">{{ title_case(__('balding')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_length-short" class="page-link" href="#">{{ title_case(__('short')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_length-medium" class="page-link" href="#">{{ title_case(__('medium')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_length-long" class="page-link" href="#">{{ title_case(__('long')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_length-super_long" class="page-link" href="#">{{ title_case(__('super long')) }}</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <h5 class="text-muted">{{ title_case(__('hair color')) }}</h5>
                  <ul class="pagination">
                    <div class="display-none">
                      <input type="radio" name="hair_color" value="Black" id="hair_color-black" {{ (Auth::User()->details->hair_color == 'Black') ? 'checked' : '' }}>
                      <input type="radio" name="hair_color" value="Brown" id="hair_color-brown" {{ (Auth::User()->details->hair_color == 'Brown') ? 'checked' : '' }}>
                      <input type="radio" name="hair_color" value="Dark brown" id="hair_color-dark_brown" {{ (Auth::User()->details->hair_color == 'Dark Brown') ? 'checked' : '' }}>
                      <input type="radio" name="hair_color" value="Blond" id="hair_color-blond" {{ (Auth::User()->details->hair_color == 'Blond') ? 'checked' : '' }}>
                      <input type="radio" name="hair_color" value="Dirty blonde" id="hair_color-dirty_blonde" {{ (Auth::User()->details->hair_color == 'Dirty Blonde') ? 'checked' : '' }}>
                      <input type="radio" name="hair_color" value="Auburn" id="hair_color-auburn" {{ (Auth::User()->details->hair_color == 'Auburn') ? 'checked' : '' }}>
                      <input type="radio" name="hair_color" value="Red" id="hair_color-red" {{ (Auth::User()->details->hair_color == 'Red') ? 'checked' : '' }}>
                      <input type="radio" name="hair_color" value="Ginger" id="hair_color-ginger" {{ (Auth::User()->details->hair_color == 'Ginger') ? 'checked' : '' }}>
                      <input type="radio" name="hair_color" value="Platinum" id="hair_color-platinum" {{ (Auth::User()->details->hair_color == 'Platinum') ? 'checked' : '' }}>
                      <input type="radio" name="hair_color" value="White" id="hair_color-white" {{ (Auth::User()->details->hair_color == 'White') ? 'checked' : '' }}>
                      <input type="radio" name="hair_color" value="Grey" id="hair_color-grey" {{ (Auth::User()->details->hair_color == 'Grey') ? 'checked' : '' }}>
                    </div>
                    <li class="page-item">
                      <label for="hair_color-black" class="page-link" href="#">{{ title_case(__('black')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-brown" class="page-link" href="#">{{ title_case(__('brown')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-dark_brown" class="page-link" href="#">{{ title_case(__('dark brown')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-blond" class="page-link" href="#">{{ title_case(__('blond')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-dirty_blonde" class="page-link" href="#">{{ title_case(__('dirty blonde')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-auburn" class="page-link" href="#">{{ title_case(__('auburn')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-red" class="page-link" href="#">{{ title_case(__('red')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-ginger" class="page-link" href="#">{{ title_case(__('ginger')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-platinum" class="page-link" href="#">{{ title_case(__('platinum')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-white" class="page-link" href="#">{{ title_case(__('white')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-grey" class="page-link" href="#">{{ title_case(__('grey')) }}</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <h5 class="text-muted">{{ title_case(__('ethnicity')) }}</h5>
                  <ul class="pagination">
                    <div class="display-none">
                      <input type="radio" name="ethnicity" value="African" id="african" {{ (Auth::User()->details->ethnicity == 'African') ? 'checked' : '' }}>
                      <input type="radio" name="ethnicity" value="Afro american" id="afro_american" {{ (Auth::User()->details->ethnicity == 'Afro American') ? 'checked' : '' }}>
                      <input type="radio" name="ethnicity" value="Asian" id="asian" {{ (Auth::User()->details->ethnicity == 'Asian') ? 'checked' : '' }}>
                      <input type="radio" name="ethnicity" value="Caucasian" id="caucasian" {{ (Auth::User()->details->ethnicity == 'Caucasian') ? 'checked' : '' }}>
                      <input type="radio" name="ethnicity" value="Indian" id="indian" {{ (Auth::User()->details->ethnicity == 'Indian') ? 'checked' : '' }}>
                      <input type="radio" name="ethnicity" value="Latino" id="latino" {{ (Auth::User()->details->ethnicity == 'Latino') ? 'checked' : '' }}>
                      <input type="radio" name="ethnicity" value="Mediterranean" id="mediterranean" {{ (Auth::User()->details->ethnicity == 'Mediterranean') ? 'checked' : '' }}>
                      <input type="radio" name="ethnicity" value="Middle eastern" id="middle_eastern" {{ (Auth::User()->details->ethnicity == 'Middle Eastern') ? 'checked' : '' }}>
                      <input type="radio" name="ethnicity" value="Pakistanis" id="pakistanis" {{ (Auth::User()->details->ethnicity == 'Pakistanis') ? 'checked' : '' }}>
                      <input type="radio" name="ethnicity" value="Skandinavian" id="skandinavian" {{ (Auth::User()->details->ethnicity == 'Skandinavian') ? 'checked' : '' }}>
                      <input type="radio" name="ethnicity" value="Spanish" id="spanish" {{ (Auth::User()->details->ethnicity == 'Spanish') ? 'checked' : '' }}>
                      <input type="radio" name="ethnicity" value="Mix" id="mix" {{ (Auth::User()->details->ethnicity == 'Mix') ? 'checked' : '' }}>
                    </div>
                    <li class="page-item">
                      <label for="african" class="page-link" href="#">{{ title_case(__('african')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="afro_american" class="page-link" href="#">{{ title_case(__('afro american')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="asian" class="page-link" href="#">{{ title_case(__('asian')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="caucasian" class="page-link" href="#">{{ title_case(__('caucasian')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="indian" class="page-link" href="#">{{ title_case(__('indian')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="latino" class="page-link" href="#">{{ title_case(__('latino')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="mediterranean" class="page-link" href="#">{{ title_case(__('mediterranean')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="middle_eastern" class="page-link" href="#">{{ title_case(__('middle eastern')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="pakistanis" class="page-link" href="#">{{ title_case(__('pakistanis')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="skandinavian" class="page-link" href="#">{{ title_case(__('skandinavian')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="spanish" class="page-link" href="#">{{ title_case(__('spanish')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="mix" class="page-link" href="#">{{ title_case(__('mix')) }}</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <h5 class="text-muted">{{ title_case(__('eye color')) }}</h5>
                  <ul class="pagination">
                    <div class="display-none">
                      <input type="radio" name="eye_color" value="Amber" id="eye_color-amber" {{ (Auth::User()->details->eye_color == 'Amber') ? 'checked' : '' }}>
                      <input type="radio" name="eye_color" value="Blue" id="eye_color-blue" {{ (Auth::User()->details->eye_color == 'Blue') ? 'checked' : '' }}>
                      <input type="radio" name="eye_color" value="Brown" id="eye_color-brown" {{ (Auth::User()->details->eye_color == 'Brown') ? 'checked' : '' }}>
                      <input type="radio" name="eye_color" value="Grey" id="eye_color-grey" {{ (Auth::User()->details->eye_color == 'Grey') ? 'checked' : '' }}>
                      <input type="radio" name="eye_color" value="Green" id="eye_color-green" {{ (Auth::User()->details->eye_color == 'Green') ? 'checked' : '' }}>
                      <input type="radio" name="eye_color" value="Hazel" id="eye_color-hazel" {{ (Auth::User()->details->eye_color == 'Hazel') ? 'checked' : '' }}>
                      <input type="radio" name="eye_color" value="Other" id="eye_color-other" {{ (Auth::User()->details->eye_color == 'Other') ? 'checked' : '' }}>
                    </div>
                    <li class="page-item">
                      <label for="eye_color-amber" class="page-link" href="#">{{ title_case(__('amber')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="eye_color-blue" class="page-link" href="#">{{ title_case(__('blue')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="eye_color-brown" class="page-link" href="#">{{ title_case(__('brown')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="eye_color-grey" class="page-link" href="#">{{ title_case(__('grey')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="eye_color-green" class="page-link" href="#">{{ title_case(__('green')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="eye_color-hazel" class="page-link" href="#">{{ title_case(__('hazel')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="eye_color-other" class="page-link" href="#">{{ title_case(__('other')) }}</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

          </div>

          <button class="card-footer btn btn-primary" type="submit">{{ title_case(__('save changes')) }}</button>
        </div>
        
        {{ csrf_field() }}
      </form>

    </div>

  </div>

</main>
@endsection