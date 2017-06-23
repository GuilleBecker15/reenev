@extends('layouts.app')
@section('title','Estudiantes que han completado las encuestas')
@section('content')
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel-default">
					<div class="panel-heading"><h1>Alumnos que han completado la encuesta</h1></div>
					<div class="panel-body">
						@include('layouts.flashes')

							<div class="table-responsive">
								<table class="table">
									<thead>
										<tr >
											<th>Fecha realizada</th>
											<th>Estudiante</th>
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
										<?php 
										// dd($estudiante);
										?>
											<td>{{ $estudiante->cuando }}</td>
											<td>{{ $estudiante->name1 }} {{ $estudiante->apellido1 }}</td>
											<td>{{ $estudiante->nocorresponde }}</td>
											<td>{{ $estudiante->muymal }}</td>
											<td>{{ $estudiante->mal }}</td>
											<td>{{ $estudiante->normal }}</td>
											<td>{{ $estudiante->bien }}</td>
											<td>{{ $estudiante->muybien }}</td>
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