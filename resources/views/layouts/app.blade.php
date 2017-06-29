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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->
    <link href="{{ asset('/bootstrap-3.3.7-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <link href="{{ asset('/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
    <style>
        .slow .toggle-group { transition: left 1s; -webkit-transition: left 1s; }
        .fast .toggle-group { transition: left 0.1s; -webkit-transition: left 0.1s; }
        .quick .toggle-group { transition: none; -webkit-transition: none; }
    </style>
</head>
<body>
    <div id="app" class="app">
        @include('layouts.menu')
        @yield('content')
        @include('layouts.modalconfirmacion')
    </div>
    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}"></script> -->
    <script src="{{ asset('/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('/js/wait.js') }}"></script>
    <script src="{{ asset('/bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
    <script src="{{ asset('/js/funciones.js') }}"></script>
    
</body>
</html>