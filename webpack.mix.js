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
// mix.copy('node_modules/select2/dist/js/select2.full.min.js', 'public/js');

// mix.copy('node_modules/select2/dist/css/select2.min.css', 'public/css');
// mix.copy('node_modules/select2/src/scss', 'resources/assets/scss');
mix.js('resources/assets/js/app.js', 'public/js')



    .sass('resources/assets/sass/app.sass', 'public/css')
    .sass('resources/assets/scss/core.scss', 'public/css/select2.css')
    .browserSync({
        proxy: "http://diplom",
        notify: false
    });
//  mix.autoload({
//     'jquery': ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery"],
//     'popper.js/dist/umd/popper.js': ['Popper', 'window.Popper']
// });