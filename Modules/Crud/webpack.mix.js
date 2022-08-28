const dotenvExpand = require('dotenv-expand')
dotenvExpand(require('dotenv').config({ path: '../../.env' /*, debug: true*/ }))

const mix = require('laravel-mix')
require('laravel-mix-merge-manifest')

const MonacoWebpackPlugin = require('monaco-editor-webpack-plugin')

mix.setPublicPath('../../public').mergeManifest()

mix.webpackConfig({
    plugins: [
        new MonacoWebpackPlugin({
            languages: ['handlebars', 'html'],
            features: [
                'accessibilityHelp',
                'anchorSelect',
                'bracketMatching',
                'caretOperations',
                'folding',
                'format'
            ],
            globalAPI: true
        })
    ]
})

mix.js(__dirname + '/Resources/assets/js/app.js', 'js/crud.js')
    .js(__dirname + '/Resources/assets/js/monaco.js', 'js/monaco.js')
    .sass(__dirname + '/Resources/assets/sass/app.scss', 'css/crud.css')

if (mix.inProduction()) {
    mix.version()
}
