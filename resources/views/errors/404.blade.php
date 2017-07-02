@extends('layouts.error')
@section('title', '404 - No encontrado')
@section('content')
<h1 class="error_titulo">
	Error <span class="error_numero">#404</span>
</h1>
<p class="error_explicacion">
	<i class="fa fa-puzzle-piece" aria-hidden="true"></i>
	Dicho recurso no pudo ser encontrado
</p>
@endsection
