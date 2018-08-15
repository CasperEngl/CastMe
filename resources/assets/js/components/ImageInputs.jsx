/*
eslint

no-undef: 0,
class-methods-use-this: 0,
*/

import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import FontAwesome from 'react-fontawesome';
import axios from 'axios';
import LocalizedStrings from 'react-localization';

import {
  Row,
  Col,
  Button,
} from 'reactstrap';

import ImageInput from './ImageInput';

async function getLocale() {
  try {
    /*
    const response = await fetch('/api/locale');
    const result = await response.json();
    */
    const specific = await fetch('/api/locale/da');
    const locales = await specific.json();

    if (!locales.error) {
      return {
        error: 'failed loading locales',
      };
    }

    return locales;
  } catch (err) {
    // console.log(err);
  }
}

getLocale();

// const strings = new LocalizedStrings();

class ImageInputs extends Component {
  constructor(props) {
    super(props);

    this.handleAddInput = this.handleAddInput.bind(this);
    this.handleRemoveInput = this.handleRemoveInput.bind(this);

    this.state = {
      inputNumber: 0,
      inputList: [],
    };
  }

  async componentDidMount() {
    try {
      const data = await axios.get('data');
      const images = JSON.parse(data.data.images);

      if (images) {
        images.map((image) => {
          this.handleAddInput(image);
        });
      }
    } catch (err) {
      console.log(err);
    }
  }

  handleRemoveInput(number) {
    const { inputList } = this.state;

    this.setState({
      inputList: inputList.filter(value => value.props.number !== number),
    });
  }

  handleAddInput(image = '') {
    const { inputList } = this.state;

    this.setState(prevState => ({
      inputNumber: prevState.inputNumber + 1,
      inputList: inputList.concat(<ImageInput
        key={prevState.inputNumber + 1}
        number={prevState.inputNumber + 1}
        image={image}
        handleRemoveInput={this.handleRemoveInput} />),
    }));
  }

  render() {
    const { inputList } = this.state;

    return (
      <Fragment>
        <Row className="d-flex align-items-center mb-2">
          <Col xs="auto">
            <h5 className="text-muted m-0">
              Images
            </h5>
          </Col>
          <Col xs="auto">
            <Button color="primary" className="circle" onClick={() => this.handleAddInput()}>
              <FontAwesome name="plus" />
            </Button>
          </Col>
        </Row>
        { inputList }
      </Fragment>
    );
  }
}

export default ImageInputs;

if (document.getElementById('ImageInputs')) {
  ReactDOM.render(<ImageInputs />, document.getElementById('ImageInputs'));
}
