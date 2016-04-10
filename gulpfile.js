var elixir = require('laravel-elixir');

require('laravel-elixir-vueify');

elixir(function(mix) {
    mix
    .browserify('landing.js')
    .browserify('movie-app.js')
    .browserify('contact.js')
    .sass('contact.scss')
    .sass('movie.scss')
    .sass('login.scss')
    .sass('landing.scss')
    ;
});
