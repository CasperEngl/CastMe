@extends('master')
@section('content')
  <main class="container">
    <h2 class="page-header">{{ title_case('Profile information') }}</h2>

    <div class="row">

      <div class="col-lg-4">
        <input name="profile-picture-upload" type="file" class="file">
      </div>
      <div class="col-lg-8">
        <div class="card">
          <form method="GET">
            <div class="card-body">

              <?php
                $splitName = explode(' ', Auth::User()->name);

                $first_name = $splitName[0];
                $last_name = !empty(end($splitName)) && end($splitName) !== $first_name ? end($splitName) : '';
              ?>
    
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="username" class="text-muted">{{ title_case('Username') }}</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Name yourself" value="{{ kebab_case(Auth::User()->name) }}">
                  </div>
                </div>
              </div>
    
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="first-name" class="text-muted">{{ title_case('First name') }}</label>
                    <input type="text" name="first_name" class="form-control" id="first-name" placeholder="John/Jane" value="{{ $first_name }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="last-name" class="text-muted">{{ title_case('Last name') }}</label>
                    <input type="text" name="last_name" class="form-control" id="last-name" placeholder="Doe" value="{{ $last_name }}">
                  </div>
                </div>
              </div>
    
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="email" class="text-muted">{{ title_case('Email') }}</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="{{ Auth::User()->email }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-12 col-sm">
                  <div class="form-group">
                    <label for="age" class="text-muted">{{ title_case('Age') }}</label>
                    <input type="number" name="age" class="form-control" id="age" placeholder="27" value="27">
                  </div>
                </div>
                <div class="col-12 col-sm">
                  <div class="form-group">
                    <label for="height" class="text-muted">{{ title_case('Height') }}</label>
                    <input type="number" name="height" class="form-control" id="height" placeholder="175" value="175">
                    <small class="form-text text-muted">Height must be in centimeters.</small>
                  </div>
                </div>
                <div class="col-12 col-sm">
                  <div class="form-group">
                    <label for="weight" class="text-muted">{{ title_case('Weight') }}</label>
                    <input type="number" name="weight" class="form-control" id="weight" placeholder="80" value="80">
                    <small class="form-text text-muted">We only support weight in kilos.</small>
                  </div>
                </div>
                <div class="col-12 col-sm">
                  <div class="form-group">
                    <label for="experience" class="text-muted">{{ title_case('Experience') }}</label>
                    <input type="number" name="experience" class="form-control" id="experience" placeholder="5" value="5">
                    <small class="form-text text-muted">Experience is in whole years to keep it simple.</small>
                  </div>
                </div>
              </div>

              <div class="row">
                  <div class="col-12 col-sm">
                    <div class="form-group">
                      <label for="pant-size" class="text-muted">{{ title_case('Pants size') }}</label>
                      <input type="number" name="pant-size" class="form-control" id="pant-size" placeholder="30" value="30">
                    </div>
                  </div>
                  <div class="col-12 col-sm">
                    <div class="form-group">
                      <label for="shoe_size" class="text-muted">{{ title_case('Shoe size') }}</label>
                      <input type="number" name="shoe_size" class="form-control" id="shoe_size" placeholder="42" value="42">
                    </div>
                  </div>
                  <div class="col-12 col-sm">
                    <div class="form-group">
                      <label for="shirt_size" class="text-muted">{{ title_case('Shirt size') }}</label>
                      <input type="number" name="shirt_size" class="form-control" id="shirt_size" placeholder="40" value="40">
                    </div>
                  </div>
                </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <h5 class="text-muted">{{ title_case('Hair length') }}</h5>
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
                        <label for="hair_length-bald" class="page-link" href="#">{{ title_case('Bald') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_length-balding" class="page-link" href="#">{{ title_case('Balding') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_length-short" class="page-link" href="#">{{ title_case('Short') }}</label>
                      </li>
                      <li class="page-item active">
                        <label for="hair_length-medium" class="page-link" href="#">{{ title_case('Medium') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_length-long" class="page-link" href="#">{{ title_case('Long') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_length-super_long" class="page-link" href="#">{{ title_case('Super long') }}</label>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <h5 class="text-muted">{{ title_case('Hair color') }}</h5>
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
                        <label for="hair_color-black" class="page-link" href="#">{{ title_case('Black') }}</label>
                      </li>
                      <li class="page-item active">
                        <label for="hair_color-brown" class="page-link" href="#">{{ title_case('Brown') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_color-dark_brown" class="page-link" href="#">{{ title_case('Dark brown') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_color-blond" class="page-link" href="#">{{ title_case('Blond') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_color-dirty_blonde" class="page-link" href="#">{{ title_case('Dirty blonde') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_color-auburn" class="page-link" href="#">{{ title_case('Auburn') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_color-red" class="page-link" href="#">{{ title_case('Red') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_color-ginger" class="page-link" href="#">{{ title_case('Ginger') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_color-platinum" class="page-link" href="#">{{ title_case('Platinum') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_color-white" class="page-link" href="#">{{ title_case('White') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="hair_color-grey" class="page-link" href="#">{{ title_case('Grey') }}</label>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <h5 class="text-muted">{{ title_case('Ethnicity') }}</h5>
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
                        <label for="african" class="page-link" href="#">{{ title_case('African') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="afro_american" class="page-link" href="#">{{ title_case('Afro american') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="asian" class="page-link" href="#">{{ title_case('Asian') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="caucasian" class="page-link" href="#">{{ title_case('Caucasian') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="indian" class="page-link" href="#">{{ title_case('Indian') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="latino" class="page-link" href="#">{{ title_case('Latino') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="mediterranean" class="page-link" href="#">{{ title_case('Mediterranean') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="middle_eastern" class="page-link" href="#">{{ title_case('Middle eastern') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="pakistanis" class="page-link" href="#">{{ title_case('Pakistanis') }}</label>
                      </li>
                      <li class="page-item active">
                        <label for="skandinavian" class="page-link" href="#">{{ title_case('Skandinavian') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="spanish" class="page-link" href="#">{{ title_case('Spanish') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="mix" class="page-link" href="#">{{ title_case('Mix') }}</label>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <h5 class="text-muted">{{ title_case('Eye color') }}</h5>
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
                        <label for="eye_color-amber" class="page-link" href="#">{{ title_case('Amber') }}</label>
                      </li>
                      <li class="page-item active">
                        <label for="eye_color-blue" class="page-link" href="#">{{ title_case('Blue') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="eye_color-brown" class="page-link" href="#">{{ title_case('Brown') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="eye_color-grey" class="page-link" href="#">{{ title_case('Grey') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="eye_color-green" class="page-link" href="#">{{ title_case('Green') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="eye_color-hazel" class="page-link" href="#">{{ title_case('Hazel') }}</label>
                      </li>
                      <li class="page-item">
                        <label for="eye_color-other" class="page-link" href="#">{{ title_case('Other') }}</label>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
    
            </div>
    
            <button class="card-footer btn btn-primary" type="submit">Save Changes</button>
          </form>
          
        </div>
      </div>

    </div>

  </main>
@endsection