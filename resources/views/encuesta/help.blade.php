@extends('layouts.app')
@section('title', 'Help - Editar una encuesta')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading"><h1>Help - Editar la encuesta</h1></div>
				<div class="panel-body">
					<?php
					dd($pregunta);
					?>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection