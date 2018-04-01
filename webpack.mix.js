let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .copy('node_modules/flag-icon-css/','public/css/flag-icon-css')
    .copy('node_modules/simple-line-icons/','public/css/simple-line-icons')
    .copy('node_modules/font-awesome/','public/css/font-awesome/')
    .copy('node_modules/jquery/dist/jquery.min.js','public/js/jquery.min.js')
    .copy('node_modules/popper.js/dist/umd/popper.min.js','public/js/popper.min.js')
    .copy('node_modules/bootstrap/dist/js/bootstrap.min.js','public/js/bootstrap.min.js')
    .copy('node_modules/pace-progress/pace.min.js','public/js/pace.min.js')
    .copy('node_modules/chart.js/dist/Chart.min.js','public/js/chart.min.js');