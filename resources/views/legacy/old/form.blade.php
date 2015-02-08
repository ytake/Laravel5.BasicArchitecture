@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="well bs-component">
            <h2>Sample Form</h2>
            <div class="alert alert-dismissable alert-info">
                <strong>このフォームはLaravel4デフォルトと同様にnamespaceを使わずに実装されています</strong>
            </div>
            <fieldset>
                <form method="POST" action="{{route('legacy.confirm')}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">

                    <div class="form-group @if($errors->has('name'))has-error @endif">
                        <label class="control-label" for="name">お名前 {{$errors->first('name')}}</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{Input::old('name')}}"
                               placeholder="お名前">
                    </div>
                    <div class="form-group @if($errors->has('email'))has-error @endif">
                        <label class="control-label" for="email">メールアドレス {{$errors->first('email')}}</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{Input::old('email')}}"
                               placeholder="メールアドレス">
                    </div>
                    <button type="submit" class="btn btn-primary">confirm</button>
                </form>
            </fieldset>
        </div>
        <div class="well bs-component">
            <h2>composer.jsonは自由に変更ですることができます</h2>
            <pre>このサンプルで利用しているコントローラーは、classmapを利用しています。</pre>
            <pre>
                <code class="js">
                    "autoload": {
                      "classmap": [
                        "database",
                        "app/Http/Controllers/Old"
                      ],
                      "psr-4": {
                        "App\\": "app/"
                      }
                    },
                </code>
            </pre>
        </div>
    </div>
@stop
@section('scripts')
    <script>hljs.initHighlightingOnLoad();</script>
@stop
@section('styles')
    <link href="/assets/css/github.css" rel="stylesheet">
@stop
