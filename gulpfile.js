var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

elixir(function(mix) {
	mix
    .browserify('landing.js')
    .browserify('login.js')
    .browserify('home.js')
    .browserify('movie.js')
    .browserify('contact.js')
    .browserify('equilibrium.js')
    .browserify('permission.js')
    .sass('landing.scss')
    .sass('login.scss')
    .sass('home.scss')
    .sass('movie.scss')
    .sass('contact.scss')
    .sass('equilibrium.scss')
    .sass('permission.scss')
    ;
});
