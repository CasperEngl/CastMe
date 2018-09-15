import React from 'react';
import { CardElement } from 'react-stripe-elements';
import styled from 'styled-components';

const StyledCardElement = styled(CardElement)`
  display: block;
  padding: 1rem;
  width: 100%;
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
