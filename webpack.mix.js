const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
  .react('resources/assets/js/app.jsx', 'public/js')
  .js('resources/assets/js/tm-editor-da.js', 'public/js')
  .js('resources/assets/js/tm-editor-en.js', 'public/js')
  .sass('resources/assets/sass/app.scss', 'public/css');

if (mix.inProduction()) {
  mix.version();
} else {
  mix.browserSync({
    proxy: process.env.APP_URL,
  });
}
