@extends('layouts.app')
@section('title', 'Encuestas realizadas por materia')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel-default">
				<div class="panel-heading">
					<h1>Materias encuestadas</h1>
									<?php 
										//dd($r[0]->id);
									?>
				</div>
				<div class="panel-body">
					@include('layouts.flashes')
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Id</th>
									<th>Materia</th>
									<th>Profesor</th>
									<th>Cantidad de encuestados</th>
									<th></th>
								</tr>
							</thead>
							@foreach ($realizadasPorMateria as $key => $materias)
								<tbody>
									<tr>
									@php $mates = $materias->groupBy('docente_id')@endphp
										<td>{{ $materias->first->get()->id }}</td>
								@foreach ( $mates as $key => $profes)
										<td>{{ $profes[0]->nombre }}</td>
										<td>{{ $profes[0]->nombredocente }} {{ $profes[0]->apellido }}</td>
										<td>{{ $profes->count() }}</td>
										<td>
										<?php //dd($mates) ?>
											{{ Form::open(['method' => 'GET', 'route' => ['Realizada.quienes', $profes[0]->encuesta_id]]) }}
	                                        {{ Form::hidden('idEncuesta', $profes[0]->encuesta_id) }}
	                                        {{ Form::hidden('idCurso', $profes[0]->curso_id) }}
	                                        {{ Form::hidden('idDocente', $profes[0]->docente_id) }}
	                                        {{ Form::submit('Ver quienes han contestado', ['class' => 'btn btn-xs btn-primary']) }}
	                                        {{Form::close()}}
	                                    </td>
									</tr>
								</tbody>
								@endforeach
							@endforeach
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>					
@endsection