import React, { Component, Fragment } from 'react';
import ReactDOM from 'react-dom';
import FontAwesome from 'react-fontawesome';

import {
  Row,
  Col,
  Input,
  Button,
} from 'reactstrap';

import ImageInput from './ImageInput';

class ImageInputs extends Component {
  constructor(props) {
    super(props);

    this.handleAddInput = this.handleAddInput.bind(this);
    this.handleRemoveInput = this.handleRemoveInput.bind(this);

    this.state = {
      inputNumber: 0,
      inputList: [
        <ImageInput key={0} number={0} handleRemoveInput={this.handleRemoveInput} />
      ],
    }
  }

  handleRemoveInput(number) {
    this.setState({
      inputList: this.state.inputList.filter((value, index) => {
        console.log(value.props.number);

        return value.props.number !== number;
      }),
    });
  }

  handleAddInput(e) {
    const { inputList } = this.state;
    const inputNumber = this.state.inputNumber + 1;

    this.setState({
      inputNumber: inputNumber,
      inputList: inputList.concat(
        <ImageInput   
          key={inputNumber} 
          number={inputNumber} 
          handleRemoveInput={this.handleRemoveInput} />
      ),
    });

    setTimeout(() => console.log(this.state));
  } 

  render() {
    console.log(this.state);
    return (
      <Fragment>
        <Row className="d-flex align-items-center mb-2">
          <Col xs="auto">
            <h5 className="text-muted m-0">Images</h5>  
          </Col>
          <Col xs="auto">
            <Button color="primary" className="circle" onClick={this.handleAddInput}>
              <FontAwesome name="plus" />
            </Button>
          </Col>
        </Row>
        {
          this.state.inputList
        }
      </Fragment>
    );
  }
}

export default ImageInputs;

if (document.getElementById('ImageInputs')) {
  ReactDOM.render(<ImageInputs />, document.getElementById('ImageInputs'));
}