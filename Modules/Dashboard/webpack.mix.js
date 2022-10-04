const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

// mix.js(__dirname + '/Resources/assets/js/app.js', 'js/dashboard.js')
//     .sass( __dirname + '/Resources/assets/sass/app.scss', 'css/dashboard.css');

mix.styles([
    __dirname + '/Resources/assets/css/app.css'

], '../../public/css/dashboard.css').sourceMaps();

mix.scripts([
    __dirname + '/Resources/assets/vendor/apexcharts/apexcharts.min.js',
    __dirname + '/Resources/assets/js/app.js',
], '../../public/js/dashboard.js').sourceMaps();
if (mix.inProduction()) {
    mix.version();
}
