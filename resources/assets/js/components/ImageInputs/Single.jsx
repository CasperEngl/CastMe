import React from 'react';
import FontAwesome from 'react-fontawesome';
import PropTypes from 'prop-types';

import {
  Row,
  Col,
  FormGroup,
  Input,
  Button,
} from 'reactstrap';

const Single = ({ handleRemoveInput, number, image }) => (
  <FormGroup>
    <Row className="d-flex align-items-center">
      <Col>
        <Input
          type="url"
          name="image[]"
          placeholder="https://i.imgur.com/XXxXxxX.png"
          defaultValue={image}
        />
      </Col>
      <Col xs="auto">
        <Button color="primary" className="circle circle-small" onClick={() => handleRemoveInput(number)}>
          <FontAwesome name="minus" />
        </Button>
      </Col>
    </Row>
  </FormGroup>
);

Single.defaultProps = {
  image: '',
};

Single.propTypes = {
  handleRemoveInput: PropTypes.func.isRequired,
  number: PropTypes.number.isRequired,
  image: PropTypes.string,
};

export default Single;
