    <!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
     <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->

    
    <script>
        window.Reenev = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
    <style>

        html, body {
            font-family: 'Raleway', sans-serif;
            margin: 0;
            height: 100%;
        }

        .full-height {
            height: 50vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 180px;
            color: dodgerblue;
        }

        .links > a {
            color: rgb(0,0,64);
            padding: 0 25px;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

    </style>

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
                        <a class="navbar-brand" style="color: dodgerblue;" href="{{ url('/') }}">{{ config('app.name', 'Reenev') }}</a>
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
                            <li><a href="{{ url('/home') }}">Realizar encuesta</a></li>
                            @endcannot

                            @can('accion', App\Modelo::class)
                                <li><a href="{{ url('/encuestas') }}">Encuestas</a></li>
                                <li><a href="{{ url('/docentes') }}">Docentes</a></li>
                                <li><a href="{{ url('/cursos') }}">Cursos</a></li>
                            @endcan

                            <!--<li><a href="{{ url('/home') }}"><strong>Perfil</strong></a></li>-->


                            <li><a href="{{ route('Users.show', Auth::user() )}}">Perfil</a></li>

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



</body>
    <script src="{{ asset('js/funciones.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>

</html>