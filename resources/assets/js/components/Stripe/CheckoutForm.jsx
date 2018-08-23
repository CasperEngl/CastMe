import React from 'react';
import { injectStripe } from 'react-stripe-elements';

import CardSection from './CardSection';

class CheckoutForm extends React.Component {
  static propTypes = {
    stripe: PropTypes.any().isRequired,
  }

  handleSubmit = (ev) => {
    ev.preventDefault();

    const { stripe } = this.props;

    stripe.createToken({
      name: 'Jenny Rosen'
    }).then(({ token }) => {
      console.log('Received Stripe token:', token);
    });
  };

  render() {
    return (
      <form onSubmit={this.handleSubmit}>
        <CardSection />
        <button type="button">
          Confirm order
        </button>
      </form>
    );
  }
}

export default injectStripe(CheckoutForm);