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
                $splitName = explode(' ', Auth::user()->name);

                $first_name = $splitName[0];
                $last_name = !empty(end($splitName)) && end($splitName) !== $first_name ? end($splitName) : '';
              ?>
    
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="username" class="text-muted">{{ title_case('Username') }}</label>
                    <input type="text" name="username" class="form-control" id="username" placeholder="Name yourself" value="{{ kebab_case(Auth::user()->name) }}">
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
                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" value="{{ Auth::user()->email }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label for="age" class="text-muted">{{ title_case('Age') }}</label>
                    <input type="number" name="age" class="form-control" id="age" placeholder="27">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="height" class="text-muted">{{ title_case('Height') }} <small>(in cm)</small></label>
                    <input type="number" name="height" class="form-control" id="height" placeholder="175 cm">
                  </div>
                </div>
                <div class="col">
                  <div class="form-group">
                    <label for="experience" class="text-muted">{{ title_case('Experience') }} <small>(in years)</small></label>
                    <input type="number" name="experience" class="form-control" id="experience" placeholder="5">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <label>{{ title_case('Hair color') }}</label>
                    <ul class="pagination">
                      <div class="display-none">
                        <input type="radio" name="hair_color" value="1" id="hair-black">
                        <input type="radio" name="hair_color" value="2" id="hair-brown" ch
                        <input type="radio" name="hair_color" value="3" id="hair-blond">
                        <input type="radio" name="hair_color" value="4" id="hair-auburn">
                        <input type="radio" name="hair_color" value="5" id="hair-red">
                        <input type="radio" name="hair_color" value="6" id="hair-white">
                      </div>
                      <li class="page-item">
                        <label for="hair-black" class="page-link" href="#">Black</label>
                      </li>
                      <li class="page-item active">
                        <label for="hair-brown" class="page-link" href="#">Brown</label>
                      </li>
                      <li class="page-item">
                        <label for="hair-blond" class="page-link" href="#">Blond</label>
                      </li>
                      <li class="page-item">
                        <label for="hair-auburn" class="page-link" href="#">Auburn</label>
                      </li>
                      <li class="page-item">
                        <label for="hair-red" class="page-link" href="#">Red</label>
                      </li>
                      <li class="page-item">
                        <label for="hair-white" class="page-link" href="#">Gray or white<label>
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