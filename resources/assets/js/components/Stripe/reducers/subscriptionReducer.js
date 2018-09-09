const initialState = {
  selectedDays: 60,
};

export default function (state = initialState, action) {
  const { type, data } = action;

  switch (type) {
    case 'UPDATE_SELECTED_DAYS':
      return {
        ...state,
        selectedDays: data,
      };

    default:
      return state;
  }
}
