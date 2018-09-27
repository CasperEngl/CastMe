<?php

use \Illuminate\Support\Facades\Auth;

?>

@extends('layouts.master')
@section('content')
<h2 class="page-header">{{ ucfirst(__('subscription')) }}</h2>

@if(Auth::user()->activeSub())
<form action="{{ route('user.subscription.swap') }}" method="POST" id="payment-form">
@else
<form action="{{ route('user.subscription.create') }}" method="POST" id="payment-form">
@endif
  <div class="card">
    <div class="card-body">
      <script src="https://js.stripe.com/v3/"></script>
      {{-- <divid="StripeMount"></div> --}}
      
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
            <div class="display-none">
              <input type="radio" name="months" value="2_months" id="month-2" {{ $plan==='2_months' ? 'checked' : '' }}>
              <input type="radio" name="months" value="3_months" id="month-3" {{ $plan==='3_months' ? 'checked' : '' }}>
              <input type="radio" name="months" value="6_months" id="month-6" {{ $plan==='6_months' ? 'checked' : '' }}>
            </div>
          </ul>
        </div>
      
        <div class="col-sm-8">      
          <div id="card-element" class="my-4 field is-empty"></div>
          <div id="card-errors"></div>
      
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
      
                  let stripe = Stripe('{{ env('STRIPE_KEY') }}');
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
                        fontFamily: '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"',
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

    <button class="card-footer btn btn-castme" type="submit">
      @if(Auth::user()->activeSub())
        {{ ucfirst(__('update information')) }}
      @else
        {{ ucfirst(__('subscribe')) }}
      @endif
    </button>
  </div>

  @csrf
  @method('POST')
</form>
@endsection
