<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- Branding Image -->
            <strong>
                <a class="navbar-brand" style="color: darkslategray;" href="{{ url('/') }}">{{ config('app.name', 'Reenev') }}</a>
            </strong>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                <li><a href="{{ route('register') }}">Registrarme</a></li>
                <li><a href="{{ route('login') }}">Entrar</a></li>
                @else
                @cannot('es_admin', App\User::class)
                <li><a href="{{ route('Realizadas.create')}}">Completar encuesta</a></li>
                <li><a href="{{ route('Realizadas.index')}}">Encuestas completadas</a></li>
                @endcannot
                @can('es_admin', App\User::class)
                <li><a href="{{ route('Cursos.index')}}">Cursos</a></li>
                <li><a href="{{ route('Docentes.index')}}">Docentes</a></li>
                <li><a href="{{ route('Encuestas.index')}}">Encuestas</a></li>
                <li><a href="{{ route('Users.index')}}">Usuarios</a></li>
                @endcan
                <li><a href="{{ route('Users.edit', Auth::user() )}}">Mis datos</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                        {{ Auth::user()->name1 }} <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            Salir
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</div>
</nav>
