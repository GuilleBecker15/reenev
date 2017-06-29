<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="glyphicon glyphicon-menu-hamburger"></span>
            </button>
            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
            <span class="glyphicon glyphicon-home"></span></a>
        </div>
        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">&nbsp;</ul>
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                <li><a href="{{ route('register') }}">
                <span class="glyphicon glyphicon-new-window"></span>    Registrarse</a></li>
                <li><a href="{{ route('login') }}">
                <span class="glyphicon glyphicon-log-in"></span>    Entrar</a></li>
                @else
                @cannot('es_admin', App\User::class)
                <li><a href="{{ route('Realizadas.create')}}">Completar encuesta</a></li>
                <li><a href="/Users/completadas/{{ Auth::user()->id }}">Encuestas completadas</a></li>
                @endcannot
                @can('es_admin', App\User::class)
                <li><a href="{{ route('Cursos.index')}}">Cursos</a></li>
                <li><a href="{{ route('Docentes.index')}}">Docentes</a></li>
<!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
                <li><a href="{{ route('Encuestas.index')}}">Encuestas</a></li>
                <li><a href="{{ route('Realizadas.index')}}">Realizadas</a></li>
                <li><a href="{{ route('Users.index')}}">Usuarios</a></li>
                <li><a href="{{ route('Realizada.todos')}}">Todos</a></li>
                <li>
                    <a href="/sendemail" onclick="event.preventDefault(); document.getElementById('mail-form').submit();">Mail</a>
                    <form id="mail-form" action="/sendemail" method="get" style="display: none;" accept-charset="utf-8">
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                    {{ csrf_field() }}
                    </form>
                </li>


                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Encuestas <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li>
	                        <a href="{{ route('Encuestas.index') }}">
		                        <i class="fa fa-circle-o" aria-hidden="true"></i>
		                        Disponibles
	                        </a>
                        </li>
                        <li>
	                        <a href="#">
	                        	<i class="fa fa-circle" aria-hidden="true"></i>
	                        	Completadas
	                        </a>
                        </li>                        
                    </ul>
                </li>
                <li><a href="{{ route('Users.index') }}">Usuarios</a></li>
 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                @endcan
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                    <span class="hidden-xs glyphicon glyphicon-off"></span>
                    <span class="visible-xs" style="font-weight: bold;"> {{Auth::user()->name1}} </span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('Users.edit', Auth::user() )}}"><span class="glyphicon glyphicon-edit"></span> Mis datos</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                            <span class="glyphicon glyphicon-log-out"></span> Cerrar sesion</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">{{ csrf_field() }}</form>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
