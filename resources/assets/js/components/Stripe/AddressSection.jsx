/*
eslint

no-shadow: 0,
*/

import React, { Component } from 'react';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import PropTypes from 'prop-types';
import {
  Pagination,
  PaginationItem,
  PaginationLink,
} from 'reactstrap';

import { updateSelectedDays } from './actions/updateSubscription';

class AddressSection extends Component {
  static propTypes = {
    updateSelectedDays: PropTypes.func.isRequired,
    selectedDays: PropTypes.number.isRequired,
  }

  handleDays(days) {
    const { updateSelectedDays } = this.props;

    updateSelectedDays(days);
  }

  render() {
    const { selectedDays } = this.props;

    return (
      <Pagination className="w-100">
        <PaginationItem className="d-flex w-100" active={selectedDays === 60}>
          <PaginationLink className="w-100" onClick={() => this.handleDays(60)}>
            2 måneder - 179 DKK
          </PaginationLink>
        </PaginationItem>
        <PaginationItem className="d-flex w-100" active={selectedDays === 90}>
          <PaginationLink type="button" className="w-100" onClick={() => this.handleDays(90)}>
            3 måneder - 279 DKK
          </PaginationLink>
        </PaginationItem>
        <PaginationItem className="d-flex w-100" active={selectedDays === 180}>
          <PaginationLink className="w-100" onClick={() => this.handleDays(180)}>
            6 måneder - 449 DKK
          </PaginationLink>
        </PaginationItem>
        <PaginationItem className="d-flex w-100" active={selectedDays === 365}>
          <PaginationLink className="w-100" onClick={() => this.handleDays(365)}>
            12 måneder - 799 DKK
          </PaginationLink>
        </PaginationItem>
      </Pagination>
    );
  }
}

const mapStateToProps = state => ({
  selectedDays: state.subscription.selectedDays,
});

const mapDispatchToProps = dispatch => bindActionCreators({
  updateSelectedDays,
}, dispatch);

export default connect(mapStateToProps, mapDispatchToProps)(AddressSection);
