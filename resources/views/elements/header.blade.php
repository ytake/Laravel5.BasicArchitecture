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
            <a class="navbar-brand" href="{{URL::route('index')}}">Tutorial.Application</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li @if(Request::path() === '/')class="active" @endif><a href="{{URL::route('index')}}">Home</a></li>
                <li @if(Request::path() === 'todo')class="active" @endif><a href="{{URL::route('todo.front.index')}}">ToDo Application</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>
<a href="https://github.com/ytake/Tutorial.Laravel5">
    <img style="position: absolute; top: 0; left: 0; border: 0; z-index: 10000;" src="https://camo.githubusercontent.com/8b6b8ccc6da3aa5722903da7b58eb5ab1081adee/68747470733a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f6c6566745f6f72616e67655f6666373630302e706e67" alt="Fork me on GitHub" data-canonical-src="https://s3.amazonaws.com/github/ribbons/forkme_left_orange_ff7600.png">
</a>
