var elixir = require('laravel-elixir'),
    gulp = require('gulp'),
    bower = require('bower'),
    notify = require('gulp-notify'),
    react = require('gulp-react'),
    uglify = require('gulp-uglify'),
    minifyCSS = require('gulp-minify-css'),
    gulpFilter = require('gulp-filter'),
    urlAdjuster = require('gulp-css-url-adjuster'),
    mainBowerFiles = require('main-bower-files');

var assetsDir = elixir.config.assetsDir;

elixir.extend('bowerInstall', function () {
    gulp.task('bower', function () {
        return bower.commands.install([], {save: true}, {})
            .on('end', function (data) {
                console.log(data);
            });
    });
    return this.queueTask("bower");
});

/**
 * bower install後に各assetsファイルを指定のディレクトリへ設置します
 * $ gulp publish
 * bowerタスクは自動で実行されます
 */
elixir.extend('assetsPublish', function () {
    gulp.task('publish', function () {
        var jsFilter = gulpFilter('**/*.js');
        var cssFilter = gulpFilter('**/*.css');
        var fontFilter = gulpFilter([
            '**/*webfont*',
            "**/Font*",
            "**/glyphicons-*"
        ]);
        var imageFilter = gulpFilter(['**/*.png', "**/*.gif"]);
        return gulp.src(
            mainBowerFiles({
                paths: {
                    bowerDirectory: 'vendor/bower_components',
                    bowerrc: '.bowerrc',
                    bowerJson: 'bower.json'
                }
            })
        )
            .pipe(jsFilter)
            .pipe(gulp.dest('public/assets/js'))
            .pipe(jsFilter.restore())
            .pipe(cssFilter)
            .pipe(urlAdjuster({
                replace: ['../fonts/', ''],
                prepend: '/assets/fonts/'
            }))
            .pipe(minifyCSS())
            .pipe(gulp.dest('public/assets/css'))
            .pipe(cssFilter.restore())
            .pipe(fontFilter)
            .pipe(gulp.dest('public/assets/fonts'))
            .pipe(fontFilter.restore())
            .pipe(imageFilter)
            .pipe(gulp.dest('public/images'));
    });
    return this.queueTask("publish");
});
/**
 * React.js コンパイル
 * $ gulp react
 */
elixir.extend('reactPreCompile', function () {
    gulp.task('react', function () {
        return gulp.src('resources/js/react/**/*.jsx')
            .pipe(react())
            .pipe(uglify())
            .pipe(gulp.dest('public/js'));
    });
    this.registerWatcher('react', 'resources/js/react/**/*.jsx');
    return this.queueTask("react");
});

/**
 * browser reload
 * $ gulp browserSync
 */
gulp.task('browserSync', function () {
    browserSync({
        open: true,
        port: 3001,
        proxy: "127.0.0.1",
        notify: false
    });
});

/**
 * browser reload
 * $ gulp browserReload
 */
gulp.task('browserReload', function (){
    browserSync.reload();
});

elixir(function (mix) {
    mix.bowerInstall()
        .assetsPublish()
        .reactPreCompile()
        .sass("*.scss");
});
