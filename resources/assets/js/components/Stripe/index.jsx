import React from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { applyMiddleware, createStore } from 'redux';
import { composeWithDevTools } from 'redux-devtools-extension';
import thunk from 'redux-thunk';
import { save, load } from 'redux-localstorage-simple';
import { StripeProvider, Elements } from 'react-stripe-elements';

import InjectedCheckoutForm from './CheckoutForm';

import rootReducer from './reducers/rootReducer';

const middleware = [thunk];

const store = createStore(
  rootReducer,
  load(),
  composeWithDevTools(applyMiddleware(...middleware, save())),
);

const StripeMount = () => (
  <StripeProvider apiKey="pk_test_q3utIRDba2wBV5yGIgyRUku3">
    <Provider store={store}>
      <Elements>
        <InjectedCheckoutForm />
      </Elements>
    </Provider>
  </StripeProvider>
);

if (document.getElementById('StripeMount')) {
  ReactDOM.render(<StripeMount />, document.getElementById('StripeMount'));
}
