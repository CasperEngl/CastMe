/*
eslint

no-undef: 0,
class-methods-use-this: 0,
array-callback-return: 0,
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

import '../ucFirst';

import ImageInput from './ImageInput';

class ImageInputs extends Component {
  constructor(props) {
    super(props);

    this.handleAddInput = this.handleAddInput.bind(this);
    this.handleRemoveInput = this.handleRemoveInput.bind(this);

    this.state = {
      inputNumber: 0,
      inputList: [],
      defaultStrings: {
        en: {
          images: 'images',
        },
        da: {
          images: 'billeder',
        },
      },
      lang: 'en',
    };
  }

  async componentDidMount() {
    const { type } = this.props;
    const { defaultStrings } = this.state;

    this.getLocale(defaultStrings);

    if (type.toLowerCase() === 'update') {
      try {
        const data = await axios.get('data');
        const images = JSON.parse(data.data.images);

        if (images) {
          images.map((image) => {
            this.handleAddInput(image);
          });
        }
      } catch (err) {
        // console.log(err);
      }
    }
  }

  async getLocale(supportedLanguages) {
    try {
      const response = await fetch('/api/locale');
      const result = await response.json();

      if (Object.keys(supportedLanguages).includes(result.lang)) {
        this.setState({
          lang: result.lang,
        });

        return result.lang;
      }
    } catch (err) {
      // console.log(err);
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
    const { inputList, defaultStrings, lang } = this.state;

    const strings = new LocalizedStrings(defaultStrings);

    strings.setLanguage(lang);

    return (
      <Fragment>
        <Row className="d-flex align-items-center mb-2">
          <Col xs="auto">
            <h5 className="text-muted m-0">
              { strings.images.ucFirst() }
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
  const { type } = document.getElementById('ImageInputs').dataset;
  ReactDOM.render(<ImageInputs type={type} />, document.getElementById('ImageInputs'));
}
