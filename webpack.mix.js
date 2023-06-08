const mix = require('laravel-mix');


mix.js('resources/js/home.js', 'public/js').react();
mix.js('resources/js/productDetail.js', 'public/js').react();
mix.js('resources/js/Detail.js', 'public/js').react();
mix.js('resources/js/Profile.js', 'public/js').react();
