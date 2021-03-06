var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
        .sass('laravel.scss', 'public/assets/css/laravel.css')
        .scripts(
            [
                'jquery.js',
                'plugins/prism.js',
                'plugins/bootstrap.js',
                'plugins/scotchPanels.js',
                'laravel.js'
            ],
            'public/assets/js/laravel.js',
    	    'resources/assets/js/'
        )
        .version([
        'public/assets/css/laravel.css',
        'public/assets/js/laravel.js'
    ]);
});
