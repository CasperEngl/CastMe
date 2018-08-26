import { combineReducers } from 'redux';

import address from './addressReducer';
import subscription from './subscriptionReducer';

const rootReducer = combineReducers({
  address,
  subscription,
});

export default rootReducer;
