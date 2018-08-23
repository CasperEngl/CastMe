/*
eslint

no-multi-assign: 0,
*/

import React, { Component } from 'react';
import { injectStripe } from 'react-stripe-elements';
import styled from 'styled-components';

import CardSection from './CardSection';
import AddressSection from './AddressSection';

const StyledForm = styled.form`
  margin-bottom: 2.5rem;
  padding-bottom: 2.5rem;
  border-bottom: 3px solid #e6ebf1;
`;

class CheckoutForm extends Component {
  constructor(props) {
    super(props);

    this.state = {
      fname: '',
      lname: '',
      company: '',
      address1: '',
      address2: '',
      zip_code: '',
      city: '',
      phone_number: '',
      email: '',
    };
  }

  handleSubmit = (ev) => {
    ev.preventDefault();

    const {
      fname,
      lname,
      address1,
      address2,
      zipCode,
      city,
      country,
    } = this.state;
    const information = {
      name: `${fname} ${lname}`,
      address_city: city,
      address_country: country,
      address_line1: address1,
      address_line2: address2,
      address_zip: zipCode,
    };
    const { stripe } = this.props;

    console.log(...information);

    stripe.createToken({
      type: 'card',
      name: `${fname} ${lname}`,
    }).then(({ token }) => {
      console.log('Received Stripe token:', token);
    });
  };

  stateHandler(state) {
    console.log('stateHandler', state);
    this.setState({
      ...state,
    });
  }

  render() {
    return (
      <StyledForm onSubmit={this.handleSubmit}>
        <AddressSection stateHandler={this.stateHandler} />
        <CardSection />
        <button type="submit" className="btn btn-primary">
          Confirm order
        </button>
      </StyledForm>
    );
  }
}

export default injectStripe(CheckoutForm);
