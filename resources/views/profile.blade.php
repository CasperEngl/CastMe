@extends('master') 
@section('content')
<main class="container">
  <h2 class="page-header">{{ title_case(__('Profile information')) }}</h2>

  <?php print_r($_POST); ?>

  <div class="row">

    <div class="col-lg-4">
      <img src="https://www.gravatar.com/avatar/<?php echo md5(trim(strtolower(Auth::User()->email))) ?>" alt="" style="margin: 1rem 0; max-width: 80px;">
      <input name="profile-picture-upload" type="file" class="file">
    </div>
    <div class="col-lg-8">
      <form action="/profile/dump" method="POST">
        <div class="card">
          <div class="card-body">

            <?php
              $splitName = explode(' ', Auth::User()->name);

              $first_name = $splitName[0];
              $last_name = !empty(end($splitName)) && end($splitName) !== $first_name ? end($splitName) : '';
            ?>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="username" class="text-muted">{{ title_case(__('Username')) }}</label>
                  <input type="text" name="username" class="form-control" id="username" placeholder="Name yourself" value="{{ kebab_case(Auth::User()->name) }}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="first-name" class="text-muted">{{ title_case(__('First name')) }}</label>
                  <input type="text" name="first_name" class="form-control" id="first-name" placeholder="John/Jane" value="{{ $first_name }}">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="last-name" class="text-muted">{{ title_case(__('Last name')) }}</label>
                  <input type="text" name="last_name" class="form-control" id="last-name" placeholder="Doe" value="{{ $last_name }}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="email" class="text-muted">{{ title_case(__('Email')) }}</label>
                  <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="{{ Auth::User()->email }}">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="age" class="text-muted">{{ title_case(__('Age')) }}</label>
                  <input type="number" name="age" class="form-control" id="age" placeholder="27" value="27">
                </div>
              </div>
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="height" class="text-muted">{{ title_case(__('Height')) }}</label>
                  <input type="number" name="height" class="form-control" id="height" placeholder="175" value="175">
                  <small class="form-text text-muted">{{ __('Height must be in centimeters.') }}</small>
                </div>
              </div>
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="weight" class="text-muted">{{ title_case(__('Weight')) }}</label>
                  <input type="number" name="weight" class="form-control" id="weight" placeholder="80" value="80">
                  <small class="form-text text-muted">{{ __('We only support weight in kilos.') }}</small>
                </div>
              </div>
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="experience" class="text-muted">{{ title_case(__('Experience')) }}</label>
                  <input type="number" name="experience" class="form-control" id="experience" placeholder="5" value="5">
                  <small class="form-text text-muted">{{ __('Experience is in whole years to keep it simple.') }}</small>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="pant-size" class="text-muted">{{ title_case(__('Pants size')) }}</label>
                  <input type="number" name="pant-size" class="form-control" id="pant-size" placeholder="30" value="30">
                </div>
              </div>
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="shoe_size" class="text-muted">{{ title_case(__('Shoe size')) }}</label>
                  <input type="number" name="shoe_size" class="form-control" id="shoe_size" placeholder="42" value="42">
                </div>
              </div>
              <div class="col-12 col-sm">
                <div class="form-group">
                  <label for="shirt_size" class="text-muted">{{ title_case(__('Shirt size')) }}</label>
                  <input type="number" name="shirt_size" class="form-control" id="shirt_size" placeholder="40" value="40">
                </div>
              </div>
            </div>

            <div class="row">
                <div class="col">
                  <div class="form-group">
                    <h5 class="text-muted">{{ title_case(__('Profile type')) }}</h5>
                    <p class="text-muted">{{ __('Select multiple if applicable') }}</p>
                    <ul class="pagination">
                      <div class="display-none">
                        <input type="checkbox" name="profile_type[]" value="1" id="profile_type-actor">
                        <input type="checkbox" name="profile_type[]" value="2" id="profile_type-dancer">
                        <input type="checkbox" name="profile_type[]" value="3" id="profile_type-entertainer">
                        <input type="checkbox" name="profile_type[]" value="4" id="profile_type-event_staff">
                        <input type="checkbox" name="profile_type[]" value="5" id="profile_type-extra">
                        <input type="checkbox" name="profile_type[]" value="6" id="profile_type-model">
                        <input type="checkbox" name="profile_type[]" value="7" id="profile_type-musician">
                        <input type="checkbox" name="profile_type[]" value="8" id="profile_type-other">
                      </div>
                      <li class="page-item">
                        <label for="profile_type-actor" class="page-link" href="#">{{ title_case(__('Actor')) }}</label>
                      </li>
                      <li class="page-item">
                        <label for="profile_type-dancer" class="page-link" href="#">{{ title_case(__('Dancer')) }}</label>
                      </li>
                      <li class="page-item">
                        <label for="profile_type-entertainer" class="page-link" href="#">{{ title_case(__('Entertainer')) }}</label>
                      </li>
                      <li class="page-item">
                        <label for="profile_type-event_staff" class="page-link" href="#">{{ title_case(__('Event staff')) }}</label>
                      </li>
                      <li class="page-item">
                        <label for="profile_type-extra" class="page-link" href="#">{{ title_case(__('Extra')) }}</label>
                      </li>
                      <li class="page-item">
                        <label for="profile_type-model" class="page-link" href="#">{{ title_case(__('Model')) }}</label>
                      </li>
                      <li class="page-item">
                        <label for="profile_type-musician" class="page-link" href="#">{{ title_case(__('Musician')) }}</label>
                      </li>
                      <li class="page-item">
                        <label for="profile_type-other" class="page-link" href="#">{{ title_case(__('Other')) }}</label>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <h5 class="text-muted">{{ title_case(__('Hair length')) }}</h5>
                  <ul class="pagination">
                    <div class="display-none">
                      <input type="radio" name="hair_length" value="1" id="hair_length-bald">
                      <input type="radio" name="hair_length" value="2" id="hair_length-balding">
                      <input type="radio" name="hair_length" value="3" id="hair_length-short">
                      <input type="radio" name="hair_length" value="4" id="hair_length-medium" checked>
                      <input type="radio" name="hair_length" value="5" id="hair_length-long">
                      <input type="radio" name="hair_length" value="6" id="hair_length-super_long">
                    </div>
                    <li class="page-item">
                      <label for="hair_length-bald" class="page-link" href="#">{{ title_case(__('Bald')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_length-balding" class="page-link" href="#">{{ title_case(__('Balding')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_length-short" class="page-link" href="#">{{ title_case(__('Short')) }}</label>
                    </li>
                    <li class="page-item active">
                      <label for="hair_length-medium" class="page-link" href="#">{{ title_case(__('Medium')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_length-long" class="page-link" href="#">{{ title_case(__('Long')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_length-super_long" class="page-link" href="#">{{ title_case(__('Super long')) }}</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <h5 class="text-muted">{{ title_case(__('Hair color')) }}</h5>
                  <ul class="pagination">
                    <div class="display-none">
                      <input type="radio" name="hair_color" value="1" id="hair_color-black">
                      <input type="radio" name="hair_color" value="2" id="hair_color-brown" checked>
                      <input type="radio" name="hair_color" value="3" id="hair_color-dark_brown">
                      <input type="radio" name="hair_color" value="4" id="hair_color-blond">
                      <input type="radio" name="hair_color" value="5" id="hair_color-dirty_blonde">
                      <input type="radio" name="hair_color" value="6" id="hair_color-auburn">
                      <input type="radio" name="hair_color" value="7" id="hair_color-red">
                      <input type="radio" name="hair_color" value="8" id="hair_color-ginger">
                      <input type="radio" name="hair_color" value="9" id="hair_color-platinum">
                      <input type="radio" name="hair_color" value="10" id="hair_color-white">
                      <input type="radio" name="hair_color" value="11" id="hair_color-grey">
                    </div>
                    <li class="page-item">
                      <label for="hair_color-black" class="page-link" href="#">{{ title_case(__('Black')) }}</label>
                    </li>
                    <li class="page-item active">
                      <label for="hair_color-brown" class="page-link" href="#">{{ title_case(__('Brown')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-dark_brown" class="page-link" href="#">{{ title_case(__('Dark brown')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-blond" class="page-link" href="#">{{ title_case(__('Blond')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-dirty_blonde" class="page-link" href="#">{{ title_case(__('Dirty blonde')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-auburn" class="page-link" href="#">{{ title_case(__('Auburn')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-red" class="page-link" href="#">{{ title_case(__('Red')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-ginger" class="page-link" href="#">{{ title_case(__('Ginger')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-platinum" class="page-link" href="#">{{ title_case(__('Platinum')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-white" class="page-link" href="#">{{ title_case(__('White')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="hair_color-grey" class="page-link" href="#">{{ title_case(__('Grey')) }}</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <h5 class="text-muted">{{ title_case(__('Ethnicity')) }}</h5>
                  <ul class="pagination">
                    <div class="display-none">
                      <input type="radio" name="ethnicity" value="1" id="african">
                      <input type="radio" name="ethnicity" value="2" id="afro_american">
                      <input type="radio" name="ethnicity" value="3" id="asian">
                      <input type="radio" name="ethnicity" value="4" id="caucasian">
                      <input type="radio" name="ethnicity" value="5" id="indian">
                      <input type="radio" name="ethnicity" value="6" id="latino">
                      <input type="radio" name="ethnicity" value="7" id="mediterranean">
                      <input type="radio" name="ethnicity" value="8" id="middle_eastern">
                      <input type="radio" name="ethnicity" value="9" id="pakistanis">
                      <input type="radio" name="ethnicity" value="10" id="skandinavian" checked>
                      <input type="radio" name="ethnicity" value="11" id="spanish">
                      <input type="radio" name="ethnicity" value="12" id="mix">
                    </div>
                    <li class="page-item">
                      <label for="african" class="page-link" href="#">{{ title_case(__('African')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="afro_american" class="page-link" href="#">{{ title_case(__('Afro american')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="asian" class="page-link" href="#">{{ title_case(__('Asian')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="caucasian" class="page-link" href="#">{{ title_case(__('Caucasian')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="indian" class="page-link" href="#">{{ title_case(__('Indian')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="latino" class="page-link" href="#">{{ title_case(__('Latino')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="mediterranean" class="page-link" href="#">{{ title_case(__('Mediterranean')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="middle_eastern" class="page-link" href="#">{{ title_case(__('Middle eastern')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="pakistanis" class="page-link" href="#">{{ title_case(__('Pakistanis')) }}</label>
                    </li>
                    <li class="page-item active">
                      <label for="skandinavian" class="page-link" href="#">{{ title_case(__('Skandinavian')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="spanish" class="page-link" href="#">{{ title_case(__('Spanish')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="mix" class="page-link" href="#">{{ title_case(__('Mix')) }}</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col">
                <div class="form-group">
                  <h5 class="text-muted">{{ title_case(__('Eye color')) }}</h5>
                  <ul class="pagination">
                    <div class="display-none">
                      <input type="radio" name="eye_color" value="1" id="eye_color-amber">
                      <input type="radio" name="eye_color" value="2" id="eye_color-blue" checked>
                      <input type="radio" name="eye_color" value="3" id="eye_color-brown">
                      <input type="radio" name="eye_color" value="4" id="eye_color-grey">
                      <input type="radio" name="eye_color" value="5" id="eye_color-green">
                      <input type="radio" name="eye_color" value="6" id="eye_color-hazel">
                      <input type="radio" name="eye_color" value="7" id="eye_color-other">
                    </div>
                    <li class="page-item">
                      <label for="eye_color-amber" class="page-link" href="#">{{ title_case(__('Amber')) }}</label>
                    </li>
                    <li class="page-item active">
                      <label for="eye_color-blue" class="page-link" href="#">{{ title_case(__('Blue')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="eye_color-brown" class="page-link" href="#">{{ title_case(__('Brown')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="eye_color-grey" class="page-link" href="#">{{ title_case(__('Grey')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="eye_color-green" class="page-link" href="#">{{ title_case(__('Green')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="eye_color-hazel" class="page-link" href="#">{{ title_case(__('Hazel')) }}</label>
                    </li>
                    <li class="page-item">
                      <label for="eye_color-other" class="page-link" href="#">{{ title_case(__('Other')) }}</label>
                    </li>
                  </ul>
                </div>
              </div>
            </div>

          </div>

          <button class="card-footer btn btn-primary" type="submit">{{ title_case(__('Save Changes')) }}</button>
        </div>
        
        {{ csrf_field() }}
      </form>

    </div>

  </div>

</main>
@endsection