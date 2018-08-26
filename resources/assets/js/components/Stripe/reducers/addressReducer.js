import { UPDATE_ADDRESS_FIELD } from '../actions/updateAddress';

const initialState = {
  fname: '',
  lname: '',
  address1: '',
  address2: '',
  zipCode: null,
  city: '',
};

export default function (state = initialState, action) {
  const { type, data } = action;

  switch (type) {
    case UPDATE_ADDRESS_FIELD:
      return {
        ...state,
        [data.field]: data.value,
      };

    default:
      return state;
  }
}
