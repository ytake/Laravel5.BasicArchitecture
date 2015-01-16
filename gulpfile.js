"use strict";
var elixir = require('laravel-elixir'),
    gulp = require('gulp'),
    bower = require('bower'),
    shell = require('gulp-shell'),
    notify = require('gulp-notify');

var jsOutput = elixir.config.jsOutput,
    bowerDir = elixir.config.bowerDir,
    assetsDir = elixir.config.assetsDir;

var paths = {
    foundation: bowerDir + '/foundation/'
};

var configure = {
    "php_server": {
        "port": 8881,
        "path": "public"
    }
};

gulp.task('bower', function () {
    return bower.commands.install([], {save: true}, {})
        .on('end', function (data) {
            console.log(data);
        });
});

elixir.extend('foundation', function () {
    gulp.task('copyfoundation', ['bower'], function () {
        gulp.src(paths.foundation + 'scss/**/*.scss')
            .pipe(gulp.dest(assetsDir + '/sass'));
    });
    return this.queueTask("copyfoundation");
});

elixir(function (mix) {
    mix.foundation()
        .sass("normalize.scss")
        .sass("foundation.scss")
        .copy(bowerDir + "/jquery/dist/jquery.min.js", jsOutput + "/jquery.min.js")
        .copy(bowerDir + "/react/react.min.js", jsOutput + "/react.min.js")
        .copy(bowerDir + "/react/react-with-addons.min.js", jsOutput + "/react-with-addons.min.js");
});

gulp.task('php_server', ['watch'], function () {
    var phpPort = configure.php_server.port,
        phpPath = configure.php_server.path;
    return gulp.src('')
        .pipe(notify({
            title: "booting php server",
            message: 'localhost:' + phpPort
        }))
        .pipe(shell('php -S localhost:' + phpPort+ ' -t ' + phpPath, {ignoreErrors: true }))
        .on('error', notify.onError({
            title: "php server error",
            message: "Error(s) occurred ..."
        }))
});

gulp.task('watch', function(){
    gulp.watch(['app/**/*.php'], ['php_server']);
});
