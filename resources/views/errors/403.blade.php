@extends('layouts.error')
@section('title', '403 - Sin permisos')
@section('content')
<h1 class="error_titulo">
	Error <span class="error_numero">#403</span>
</h1>
<p class="error_explicacion">
	<i class="fa fa-lock" aria-hidden="true"></i>
	No se te permite realizar tal acción
</p>
@endsection
