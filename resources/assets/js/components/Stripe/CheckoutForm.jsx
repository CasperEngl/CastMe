/*
eslint

no-multi-assign: 0,
*/

import React, { Component } from 'react';
import { connect } from 'react-redux';
import { injectStripe } from 'react-stripe-elements';
import { Row, Col } from 'reactstrap';
import styled from 'styled-components';

import CardSection from './CardSection';
import AddressSection from './AddressSection';

const StyledForm = styled.form`
`;

class CheckoutForm extends Component {
  handleSubmit = (ev) => {
    ev.preventDefault();

    const { stripe } = this.props;

    stripe.createToken({
      type: 'card',
    }).then(({ token }) => {
      console.log('Received Stripe token:', token);
    });
  };

  render() {
    return (
      <StyledForm onSubmit={this.handleSubmit}>
        <Row>
          <Col>
            <AddressSection />
          </Col>
          <Col>
            <CardSection />
            <button type="submit" className="btn btn-primary mt-3">
              Subscribe
            </button>
          </Col>
        </Row>
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
