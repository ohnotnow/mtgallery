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
    mix.scripts([
        'jquery.js',
        'lightbox.min.js',
        'shine.min.js'
    ], './public/public.js');
    mix.scripts([
    	'jquery.js',
    	'bootstrap.min.js',
    	'dropzone.js',
    	'select2.min.js'
    ], './public/admin.js');
    mix.scripts([
        'jquery.js',
        'jquery.easing.min.js',
        'supersized.3.2.7.js',
        'supersized.shutter.js'
    ], './public/slideshow.js');
    mix.styles([
    	'public.css',
    	'monkeytwizzle.css',
    	'lightbox.css'
    ], './public/public.css');
    mix.styles([
    	'monkeytwizzle.css',
    	'supersized.css',
        'supersized.shutter.css'
    ], './public/slideshow.css');
    mix.styles([
    	'monkeytwizzle.css',
    	'bootstrap.css',
    	'dropzone.css',
    	'select2.min.css'
    ], './public/admin.css');
});
