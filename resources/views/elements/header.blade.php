{{-- header --}}
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{route('index')}}">Tutorial.Application</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @if(Request::path() === '/')class="active" @endif><a href="{{URL::route('index')}}">Home</a></li>
                <li @if(Request::path() === 'todo')class="active" @endif><a href="{{URL::route('todo.front.index')}}">ToDo Application</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

