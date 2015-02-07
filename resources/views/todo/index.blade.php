@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="well bs-component">
                <fieldset>
                    <div id="todo"></div>
                </fieldset>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="well bs-component">
                <fieldset>
                    <h2>gulp sample</h2>
                    <pre>
                        <code class="js">
// bower install
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
 * compile React.js
 * $ gulp watch / gulp react or elixir
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
                        </code>
                    </pre>
                </fieldset>
            </div>
        </div>
    </div>
    ToDo Application with <a href="http://facebook.github.io/react/">React.js</a><br/>
    use laravel-elixir (gulp)
@stop
@section('scripts')
    <script src="/js/todo.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
@stop
@section('title')
    Single Page Application with React.js
@stop
@section('styles')
    <link href="/assets/css/github.css" rel="stylesheet">
@stop
@section('meta')
    <meta name="_token" content="{!!$xsrf_token!!}"/>
@stop
