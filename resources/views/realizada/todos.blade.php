@extends('layouts.app')
@section('title', 'Encuestas')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Todos los alumnos que completaron encuestas</h1>
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
							<caption>
								***Aparecen en orden decreciente, en funcion del numero de respuestas negativas
							</caption>
							<thead>
								<tr>
									<td colspan="2"><i>Datos de la encuesta</i></td>
									<td colspan="1"><i>Datos del alumno</i></td>
									<td colspan="6"><i>Total de respuestas</i></td>
								</tr>
								<tr >
									<th>ID - Asunto</th>
									<th>Fecha</th>
									<th>Apellido</th>
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
									<td>
									{{ $estudiante['encuesta_id'] }}
									-
									{{ $estudiante['encuesta']['asunto'] }}
									</td>
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
<script>
	let borrado					= document.getElementsByClassName('borrado_confirm');
	let ventana_confirmacion 	= document.getElementsByClassName('modalmio')[0];
	let boton_cerrar			= document.getElementsByClassName('cerrarModal');
	let aceptar				= document.getElementById('aceptarBorrado');
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
