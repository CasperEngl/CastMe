@extends('master')
@section('content')
  <main class="container">
    <h2 class="page-header">{{ title_case(__('Subscription')) }}</h2>

    <div class="row">

      <div class="col-12 col-sm-4">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">
              @if(\Illuminate\Support\Facades\Auth::user()->activeSub()) 
                Aktivt 
              @else
                Inaktivt 
              @endif
              </h3>
            <pre class="card-text"><?php print_r($_POST); ?></pre>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-8">
        <div class="card">
          <div class="card-body">
            <form action="/subscription/subscribe" method="post">
              <h3 class="page-header">{{ title_case(__('Contact information')) }}</h3>

              <div class="row">
                <div class="col s6">
                  <div class="form-group">
                    <label for="fname">{{ title_case(__('First name')) }}</label>
                    <input type="text" name="fname" id="fname" class="form-control">
                  </div>
                </div>
                <div class="col s6">
                  <div class="form-group">
                    <label for="lname">{{ title_case(__('Last name')) }}</label>
                    <input type="text" name="lname" id="lname" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <div class="form-group">
                    <label for="company">{{ title_case(__('Company')) }}</label>
                    <input type="text" name="company" id="company" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <div class="form-group">
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" id="countrySelect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ title_case(__('Country')) }}</button>
                      <div class="dropdown-menu" aria-labelledby="countrySelect">
                        <a class="dropdown-item" href="#">{{ __('Denmark') }}</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <div class="form-group">
                    <label for="address1">{{ title_case(__('Street and house number')) }}</label>
                    <input type="text" name="address1" id="address1" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <div class="form-group">
                    <label for="address2">{{ title_case(__('Stairway, floor etc.')) }}</label>
                    <input type="text" name="address2" id="address2" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s6">
                  <div class="form-group">
                    <label for="zip_code">{{ title_case(__('Zip code')) }}</label>
                    <input type="text" name="zip_code" id="zip_code" class="form-control">
                  </div>
                </div>
                <div class="col s6">
                  <div class="form-group">
                    <label for="city">{{ title_case(__('City')) }}</label>
                    <input type="text" name="city" id="city" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <div class="form-group">
                    <label for="phone_number">{{ title_case(__('Phone number')) }}</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <div class="form-group">
                    <label for="email">{{ title_case(__('Email address')) }}</label>
                    <input type="text" name="email" id="email" class="form-control">
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col s6">
                  <p>
                    <input type="radio" name="product" class="filled-in" id="product1">
                    <label for="product1">1 {{ __('month') }} = 89 kr</label>
                  </p>
                </div>
                <div class="col s6">
                  <input type="checkbox" name="accepth" class="filled-in" id="accepth">
                  <label for="accepth">{{ __('Jeg accepterer') }} <a href="https://castme.dk/handelsbetingelser/" target="blank">{{ __('handelsbetingelserne') }}.</a></label>

                  <input type="hidden" name="amount" value="100">
                  <input type="submit" class="btn btn-primary" value="Subscribe">
                </div>
              </div>

              {{ csrf_field() }}

            </form>
          </div>
        </div>
      </div>

    </div>
  </main>
@endsection
