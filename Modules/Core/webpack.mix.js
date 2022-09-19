const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.styles([
    __dirname + '/Resources/assets/vendor/nestable2/jquery.nestable.min.css',
    __dirname + '/Resources/assets/css/app.css',
], '../../public/css/core.css').sourceMaps();

mix.scripts([
    __dirname + '/Resources/assets/vendor/nestable2/jquery.nestable.min.js',
    __dirname + '/Resources/assets/js/app.js',
], '../../public/js/core.js').sourceMaps();

if (mix.inProduction()) {
    mix.version();
}
