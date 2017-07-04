<!-- Este layout esta basado en una pagina de error de cacoo.com -->
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
	<link href="{{ asset('bootstrap-3.3.7-dist/css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ asset('css/estilos.css') }}" rel="stylesheet">
	<link href="{{ asset('/font-awesome-4.7.0/css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body class="error_pagina">
<div>
<p class="error_icono">
	<a href="{{ url('/') }}" data-toggle="tooltip" title="Ir a la pagina principal">
		<i class="fa fa-angle-left" aria-hidden="true"></i> reenev
	</a>
	<i class="fa fa-angle-right" aria-hidden="true"></i>
</p>
@yield('content')
<p class="error_icono">
	<i class="fa fa-angle-left" aria-hidden="true"></i>
	<a href="{{ url('/') }}" data-toggle="tooltip" title="Ir a la pagina principal">
		/ reenev <i class="fa fa-angle-right" aria-hidden="true"></i>
	</a>
</p>
</div>
</body>
</html>
