@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="well bs-component">
            <fieldset>
                <div class="markdown"></div>
            </fieldset>
        </div>
    </div>
@stop
@section('styles')
    <link href="/assets/css/github.css" rel="stylesheet">
@stop
@section('scripts')
    <script src="/assets/js/Showdown.min.js"></script>
    <script src="/assets/js/github.min.js"></script>
    <script src="/js/markdown.js"></script>
@stop
@section('meta')
    <meta name="_token" content="{!!$xsrf_token!!}"/>
@stop
@section('title')
    Reqltime Markdown Editor
@stop
