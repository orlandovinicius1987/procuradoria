let mix = require('laravel-mix')

let LiveReloadPlugin = require('webpack-livereload-plugin')

mix
  .js(
    [
      'resources/assets/js/app.js',
      'resources/assets/packages/select2-to-tree/select2-to-tree-master/src/select2totree.js',
    ],
    'public/js/app.js',
  )
    .vue({version:2})
  .sass('resources/assets/sass/app.scss', 'public/css')
  .version()

mix.webpackConfig({
  plugins: [new LiveReloadPlugin()],
})
