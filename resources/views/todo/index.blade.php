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
    </div>
    ToDo Application with React.js
@stop
@section('scripts')
<script src="{{asset("/assets/js/jquery.min.js")}}"></script>
<script src="/js/todo.js"></script>
@stop
@section('title')
ToDo Application with React.js
@stop
