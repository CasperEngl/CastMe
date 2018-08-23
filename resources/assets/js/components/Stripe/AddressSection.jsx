import React, { Component, Fragment } from 'react';
import {
  Pagination,
  PaginationItem,
  PaginationLink,
  Row,
  Col,
  Label,
  Input,
} from 'reactstrap';

class AddressSection extends Component {
  constructor(props) {
    super(props);

    this.state = {
      days: null,
      fname: '',
      lname: '',
      company: '',
      address1: '',
      address2: '',
      zipCode: '',
      city: '',
      phoneNumber: '',
      email: '',
    };
  }

  handleDays(days) {
    this.setState({
      days,
    });
  }

  handleInput(event) {
    const { stateHandler } = this.props;

    const {
      target: {
        name,
        value,
      },
    } = event;

    this.setState({
      [name]: value,
    }, () => stateHandler(this.state));
  }

  render() {
    const { days } = this.state;

    return (
      <Fragment>
        <Pagination className="w-50 mt-4">
          <PaginationItem className="d-flex w-100" active={days === 60}>
            <PaginationLink className="w-100" onClick={() => this.handleDays(60)}>
              60 dage - 179 DKK
            </PaginationLink>
          </PaginationItem>
          <PaginationItem className="d-flex w-100" active={days === 90}>
            <PaginationLink className="w-100" onClick={() => this.handleDays(90)}>
              90 dage - 279 DKK
            </PaginationLink>
          </PaginationItem>
          <PaginationItem className="d-flex w-100" active={days === 180}>
            <PaginationLink className="w-100" onClick={() => this.handleDays(180)}>
              180 dage - 449 DKK
            </PaginationLink>
          </PaginationItem>
          <PaginationItem className="d-flex w-100" active={days === 365}>
            <PaginationLink className="w-100" onClick={() => this.handleDays(365)}>
              365 dage - 799 DKK
            </PaginationLink>
          </PaginationItem>
        </Pagination>
        <Row>
          <Col sm={6}>
            <Label>First name</Label>
            <Input name="fname" onChange={event => this.handleInput(event)} />
          </Col>
          <Col sm={6}>
            <Label>Last name</Label>
            <Input name="lname" onChange={event => this.handleInput(event)} />
          </Col>
        </Row>
        <Row>
          <Col>
            <Label>Country</Label>
            <Input name="country" onChange={event => this.handleInput(event)} />
          </Col>
        </Row>
        <Row>
          <Col>
            <Label>Street and house number</Label>
            <Input name="address1" onChange={event => this.handleInput(event)} />
          </Col>
        </Row>
        <Row>
          <Col>
            <Label>Stairway, floor etc.</Label>
            <Input name="address2" onChange={event => this.handleInput(event)} />
          </Col>
        </Row>
        <Row>
          <Col sm={6}>
            <Label>Zip code</Label>
            <Input name="zipCode" onChange={event => this.handleInput(event)} />
          </Col>
          <Col sm={6}>
            <Label>City</Label>
            <Input name="city" onChange={event => this.handleInput(event)} />
          </Col>
        </Row>
        <Row>
          <Col>
            <Label>Phone number</Label>
            <Input name="phoneNumber" onChange={event => this.handleInput(event)} />
          </Col>
        </Row>
        <Row>
          <Col>
            <Label>Email address</Label>
            <Input name="email" onChange={event => this.handleInput(event)} />
          </Col>
        </Row>
      </Fragment>
    );
  }
}

export default AddressSection;
