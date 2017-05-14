<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <script> window.Reenev = {!!json_encode(['csrfToken' => csrf_token(),])!!}; </script>

    <!-- Styles -->
<!--     <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 -->    <link href="{{ asset('bootstrap-3.3.7-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">

</head>

<body>

    <div id="app">

        <nav class="navbar navbar-default navbar-static-top">

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

                        @cannot('accion', App\Modelo::class)
                        <li><a href="{{ url('/') }}">Completar encuesta</a></li>
                        <li><a href="{{ url('/') }}">Encuestas completadas</a></li>
                        @endcannot

                        @can('accion', App\Modelo::class)
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

    @yield('content')

</div>

<!-- Scripts -->
<!-- <script src="{{ asset('js/app.js') }}"></script>
 --><script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/funciones.js') }}"></script>

</body>

</html>
