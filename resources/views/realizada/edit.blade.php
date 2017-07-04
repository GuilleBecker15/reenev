@extends('layouts.app')
@section('title', 'Editar una encuesta')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h1>Editar la encuesta</h1></div>
				<div class="panel-body">
					@include('layouts.flashes')
					<form onsubmit="return validarCampos();" class="form-horizontal" role="form" method="POST" action="{{ route('Realizadas.update', $realizada->id) }}">
						{{ method_field('PUT') }}
						{{ csrf_field() }}
						<?php
							$hoy = new DateTime(date('Y-m-d'));
							$vence = new DateTime($encuesta->vence);
							$intervalo = $hoy->diff($vence);
						?>
						@include('realizada.shared')
						@foreach ($preguntas as $key => $p)
						<?php
							$respuestas = $p->respuestas()
							->where('realizada_id', $realizada->id);
							$r = null;
							if ($respuestas) {
								$r = $respuestas->first();
							}
							$_0 = "";
							$_1 = "";
							$_2 = "";
							$_3 = "";
							$_4 = "";
							$_5 = "";
							if ($r->calificacion == 0) $_0 = "checked";
							if ($r->calificacion == 1) $_1 = "checked";
							if ($r->calificacion == 2) $_2 = "checked";
							if ($r->calificacion == 3) $_3 = "checked";
							if ($r->calificacion == 4) $_4 = "checked";
							if ($r->calificacion == 5) $_5 = "checked";
						?>
						<div class="form-group">
							<label type="text" class="col-md-6 control-label">{{$p->enunciado}}</label>
							<div class="col-md-6">
								<label class="radio-inline">
									<input {{ $_0 }} type="radio" name="p{{$p->id}}" value="0">No corresponde
								</label>
								<label class="radio-inline">
									<input {{ $_1 }} type="radio" name="p{{$p->id}}" value="1">Muy mal
								</label>
								<label class="radio-inline">
									<input {{ $_2 }} type="radio" name="p{{$p->id}}" value="2">Mal
								</label>
								<label class="radio-inline">
									<input {{ $_3 }} type="radio" name="p{{$p->id}}" value="3">Normal
								</label>
								<label class="radio-inline">
									<input {{ $_4 }} type="radio" name="p{{$p->id}}" value="4">Bien
								</label>
								<label class="radio-inline">
									<input {{ $_5 }} type="radio" name="p{{$p->id}}" value="5">Muy bien
								</label>
							</div>
						</div>
						@endforeach
						<hr>
						<div class="btn-group">
							<a href="{{ url('Realizadas/create') }}" class="btn btn-default">Volver</a>
						</div>
						@if ($hoy<$vence)
						<div class="btn-group">
							<button type="submit" class="btn btn-primary">Enviar</button>
						</div>
						@endif
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection