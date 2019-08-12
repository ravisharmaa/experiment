const mix = require('laravel-mix')

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

mix.js(
  [
    'resources/js/app.js',
    'resources/js/dashboard.js',
    'resources/js/scripts.js'
  ], 'public/js')
  .sass('resources/sass/app.scss', 'public/css');
    // .browserSync('http://127.0.0.1:8000');

mix.styles([
  'resources/css/bootstrap.css',
  'resources/css/metis-menu.css',
  'resources/css/timeline.css',
  'resources/css/startmin.css',
  'resources/css/morris.css',
  'resources/css/fa.css',
  'resources/css/epoch.css',
  'resources/css/previous_custom.css',
  'resources/css/custom.css',
  'resources/css/styles.css',
  'resources/css/materialdesignicons.min.css',
], 'public/css/admin.css');