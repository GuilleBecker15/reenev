@extends('layouts.app')

@section('title', 'Encuestas realizadas')

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="panel-dafault">
					<div class="panel-heading">
						<h1>Encuestas en el sistema</h1>
					</div>
					<div class="panel-body">
						<ul class="nav nav-tabs">
						  <li><a href="{{ route('Encuestas.index')}}">Disponibles</a></li>
						  <li class="active" ><a href="{{ route('Realizadas.index')}}">Completadas</a></li>
						  <li><a href="{{ route('Realizada.todos')}}">Participantes</a></li>
						</ul>
						<br>
						@include('layouts.flashes')
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Id</th>
										<th>Asunto</th>
										<th>Inicio</th>
										<th>Vencimiento</th>
										<th>Cantidad que han respondido</th>
									</tr>
								</thead>
								@foreach ($realizadas as $key => $r)
								<tbody>
									<tr>
										<td>{{ $r->id }}</td>
										<td>{{ $r->asunto }}</td>
										<td>{{ $r->inicio }}</td>
										<td>{{ $r->vence }}</td>
										<td>{{ $r->realizadas->groupBy('user_id')->count() }}</td>
										<td><a href="{{ route('Realizada.show.materia', $r->id) }}">Ver por materia</a></td>
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
@endsection