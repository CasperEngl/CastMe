import React, { Component, Fragment } from 'react';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import PropTypes from 'prop-types';
import {
  Pagination,
  PaginationItem,
  PaginationLink,
  Row,
  Col,
  Label,
  Input,
} from 'reactstrap';

import { updateAddressField } from './actions/updateAddress';
import { updateSelectedDays } from './actions/updateSubscription';

class AddressSection extends Component {
  static propTypes = {
    updateAddressField: PropTypes.func.isRequired,
    updateSelectedDays: PropTypes.func.isRequired,
    selectedDays: PropTypes.number.isRequired,
    fname: PropTypes.string.isRequired,
    lname: PropTypes.string.isRequired,
    address1: PropTypes.string.isRequired,
    address2: PropTypes.string.isRequired,
    zipCode: PropTypes.number.isRequired,
    city: PropTypes.string.isRequired,
  }

  handleDays(days) {
    const { updateSelectedDays } = this.props;

    updateSelectedDays(days);
  }

  handleInput(event) {
    const { updateAddressField } = this.props;
    const { name, value } = event.target;

    updateAddressField(name, value);
  }

  render() {
    const {
      selectedDays,
      fname,
      lname,
      address1,
      address2,
      zipCode,
      city,
    } = this.props;

    return (
      <Fragment>
        <Row>
          <Col sm={6}>
            <Label>First name</Label>
            <Input name="fname" onChange={event => this.handleInput(event)} defaultValue={fname} />
          </Col>
          <Col sm={6}>
            <Label>Last name</Label>
            <Input name="lname" onChange={event => this.handleInput(event)} defaultValue={lname} />
          </Col>
        </Row>
        <Row>
          <Col>
            <Label>Street and house number</Label>
            <Input name="address1" onChange={event => this.handleInput(event)} defaultValue={address1} />
          </Col>
        </Row>
        <Row>
          <Col>
            <Label>Stairway, floor etc.</Label>
            <Input name="address2" onChange={event => this.handleInput(event)} defaultValue={address2} />
          </Col>
        </Row>
        <Row>
          <Col sm={6}>
            <Label>Zip code</Label>
            <Input name="zipCode" onChange={event => this.handleInput(event)} defaultValue={zipCode} />
          </Col>
          <Col sm={6}>
            <Label>City</Label>
            <Input name="city" onChange={event => this.handleInput(event)} defaultValue={city} />
          </Col>
        </Row>
        <Pagination className="w-50 mt-4">
          <PaginationItem className="d-flex w-100" active={selectedDays === 60}>
            <PaginationLink className="w-100" onClick={() => this.handleDays(60)}>
              60 dage - 179 DKK
            </PaginationLink>
          </PaginationItem>
          <PaginationItem className="d-flex w-100" active={selectedDays === 90}>
            <PaginationLink type="button" className="w-100" onClick={() => this.handleDays(90)}>
              90 dage - 279 DKK
            </PaginationLink>
          </PaginationItem>
          <PaginationItem className="d-flex w-100" active={selectedDays === 180}>
            <PaginationLink className="w-100" onClick={() => this.handleDays(180)}>
              180 dage - 449 DKK
            </PaginationLink>
          </PaginationItem>
          <PaginationItem className="d-flex w-100" active={selectedDays === 365}>
            <PaginationLink className="w-100" onClick={() => this.handleDays(365)}>
              365 dage - 799 DKK
            </PaginationLink>
          </PaginationItem>
        </Pagination>
      </Fragment>
    );
  }
}

const mapStateToProps = state => ({
  selectedDays: state.subscription.selectedDays,
  fname: state.address.fname,
  lname: state.address.lname,
  address1: state.address.address1,
  address2: state.address.address2,
  zipCode: state.address.zipCode,
  city: state.address.city,
});

const mapDispatchToProps = dispatch => bindActionCreators({
  updateAddressField,
  updateSelectedDays,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(AddressSection);
