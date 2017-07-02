@extends('layouts.app')
@section('title', 'Completar una encuesta')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading"><h1>Completar la encuesta</h1></div>
				<div class="panel-body">
					@include('layouts.flashes')
					<form onsubmit="return validarCampos();" class="form-horizontal" role="form" method="POST" action="{{ route('Realizadas.store') }}">
						{{ csrf_field() }}
						<?php
							$hoy = new DateTime(date('Y-m-d'));
							$vence = new DateTime($encuesta->vence);
							$intervalo = $hoy->diff($vence);
						?>
						@include('realizada.shared')
						@foreach ($preguntas as $key => $p)
						<div class="form-group">
							<div type="text" class="col-md-6 control-label">{{$p->enunciado}}</div>
							<div class="col-md-6">
								<label class="radio-inline">
									<input checked type="radio" name="p{{$p->id}}" value="0">No corresponde
								</label>
								<label class="radio-inline">
									<input type="radio" name="p{{$p->id}}" value="1">Muy mal
								</label>
								<label class="radio-inline">
									<input type="radio" name="p{{$p->id}}" value="2">Mal
								</label>
								<label class="radio-inline">
									<input type="radio" name="p{{$p->id}}" value="3">Normal
								</label>
								<label class="radio-inline">
									<input type="radio" name="p{{$p->id}}" value="4">Bien
								</label>
								<label class="radio-inline">
									<input type="radio" name="p{{$p->id}}" value="5">Muy bien
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