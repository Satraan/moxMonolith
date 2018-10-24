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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.less('public/css/style.less', 'public/css');
mix.less('public/css/user.less', 'public/css/user.css');

mix.styles([
    'public/css/semantic.min.css'
], 'public/css/app.css');

var feather = require('feather-icons');
