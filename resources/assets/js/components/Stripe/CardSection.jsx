import React from 'react';
import { CardElement } from 'react-stripe-elements';
import styled from 'styled-components';

const StyledCardElement = styled(CardElement)`
  display: block;
  margin: 1rem 0 1.5rem 0;
  padding: 1rem;
  font-size: 1em;
  font-family: 'Source Code Pro', monospace;
  border: 0;
  outline: 0;
  border-radius: .25rem;
  background: white;
`;

const CardSection = () => (
  <StyledCardElement id="card-element" className="shdw-sm" />
);

export default CardSection;
