@extends('layouts.error')

@section('title', '403 - Prohibido')

@section('content')
<div class="error-content__messages">

	<h1 class="error-content__heading error_icono">
		<span class="glyphicon glyphicon-ban-circle"></span>
	</h1>

	<h1 class="error_titulo">
		Error <span class="error_numero">#403</span>
	</h1>

	<center class="error-content__text error_explicacion">
		No tienes permisos suficientes
	</center>

</div>
@endsection
