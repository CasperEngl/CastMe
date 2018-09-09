@extends('layouts.master')
@section('content')
  <main style="background: #333;">
    <style>
      form {
        width: 90%;
        max-width: 30rem;
        margin: 20px auto;
        overflow: auto;
      }

      label {
        height: 35px;
        position: relative;
        color: #8798AB;
        display: block;
        margin-top: 30px;
        margin-bottom: 20px;
      }

      label > span {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        font-weight: 300;
        line-height: 32px;
        color: #8798AB;
        border-bottom: 1px solid #586A82;
        transition: border-bottom-color 200ms ease-in-out;
        cursor: text;
        pointer-events: none;
      }

      label > span span {
        position: absolute;
        top: 0;
        left: 0;
        transform-origin: 0% 50%;
        transition: transform 200ms ease-in-out;
        cursor: text;
      }

      label .field.is-focused + span span,
      label .field:not(.is-empty) + span span {
        transform: scale(0.68) translateY(-36px);
        cursor: default;
      }

      label .field.is-focused + span {
        border-bottom-color: #34D08C;
      }

      .field {
        background: transparent;
        font-weight: 300;
        border: 0;
        color: white;
        outline: none;
        cursor: text;
        display: block;
        width: 100%;
        line-height: 32px;
        padding-bottom: 3px;
        transition: opacity 200ms ease-in-out;
      }

      .field::-webkit-input-placeholder { color: #8898AA; }
      .field::-moz-placeholder { color: #8898AA; }

      /* IE doesn't show placeholders when empty+focused */
      .field:-ms-input-placeholder { color: #424770; }

      .field.is-empty:not(.is-focused) {
        opacity: 0;
      }

      button {
        float: left;
        display: block;
        background: #34D08C;
        color: white;
        border-radius: 2px;
        border: 0;
        margin-top: 20px;
        font-size: 19px;
        font-weight: 400;
        width: 100%;
        height: 47px;
        line-height: 45px;
        outline: none;
      }

      button:focus {
        background: #24B47E;
      }

      button:active {
        background: #159570;
      }

      .outcome {
        float: left;
        width: 100%;
        padding-top: 8px;
        min-height: 20px;
        text-align: center;
      }

      .success, .error {
        display: none;
        font-size: 15px;
      }

      .success.visible, .error.visible {
        display: inline;
      }

      .error {
        color: #E4584C;
      }

      .success {
        color: #34D08C;
      }

      .success .token {
        font-weight: 500;
        font-size: 15px;
      }
    </style>
    <form id="payment-form" method="post">
      <input type="radio" name="sub" id="2_months" value="2_months" >
      <label style="display: inline-block; cursor: pointer; color: #ccc; padding-right: 20px;" for="2_months">2 Months</label>

      <input type="radio" name="sub" id="3_months" value="3_months" >
      <label style="display: inline-block; cursor: pointer; color: #ccc; padding-right: 20px;" for="3_months">3 Months</label>

      <input type="radio" name="sub" id="6_months" value="6_months" >
      <label style="display: inline-block; cursor: pointer; color: #ccc; padding-right: 20px;" for="6_months">6 Months</label>

      <input type="radio" name="sub" id="12_months" value="12_months" >
      <label style="display: inline-block; cursor: pointer; color: #ccc; padding-right: 20px;" for="12_months">12 Months</label>

      <label>
        <div id="card-element" class="field is-empty"></div>
        <span><span>Credit or debit card</span></span>
      </label>
      <button type="submit">Subscribe</button>
      <div class="outcome">
        <div class="error" role="alert" id="card-errors"></div>
        <div class="success">
          Success! Your Stripe token is <span class="token"></span>
        </div>
      </div>
      @csrf
      @method("POST")
    </form>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('pk_test_vwXRriarK5ffUa851WaUwOoS');
        var elements = stripe.elements();

        var card = elements.create('card', {
            iconStyle: 'solid',
            style: {
                base: {
                    iconColor: '#8898AA',
                    color: 'white',
                    lineHeight: '36px',
                    fontWeight: 300,
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSize: '19px',

                    '::placeholder': {
                        color: '#8898AA',
                    },
                },
                invalid: {
                    iconColor: '#e85746',
                    color: '#e85746',
                }
            },
            classes: {
                focus: 'is-focused',
                empty: 'is-empty',
            },
        });
        card.mount('#card-element');

        card.addEventListener('change', ({error}) => {
            const displayError = document.getElementById('card-errors');
            if (error) {
                displayError.textContent = error.message;
            } else {
                displayError.textContent = '';
            }
        });

        // Create a token or display an error when the form is submitted.
        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const {token, error} = await stripe.createToken(card);

            if (error) {
                // Inform the customer that there was an error.
                const errorElement = document.getElementById('card-errors');
                errorElement.textContent = error.message;
            } else {
                // Send the token to your server.
                stripeTokenHandler(token);
            }
        });

        const stripeTokenHandler = (token) => {
            // Insert the token ID into the form so it gets submitted to the server
            const form = document.getElementById('payment-form');
            const hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);

            // Submit the form
            form.submit();
        }
    </script>
  </main>
@endsection
