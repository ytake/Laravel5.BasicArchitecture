@extends('layouts.default')
@section('content')
    <div class="row">
        <div class="well bs-component">
            <h2>Sample Form Confirm</h2>
            <fieldset>
                <form method="POST" action="{{route('legacy.apply')}}">
                    <input type="hidden" name="_token" value="{{Input::get('_token')}}">
                    <input type="hidden" name="name" value="{{Input::get('name')}}">
                    <input type="hidden" name="email" value="{{Input::get('email')}}">
                    <div class="form-group">
                        <label class="control-label" for="name">お名前</label>
                        {{Input::get('name')}}
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="email">メールアドレス</label>
                        {{Input::get('email')}}
                    </div>
                    <input class="btn btn-danger" name="_return" type="submit" value="return">
                    <input class="btn btn-primary" name="_apply" type="submit" value="apply">
                </form>
            </fieldset>
        </div>
    </div>
@stop
@section('title')
    Simple Form Confirm
@stop
