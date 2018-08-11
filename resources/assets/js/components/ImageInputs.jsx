import React, { Component } from 'react';
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
      inputLength: 0,
      inputList: [
        <ImageInput key={0} number={0} handleRemoveInput={this.handleRemoveInput} />
      ],
    }
  }

  handleRemoveInput(number) {
    this.setState({
      inputLength: this.state.inputLength - 1,
      inputList: this.state.inputList.filter((value, index) => index !== number),
    });
  }

  handleAddInput(e) {
    const { inputList, inputLength } = this.state;

    this.setState({
      inputLength: this.state.inputLength + 1,
      inputList: inputList.concat(
        <ImageInput   
          key={inputList.length} 
          number={inputList.length} 
          handleRemoveInput={this.handleRemoveInput} />
      ),
    });

    setTimeout(() => console.log(this.state));
  } 

  render() {
    console.log(this.state);
    return (
      <div className="card-block">
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
      </div>
    );
  }
}

export default ImageInputs;

if (document.getElementById('ImageInputs')) {
  ReactDOM.render(<ImageInputs />, document.getElementById('ImageInputs'));
}