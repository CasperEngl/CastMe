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

const ImageInput = (props) => {
  const { handleRemoveInput, number } = props;

  return (
    <FormGroup>
      <Row className="d-flex align-items-center">
        <Col>
          <Input
            type="url"
            name="image[]"
            placeholder="https://i.imgur.com/XXxXxxX.png"
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
};

ImageInput.propTypes = {
  handleRemoveInput: PropTypes.func.isRequired,
  number: PropTypes.number.isRequired,
};

export default ImageInput;
