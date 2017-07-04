@extends('layouts.app')
@section('title', 'Encuestas')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>
						Alumnos que participaron en la encuesta
						<a href="{{ route('Encuestas.show', $idEncuesta)}}">{{ $idEncuesta }}</a>
					</h1>
				</div>
				<div class="panel-body">
					@include('layouts.flashes')
					<ul class="nav nav-tabs">
						<li><a href="{{ route('Encuestas.index')}}">Disponibles</a></li>
						<li><a href="{{ route('Realizadas.index')}}">Completadas</a></li>
						<li class="active" ><a href="{{ route('Realizada.todos')}}">Participantes</a></li>
					</ul>
					<br>
					<div class="table-responsive">
						<table class="table">
							<caption>
								Representa el numero de respuestas para cada puntuacion
							</caption>
							<thead>
								<tr>
									<th>Fecha</th>
									<th>Alumno</th>
									<th>N/C</th>
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
									<td>
										{{ $estudiante->name1 }}
										{{ $estudiante->apellido1 }}</a>
									</td>
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
