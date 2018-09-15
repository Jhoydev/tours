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
mix.js('resources/assets/js/main.js', 'public/js')
        .sass('resources/assets/sass/main.scss', 'public/css')

mix.js('resources/assets/js/vue/user.js', 'public/js/vue')
        .js('resources/assets/js/vue/user.js', 'public/vue')

mix.js('resources/assets/js/vue/customer.js', 'public/js/vue')
        .js('resources/assets/js/vue/customer.js', 'public/vue')

mix.js('resources/assets/js/vue/role.js', 'public/js/vue')
        .js('resources/assets/js/vue/role.js', 'public/vue')

mix.babel('resources/assets/js/app.js', 'public/js/app.js')