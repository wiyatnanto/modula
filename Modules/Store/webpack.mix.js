const dotenvExpand = require('dotenv-expand')
dotenvExpand(require('dotenv').config({ path: '../../.env' /*, debug: true*/ }))

const mix = require('laravel-mix')
require('laravel-mix-merge-manifest')

mix.setPublicPath('../../public').mergeManifest()

mix.styles([
    __dirname + '/Resources/assets/vendor/filepond/filepond.min.css',
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-preview.css',
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-edit.css',
    __dirname + '/Resources/assets/vendor/nestable2/jquery.nestable.min.css',
    __dirname + '/Resources/assets/vendor/cascader/cascader.css',
    __dirname + '/Resources/assets/css/app.css',
], '../../public/css/store.css').sourceMaps();

mix.scripts([
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-preview.js',
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-resize.js',
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-transform.js',
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-crop.js',
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-edit.js',
    __dirname + '/Resources/assets/vendor/filepond/filepond.min.js',
    __dirname + '/Resources/assets/vendor/maskMoney/jquery.maskMoney.min.js',
    __dirname + '/Resources/assets/vendor/nestable2/jquery.nestable.min.js',
    __dirname + '/Resources/assets/vendor/moveable/moveable.min.js',
    __dirname + '/Resources/assets/vendor/cascader/cascader.js',
    __dirname + '/Resources/assets/js/app.js',
], '../../public/js/store.js').sourceMaps();

if (mix.inProduction()) {
    mix.version()
}
