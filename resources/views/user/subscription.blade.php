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
        <form action="{{ route('user.subscription.dump') }}" method="POST" id="payment-form">
          <div class="card">
            <div class="card-body">
              <h3 class="page-header">{{ title_case(__('subscribe')) }}</h3>

              <div class="row">
                <div class="col-sm-4">
                  <ul class="pagination">
                    <li class="page-item w-100 d-flex justify-content-center">
                      <label for="month-2" class="page-link w-100 text-center">2 {{ __('months') }} - 179 DKK</label>
                    </li>
                    <li class="page-item w-100 d-flex justify-content-center">
                      <label for="month-3" class="page-link w-100 text-center">3 {{ __('months') }} - 279 DKK</label>
                    </li>
                    <li class="page-item w-100 d-flex justify-content-center">
                      <label for="month-6" class="page-link w-100 text-center">6 {{ __('months') }} - 449 DKK</label>
                    </li>
                    <li class="page-item w-100 d-flex justify-content-center">
                      <label for="month-12" class="page-link w-100 text-center">12 {{ __('months') }} - 799 DKK</label>
                    </li>
                    <div class="display-none">
                      <input type="radio" name="months" value="2" id="month-2" checked>
                      <input type="radio" name="months" value="3" id="month-3">
                      <input type="radio" name="months" value="6" id="month-6">
                      <input type="radio" name="months" value="12" id="month-12">
                    </div>
                  </ul>
                </div>
              
                <div class="col-sm-8">
                  <script src="https://js.stripe.com/v3/"></script>

                  <div id="card-element" class="my-4 field is-empty"></div>

                  <script>
                    const stripeTokenHandler = token => {
                      // Insert the token ID into the form so it gets submitted to the server
                      const form = document.getElementById('payment-form');
                      const hiddenInput = document.createElement('input');
                      hiddenInput.setAttribute('type', 'hidden');
                      hiddenInput.setAttribute('name', 'stripeToken');
                      hiddenInput.setAttribute('value', token.id);
                      form.appendChild(hiddenInput);

                      // Submit the form
                      form.submit();
                    };

                    let stripe = Stripe('pk_test_vwXRriarK5ffUa851WaUwOoS');
                    let elements = stripe.elements();

                    let card = elements.create('card', {
                      hidePostalCode: true,
                      iconStyle: 'solid',
                      style: {
                        base: {
                          iconColor: '#8898AA',
                          color: 'rgba(0, 0, 0, .54)',
                          lineHeight: '36px',
                          fontWeight: 400,
                          fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                          fontSize: '1.25rem',

                          '::placeholder': {
                            color: '#8898AA'
                          }
                        },
                        invalid: {
                          iconColor: '#e85746',
                          color: '#e85746'
                        }
                      },
                      classes: {
                        focus: 'is-focused',
                        empty: 'is-empty'
                      }
                    });
                    card.mount('#card-element');

                    card.addEventListener('change', ({ error }) => {
                      const displayError = document.getElementById('card-errors');
                      if (error) {
                        displayError.textContent = error.message;
                      } else {
                        displayError.textContent = "";
                      }
                    });

                    // Create a token or display an error when the form is submitted.
                    const form = document.getElementById('payment-form');
                    form.addEventListener('submit', async event => {
                      event.preventDefault();

                      const { token, error } = await stripe.createToken(card);

                      if (error) {
                        // Inform the customer that there was an error.
                        const errorElement = document.getElementById('card-errors');
                        errorElement.textContent = error.message;
                      } else {
                        // Send the token to your server.
                        stripeTokenHandler(token);
                      }
                    });
                  </script>

                  <input type="checkbox" name="accepth" id="accepth">
                  <label for="accepth">{{ ucfirst(__('i accept the')) }} <a href="https://castme.dk/abonnementsbetingelser/" target="blank">{{
                      __('subscription conditions') }}</a></label>
                </div>
              </div>

            </div>

            <button class="card-footer btn btn-primary" type="submit">
              @if(Auth::user()->activeSub())
                {{ title_case(__('update information')) }}
              @else
                {{ title_case(__('subscribe')) }}
              @endif
            </button>
          </div>

          @csrf
          @method('POST')
        </form>
        
      </div>

    </div>
  </main>
@endsection
