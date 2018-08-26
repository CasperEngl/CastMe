export const UPDATE_SELECTED_DAYS = 'UPDATE_SELECTED_DAYS';

export function updateSelectedDays(days) {
  return {
    type: UPDATE_SELECTED_DAYS,
    data: days,
  };
}
