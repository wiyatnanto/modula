const dotenvExpand = require('dotenv-expand')
dotenvExpand(require('dotenv').config({ path: '../../.env' /*, debug: true*/ }))

const mix = require('laravel-mix')
require('laravel-mix-merge-manifest')

mix.setPublicPath('../../public').mergeManifest()

mix.styles([
    __dirname + '/Resources/assets/backend/vendor/bootstrap/css/bootstrap.min.css',
    __dirname + '/Resources/assets/backend/vendor/perfect-scrollbar/css/perfect-scrollbar.css',
    __dirname + '/Resources/assets/backend/vendor/select2/select2.min.css',
    __dirname + '/Resources/assets/backend/vendor/jquery.toast/jquery.toast.min.css',
    __dirname + '/Resources/assets/backend/css/light/style.css'

], '../../public/css/theme.css').sourceMaps();

mix.scripts([
    __dirname + '/Resources/assets/backend/vendor/jquery/jquery-3.6.0.min.js',
    __dirname + '/Resources/assets/backend/vendor/bootstrap/js/bootstrap.bundle.min.js',
    __dirname + '/Resources/assets/backend/vendor/perfect-scrollbar/js/perfect-scrollbar.min.js',
    __dirname + '/Resources/assets/backend/vendor/select2/select2.min.js',
    __dirname + '/Resources/assets/backend/vendor/select2/select2.multi-checkboxes.js',
    __dirname + '/Resources/assets/backend/vendor/jquery.toast/jquery.toast.min.js',
    __dirname + '/Resources/assets/backend/vendor/bootbox/bootbox.min.js'
], '../../public/js/theme.js').sourceMaps();

mix.styles([
    __dirname + '/Resources/assets/backend/vendor/grapes/css/grapes.min.css'
], '../../public/css/theme-builder.css').sourceMaps();

mix.scripts([
    __dirname + '/Resources/assets/backend/vendor/grapes/grapes.min.js'
], '../../public/js/theme-builder.js').sourceMaps();

if (mix.inProduction()) {
    mix.version()
}
