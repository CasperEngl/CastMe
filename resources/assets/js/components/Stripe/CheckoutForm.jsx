/*
eslint

no-multi-assign: 0,
*/

import React, { Component } from 'react';
import { connect } from 'react-redux';
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
  handleSubmit = (ev) => {
    ev.preventDefault();

    const {
      fname,
      lname,
      stripe,
    } = this.props;

    stripe.createToken({
      type: 'card',
      name: `${fname} ${lname}`,
    }).then(({ token }) => {
      console.log('Received Stripe token:', token);
    });
  };

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

const mapStateToProps = state => ({
  fname: state.address.fname,
  lname: state.address.lname,
  address1: state.address.address1,
  address2: state.address.address2,
  zipCode: state.address.zipCode,
  city: state.address.city,
});

export default connect(mapStateToProps)(injectStripe(CheckoutForm));
