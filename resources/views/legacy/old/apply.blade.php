@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="well bs-component">
            <h2>Sample Form Apply</h2>
            <fieldset>
                <pre>
                    <code class="json">
                        {!!json_encode($request)!!}
                    </code>
                </pre>
                <a href="{{route('legacy.form')}}" class="btn btn-primary" >return form</a>
            </fieldset>
        </div>
    </div>
@stop
@section('scripts')
    <script>hljs.initHighlightingOnLoad();</script>
@stop
@section('title')
    no namespace form Sample
@stop
@section('styles')
    <link href="/assets/css/github.css" rel="stylesheet">
@stop
