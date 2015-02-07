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
                <li @if(Request::path() === '/')class="active" @endif><a href="{{route('index')}}">Home</a></li>
                <li @if(Request::path() === 'todo')class="active" @endif><a href="{{route('todo.front.index')}}">Single Page Application</a></li>
                <li @if(Request::path() === 'markdown')class="active" @endif><a href="{{route('markdown.index')}}">RealTime Markdown Editor</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

