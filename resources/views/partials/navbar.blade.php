<nav class="navbar navbar-default" style="background-color:rgba(170, 212, 226, 0.4);">
    <div class="container">

        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand">
                <span class="glyphicon glyphicon-tower" aria-hidden="true"></span>
                VideoClub
            </a>
        </div>

        @if(Auth::check())
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li{{ Request::is('/catalog*') && !Request::is('/catalog/create')? ' class=active' : ''}}>
                    <a href="{{ url('/catalog') }}">
                        <span class="glyphicon glyphicon-film" aria-hidden="true"></span>
                        Catálogo
                    </a>
                </li>
                <li{{ Request::is('/catalog/create') ? ' class=active' : ''}}>
                    <a href="{{ url('/catalog/create') }}">
                        <span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>
                        Nueva película
                    </a>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        Cerrar sesión
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
        @endif
    </div>
</nav>
