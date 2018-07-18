
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// Add jQuery to global scope
global.$ = global.jQuery = require('jquery');

require('popper.js/dist/popper.min');
require('bootstrap/dist/js/bootstrap.min');
require('tinymce/tinymce.min');

require('./file-input/fileinput-custom');
require('./pagination-click');