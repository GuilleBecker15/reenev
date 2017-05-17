@extends('layouts.error')

@section('title', '404 - No encontrado')

@section('content')
<div class="error-content__messages">

	<h1 class="error-content__heading error_icono">
		<span class="glyphicon glyphicon-remove-circle"></span>
	</h1>

	<h1 class="error_titulo">
		Error <span class="error_numero">#404</span>
	</h1>

	<center class="error-content__text error_explicacion">
		El recurso no se pudo encontrar
	</center>

</div>
@endsection
