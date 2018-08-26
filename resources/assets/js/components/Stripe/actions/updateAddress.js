export const UPDATE_ADDRESS_FIELD = 'UPDATE_ADDRESS_FIELD';

export function updateAddressField(field, value) {
  return {
    type: UPDATE_ADDRESS_FIELD,
    data: {
      field,
      value,
    },
  };
}
