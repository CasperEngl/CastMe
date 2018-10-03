/*
eslint

consistent-return: 0,
no-undef: 0,
*/

import config from './config';

async function getLocale() {
  try {
    const response = await fetch(`/api/locale/user/${user}`, {
      method: 'POST',
    });
    const result = await response.json();

    if (Object.keys(config.app.supported_languages).includes(result.lang)) {
      return result.lang;
    }
  } catch (err) {
    // console.log(err);
  }
}

export default getLocale;
