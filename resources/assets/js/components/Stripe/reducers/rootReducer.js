import { combineReducers } from 'redux';

import subscription from './subscriptionReducer';

const rootReducer = combineReducers({
  subscription,
});

export default rootReducer;
