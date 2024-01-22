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

// mix.webpackConfig({
//     resolve: {
//         alias: {
//             'jquery$': 'jquery/dist/jquery.slim.min.js',
//         }
//     }
// });

mix.autoload({
    jquery: ['$', 'window.jQuery']
});

mix.extract([
    'alpinejs',
    'jquery',
    'bootstrap',
    'popper.js',
    'axios',
    'sweetalert2',
    'lodash'
]);

mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/cellsite.js', 'public/js')
    .js('resources/js/edit_user.js', 'public/js')
    .js('resources/js/renderCertificate.js', 'public/js')
    .js('resources/js/dashboard.js', 'public/js')
    .sass('resources/scss/volt.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
    ])
    .version()
    .sourceMaps();


if (mix.inProduction()) {
    mix.version();
} else {
    // Uses inline source-maps on development
    mix.webpackConfig({
        devtool: 'inline-source-map'
    });

    mix.disableSuccessNotifications();
}



