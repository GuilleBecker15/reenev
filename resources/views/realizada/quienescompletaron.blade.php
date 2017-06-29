@extends('layouts.app')
@section('title', 'Encuestas')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Alumnos que participaron en la encuesta</h1>
					@include('layouts.flashes')
				</div>
				<div class="panel-body">
					<ul class="nav nav-tabs">
						<li><a href="{{ route('Encuestas.index')}}">Disponibles</a></li>
						<li><a href="{{ route('Realizadas.index')}}">Completadas</a></li>
						<li class="active" ><a href="{{ route('Realizada.todos')}}">Participantes</a></li>
					</ul>
					<br>
					<div class="table-responsive">
						<table class="table">
							<thead>
							<caption>Representa el numero de respuestas para cada puntuacion</caption>
								<tr >
									<th>Completada el</th>
									<th>Por el alumno</th>
									<th>No corresponde</th>
									<th>Muy mal</th>
									<th>Mal</th>
									<th>Normal</th>
									<th>Bien</th>
									<th>Muy bien</th>
								</tr>
							</thead>
							@foreach ($realizadas as $key => $estudiante)
							<tbody>
								<tr>
									<td>{{ $estudiante->cuando }}</td>
									<td>{{ $estudiante->name1 }} {{ $estudiante->apellido1 }}</td>
									<td>{{ $estudiante->nocorresponde }}</td>
									<td>{{ $estudiante->muymal }}</td>
									<td>{{ $estudiante->mal }}</td>
									<td>{{ $estudiante->normal }}</td>
									<td>{{ $estudiante->bien }}</td>
									<td>{{ $estudiante->muybien }}</td>
									<td>
										{{ Form::open(['method' => 'POST', 'route' => ['Realizada.rehacer']]) }}
										{{ Form::hidden('idrealizada', $estudiante->idrealizada) }}
										{{ Form::submit('Borrar', ['class' => 'btn btn-xs btn-danger borrado_confirm']) }}
										{{ Form::close() }}
									</td>
								</tr>
							</tbody>
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@include('layouts.modalconfirmacion')
@endsection
