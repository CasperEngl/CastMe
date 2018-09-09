import React from 'react';
import { Elements } from 'react-stripe-elements';

import InjectedCheckoutForm from './CheckoutForm';

const StoreCheckout = () => (
  <Elements>
    <InjectedCheckoutForm />
  </Elements>
);

export default StoreCheckout;
