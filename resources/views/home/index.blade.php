@extends('layouts.default')
@section('content')
    <h1><i class="mdi-alert-error"></i>Laravel5 Sample Application</h1>
    <ul>
        <li>
            <p class="lead">
                <a href="{{route('todo.front.index')}}">Single Page Application</a>
                <br />
                basic json response / laravel-elixir / event
            </p>
        </li>
        <li>
            <p class="lead">
                <a href="{{route('markdown.index')}}">RealTime Markdown Editor</a>
                <br />
                basic json response / command bus
            </p>
        </li>
    </ul>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><i class="mdi-av-play-circle-fill"></i>Gulpを動かすにはnode.jsが必要です</h3>
        </div>
        <div class="panel-body">
            <a href="http://nodejs.org/" target="_blank">http://nodejs.org/</a>
        </div>
    </div>
@stop
@section('title')
Laravel5 Tutorial.Application
@stop
@section('styles')
    <link href="/assets/css/github.css" rel="stylesheet">
@stop