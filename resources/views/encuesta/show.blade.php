@extends('layouts.app')
@section('title', 'Ver encuesta')
@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel-default">
				<div class="panel-heading">
					<h1>Informacion de la encuesta</h1>
				</div>
				<h3 class="col-md-12 text-center">{{ $encuesta->asunto }}</h3>
				<!-- <h3 class="col-md-12 text-center">Algo super extra extremadamente largoooooooooooo</h3> -->
				<div class="panel-body">
					<table class="table table-user-information">
						<thead>
							<tr>
								<th>Descripcion</th>
								<th>Inicia</th>
								<th>Vence</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{ $encuesta->descripcion }}</td>
								<td>{{ $encuesta->inicio }}</td>
								<td>{{ $encuesta->vence }}</td>
							</tr>
						</tbody>
					</table>
					<div class="col-md-12 hidden-xs text-center">
						<table class="table">
							<tbody>
								<tr>
									{{ Form::open(['method' => 'GET', 'route' => ['Encuestas.edit', $encuesta->id]]) }}
									{{ Form::hidden('id', $encuesta->id) }}
									{{ Form::submit('Editar', ['class' => 'btn-xs btn btn-info']) }}
									{{Form::close()}}
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>									
		</div>
	</div>
</div>

@endsection