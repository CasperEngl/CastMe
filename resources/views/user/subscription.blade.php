<?php

use \Illuminate\Support\Facades\Auth;

?>

@extends('layouts.master')
@section('content')
  <main class="container">
    <h2 class="page-header">{{ title_case(__('subscription')) }}</h2>

    <div class="row">

      <div class="col-12 col-sm-4">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title mb-0">
              @if (Auth::user()->activeSub()) 
                {{ title_case(__('active')) }}
              @else
                {{ title_case(__('inactive')) }}
              @endif
            </h3>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-8">
        <form action="{{ route('user.subscription.subscribe') }}">
          <div class="card">
            <div class="card-body">
              <h3 class="page-header">{{ title_case(__('contact information')) }}</h3>

              <div class="row">
                <div class="col s6">
                  <div class="form-group">
                    <label for="fname">{{ title_case(__('first name')) }}</label>
                    <input type="text" name="fname" id="fname" class="form-control" value="{{ old('fname') }}">
                  </div>
                </div>
                <div class="col s6">
                  <div class="form-group">
                    <label for="lname">{{ title_case(__('last name')) }}</label>
                    <input type="text" name="lname" id="lname" class="form-control" value="{{ old('lname') }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <div class="form-group">
                    <label for="company">{{ title_case(__('company')) }}</label>
                    <input type="text" name="company" id="company" class="form-control" value="{{ old('company') }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <div class="form-group">
                    <div class="dropdown">
                      <button class="btn btn-default dropdown-toggle" type="button" id="countrySelect" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ title_case(__('country')) }}</button>
                      <div class="dropdown-menu" aria-labelledby="countrySelect">
                        <a class="dropdown-item" href="#">{{ title_case(__('denmark')) }}</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <div class="form-group">
                    <label for="address1">{{ title_case(__('street and house number')) }}</label>
                    <input type="text" name="address1" id="address1" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <div class="form-group">
                    <label for="address2">{{ title_case(__('stairway, floor etc.')) }}</label>
                    <input type="text" name="address2" id="address2" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s6">
                  <div class="form-group">
                    <label for="zip_code">{{ title_case(__('zip code')) }}</label>
                    <input type="text" name="zip_code" id="zip_code" class="form-control">
                  </div>
                </div>
                <div class="col s6">
                  <div class="form-group">
                    <label for="city">{{ title_case(__('city')) }}</label>
                    <input type="text" name="city" id="city" class="form-control">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <div class="form-group">
                    <label for="phone_number">{{ title_case(__('phone number')) }}</label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number') }}">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col s12">
                  <div class="form-group">
                    <label for="email">{{ title_case(__('email address')) }}</label>
                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email') }}">
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col s6">
                  <div class="row">
                    <div class="col s12">
                      <p>
                        <input type="radio" name="days" value="60" class="filled-in" id="product1">
                        <label for="product1">60 {{ __('Days') }} = 2 179 kr</label>
                      </p>
                      <p>
                        <input type="radio" name="days" value="90" class="filled-in" id="product1">
                        <label for="product1">90 {{ __('Days') }} = 3 279 kr</label>
                      </p>
                      <p>
                        <input type="radio" name="days" value="180" class="filled-in" id="product1">
                        <label for="product1">180 {{ __('Days') }} = 6 449 kr</label>
                      </p>
                      <p>
                        <input type="radio" name="days" value="365" class="filled-in" id="product1">
                        <label for="product1">365 {{ __('Days') }} = 12 799 kr</label>
                      </p>
                      </div>
                  </div>
                </div>
                <div class="col s6">
                  <input type="checkbox" name="accepth" class="filled-in" id="accepth">
                  <label for="accepth">{{ __('I accept the') }} <a href="https://castme.dk/abonnementsbetingelser/" target="blank">{{ __('subscription conditions') }}.</a></label>
                </div>

              </div>
            </div>

            <button class="card-footer btn btn-primary" type="submit">
              @if(\Illuminate\Support\Facades\Auth::user()->activeSub())
                {{ title_case(__('update info')) }}
              @else
                {{ title_case(__('subscribe')) }}
              @endif
            </button>
          </div>

          @csrf
          @method('post')
        </form>
      </div>

    </div>
  </main>
@endsection
