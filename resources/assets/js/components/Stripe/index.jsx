// index.js
import React from 'react';
import ReactDOM from 'react-dom';
import { StripeProvider } from 'react-stripe-elements';

import StoreCheckout from './StoreCheckout';

const Stripe = () => (
  <StripeProvider apiKey="pk_test_12345">
    <StoreCheckout />
  </StripeProvider>
);

if (document.getElementById('Stripe')) {
  ReactDOM.render(<Stripe />, document.getElementById('Stripe'));
}
