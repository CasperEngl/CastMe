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
          <form method="POST">
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
    
            </div>
    
            <button class="card-footer btn btn-primary" type="submit">Save Changes</button>
          </form>
          
        </div>
      </div>

    </div>

  </main>
@endsection