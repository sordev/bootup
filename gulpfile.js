var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
	mix.styles([
        'animate.css',
    ]);
	/*
	mix.scripts([
        'jquery.js',
        'app.js'
    ]);
	*/
	mix.copy('node_modules/bootstrap-sass/assets/fonts/bootstrap', 'public/fonts/bootstrap');
	mix.copy('node_modules/bootstrap-sass/assets/javascripts', 'public/js');
});
