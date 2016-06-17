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
    mix.sass('app.scss')
        .browserify('home.js')
        .styles([
            'codemirror/lib/codemirror.css',
            'codemirror/theme/yeti.css',
            'codemirror/theme/neo.css'
        ],'public/css/codemirror.css','node_modules/')
        .scripts([
            'codemirror/lib/codemirror.js',
            'codemirror/mode/javascript/javascript.js'
        ], 'public/js/codemirror.js', 'node_modules/');
});


