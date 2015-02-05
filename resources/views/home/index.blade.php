@extends('layouts.default')
@section('content')
    <ul>
        <li>
            <p class="lead">
                <a href="{{route('todo.front.index')}}">ToDo Application</a>
                <br />
                Router, Event Annotation / FormRequest / DI / basic json response
            </p>
        </li>
    </ul>
@stop
@section('title')
    Laravel5 Tutorial.Application
@stop
