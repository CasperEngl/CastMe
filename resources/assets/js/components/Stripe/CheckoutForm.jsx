import React from 'react';
import { injectStripe } from 'react-stripe-elements';
import styled from 'styled-components';

import CardSection from './CardSection';

const StyledForm = styled.form`
  margin-bottom: 2.5rem;
  padding-bottom: 2.5rem;
  border-bottom: 3px solid #e6ebf1;
`;

class CheckoutForm extends React.Component {
  handleSubmit = (ev) => {
    ev.preventDefault();

    const { stripe } = this.props;

    console.log('STRIPE', stripe);

    stripe.createToken({
      type: 'card',
      name: 'Jenny Rosen',
    }).then(({ token }) => {
      console.log('Received Stripe token:', token);
    });
  };

  render() {
    return (
      <StyledForm onSubmit={this.handleSubmit}>
        <CardSection />
        <button type="submit" className="btn btn-primary">
          Confirm order
        </button>
      </StyledForm>
    );
  }
}

export default injectStripe(CheckoutForm);
