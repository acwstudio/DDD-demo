const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copyDirectory('node_modules/admin-lte/plugins', 'public/admin/plugins')
    .copyDirectory('node_modules/admin-lte/dist', 'public/admin/dist')

    .copyDirectory('resources/shop/css', 'public/shop/css')
    .copyDirectory('resources/shop/fonts', 'public/shop/fonts')
    .copyDirectory('resources/shop/js', 'public/shop/js')
;
