@extends('layouts.app')
@section('title', 'Encuestas')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Todos los alumnos que completaron encuestas</h1>
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
								***Aparecen en orden decreciente, en funcion del numero de respuestas negativas
							</caption>
							<thead>
								<tr >
									<th>ID</th>
									<th>Encuesta</th>
									<th>Completada</th>
									<th>Por</th>
									<th>N/C</th>
									<th>Muy mal</th>
									<th>Mal</th>
									<th>Normal</th>
									<th>Bien</th>
									<th>Muy bien</th>
								</tr>
							</thead>
							@foreach ($resultados as $key => $estudiante)
							<tbody>
								<tr>
									<td>{{ $estudiante['encuesta_id'] }}</td>
									<td>{{ $estudiante['encuesta']['asunto'] }}</td>
									<td>{{ $estudiante['cuando'] }}</td>
									<td>{{ $estudiante['apellido1'] }}</td>
									<td>{{ $estudiante['nocorresponde'] }}</td>
									<td>{{ $estudiante['muymal'] }}</td>
									<td>{{ $estudiante['mal'] }}</td>
									<td>{{ $estudiante['normal'] }}</td>
									<td>{{ $estudiante['bien'] }}</td>
									<td>{{ $estudiante['muybien'] }}</td>
									<td>
										{{ Form::open(['method' => 'POST', 'route' => ['Realizada.rehacer']]) }}
										{{ Form::hidden('idrealizada', $estudiante['id']) }}
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
