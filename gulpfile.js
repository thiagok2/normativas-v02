var elixir = require("laravel-elixir");

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

//require("laravel-elixir-images");

var paths = {
    jquery: "./node_modules/jquery/dist/",
    jquerymigrate: "./node_modules/jquery-migrate/dist/",
    bootstrap: "./node_modules/bootstrap/dist/"
};

elixir(function(mix) {
    mix.sass("app-search.scss")
        .sass("app-admin.scss")
        .scripts("normativas-search.js")
        .copy(paths.bootstrap + "css/bootstrap.min.css", "public/css")
        .copy("node_modules/font-awesome/fonts/*.*", "public/fonts/")
        .copy(paths.jquery + "jquery.min.js", "public/js")
        .copy(paths.jquerymigrate + "jquery-migrate.min.js", "public/js")
        .copy(paths.bootstrap + "js/bootstrap.min.js", "public/js")

        //.images(null, null, { webp: false })
        .browserSync({
            proxy: "127.0.0.1:5000",
            files: ["public/**/*.css", "resources/**/*"]
        });
});
