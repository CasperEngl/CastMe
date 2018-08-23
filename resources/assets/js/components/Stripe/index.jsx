import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import StripeCheckout from 'react-stripe-checkout';

export default class Stripe extends Component {
  onToken = async (token) => {
    try {
      const response = await fetch('/save-stripe-token', {
        method: 'POST',
        body: JSON.stringify(token),
      });
      const data = await response.json();

      console.log(data.email);
    } catch (err) {
      console.error(err);
    }
  }

  render() {
    return (
      <StripeCheckout
        token={this.onToken}
        stripeKey="pk_test_vwXRriarK5ffUa851WaUwOoS"
        name="Cast Me"
        description="Betal med Stripe"
        locale="auto"
        amount={17900}
        currency="DKK"
        allowRememberMe
      >
        <button type="button" onClick={event => event.preventDefault()} className="btn btn-primary">
          Pay
        </button>
      </StripeCheckout>
    );
  }
}

if (document.getElementById('Stripe')) {
  ReactDOM.render(<Stripe />, document.getElementById('Stripe'));
}
