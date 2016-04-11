var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

elixir(function(mix) {
	mix
    .browserify('landing.js')
    .browserify('login.js')
    .browserify('home.js')
    .browserify('movie.js')
    .browserify('contact.js')
	//.sass('landing.scss')
	//.sass('login.scss')
    //.sass('home.scss')
    //.sass('movie.scss')
    .sass('contact.scss')
    ;
});
