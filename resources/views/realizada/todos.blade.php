@extends('layouts.app')
@section('title','Estudiantes que han completado las encuestas')
@section('content')
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<div class="panel-default">
					<div class="panel-heading"><h1>Todo loa alumnos que han completado la encuesta ordendos por prioridad</h1></div>
					<div class="panel-body">
						@include('layouts.flashes')
						<?php  
						// dd($resultados);
						?>
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
											<th></th>
										</tr>
									</thead>
									@foreach ($resultados as $key => $estudiante)
									<tbody>
										<tr>
										<?php 
										// dd($estudiante);
										?>
											<td>{{ $estudiante['cuando'] }}</td>
											<td>{{ $estudiante['name1'] }} {{ $estudiante['apellido1'] }}</td>
											<td>{{ $estudiante['nocorresponde'] }}</td>
											<td>{{ $estudiante['muymal'] }}</td>
											<td>{{ $estudiante['mal'] }}</td>
											<td>{{ $estudiante['normal'] }}</td>
											<td>{{ $estudiante['bien'] }}</td>
											<td>{{ $estudiante['muybien'] }}</td>
											<td>
												{{ Form::open(['method' => 'POST', 'route' => ['Realizada.rehacer']]) }}
												{{ Form::hidden('idrealizada', $estudiante['id']) }}
		                                        {{ Form::submit('Rehacer encuesta', ['class' => 'btn btn-xs btn-danger borrado_confirm']) }}
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
<script>
	let borrado					= document.getElementsByClassName('borrado_confirm');
	let ventana_confirmacion 	= document.getElementsByClassName('modalmio')[0];
	let boton_cerrar			= document.getElementsByClassName('cerrarModal');
	let aceptar				=document.getElementById('aceptarBorrado');
	let idForm;
	for (let i = 0, l = boton_cerrar.length; i < l; i++){
		boton_cerrar[i].addEventListener('click', function (evt){
			ventana.classList.remove('activo');
		});
	}

	for (let i = 0, l = borrado.length; i < l; i++){
		borrado[i].addEventListener('click', function(evt){
			evt.preventDefault();
			ventana_confirmacion.classList.add('activo');
			idForm = borrado[i].parentElement;									
		});
	}

	aceptar.addEventListener('click',function(evt){
		idForm.submit();
		ventana_confirmacion.classList.remove('activo');
		waitingDialog.show('Por favor espere', {dialogSize: 'sm', progressType: 'success'});
		setTimeout(function () {waitingDialog.hide();}, 15000 );
	});


</script>		
@endsection