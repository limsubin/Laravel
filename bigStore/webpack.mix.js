const mix = require('laravel-mix');

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

// mix.js('resources/js/app.js', 'public/js')
//    .sass('resources/sass/app.scss', 'public/css');

//laravel-mixWebpack 주위에 래퍼를 제공하는 구성 파일이 들어 있습니다 .
//이를 통해 Webpack 구성을 직접 작성하지 않고도 Webpack의 놀라운 자산 편집 기능을 활용할 수 있습니다
mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/bootstrap.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');
