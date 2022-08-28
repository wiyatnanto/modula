const dotenvExpand = require('dotenv-expand');
dotenvExpand(require('dotenv').config({ path: '../../.env'/*, debug: true*/}));

const mix = require('laravel-mix');
require('laravel-mix-merge-manifest');

mix.setPublicPath('../../public').mergeManifest();

mix.js(__dirname + '/Resources/assets/js/store.js', 'public/modules/store/js/store.js')
   .styles([
        __dirname + '/Resources/assets/css/layout.css',
        __dirname + '/Resources/assets/css/store.css'
    ],'../../public/modules/store/css/store.css').sourceMaps();

mix.styles([
    __dirname + '/Resources/assets/vendor/filepond/filepond.min.css',
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-preview.css',
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-edit.css',
    __dirname + '/Resources/assets/vendor/jquery.nestable/jquery.nestable.min.css',
    __dirname + '/Resources/assets/vendor/select2/css/select2.min.css',
], '../../public/modules/store/css/store-bundle.css').sourceMaps();

mix.scripts([
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-preview.js',
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-resize.js',
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-transform.js',
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-crop.js',
    __dirname + '/Resources/assets/vendor/filepond/filepond-plugin-image-edit.js',
    __dirname + '/Resources/assets/vendor/filepond/filepond.min.js',
    __dirname + '/Resources/assets/vendor/jquery.nestable/jquery.nestable.min.js',
    __dirname + '/Resources/assets/vendor/select2/js/select2.min.js',
    __dirname + '/Resources/assets/vendor/select2/js/select2.multi-checkboxes.js',
    __dirname + '/Resources/assets/vendor/maskMoney/jquery.maskMoney.min.js'
], '../../public/modules/store/js/store-bundle.js').sourceMaps();

if (mix.inProduction()) {
    mix.version();
}
