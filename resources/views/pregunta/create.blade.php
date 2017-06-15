@extends('layouts.app')
@section('title','Agregar pregunta a una encuesta')
@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel-default">
					<div class="panel-heading">
						<h2>Agregar un pregunta a la encuesta: {{$encuesta->asunto}} : {{$encuesta->id}}</h2>
					</div>
					<div class="panel-body">
						@include('layouts.flashes')
						<h3>Preguntas: </h3>
						<!-- //////////////////////////////////////////////////////// -->
							
						<table class="table table-bordered table-striped table-hover category-table" data-toggle="dataTable" data-form="deleteForm">
							<thead>
								<tr>
									<th>Num:</th>
									<th>Descripcion</th>
									<th>Editar</th>
									<th>borrar</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($preguntas as $key => $pregunta)
								<tr>
									<td>{{ $loop->iteration }}</td>
									<td>{{ $pregunta->enunciado }}</td>
	                                <td>
	                                	<div>
	                                		<a class="btn btn-warning btn-xs" href="{{ route('Encuestas.Preguntas.edit', [$encuesta->id , $pregunta->id]) }}">Editar</a>
	                                	</div>
	                                </td>
	                                <td>
	                                	
                    					<form class="form-inline form-delete" method="POST" action="{{ route('Encuestas.Preguntas.destroy', [$encuesta->id, $pregunta->id]) }}">
                    						<input name="_method" type="hidden" value="DELETE">
                    						{{ csrf_field() }}
                    						<button name="confirmarBorrar" type="submit" class="btn btn-danger btn-xs delete borrado_confirm">Borrar</button>
                    					</form>
	                                </td>

								</tr>
								@endforeach
							</tbody>
						</table>

						

							<form id="formAltaPregunta" class="form-horizontal" role="form" action="{{ route('Encuestas.Preguntas.store', $encuesta->id) }}" method="POST">
								{{ csrf_field() }}
								<div class="form-group text-center">
		                                <div class="col-md-12">
		                                    <label type="text" name="pregunta" for="pregunta">Ingrese una pregunta para la encuesta</label>
		                                </div>
		                        </div>
		                        <div class="form-group">
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" id="enunciado" name="enunciado" placeholder="¿Que pregunta desea formular?" value="{{ old('enunciado') }}" required autofocus>
		                                </div>
		                                @if ($errors->has('enunciado'))
											<span class="help-block">
												<strong>{{ $errors->first('enunciado') }}</strong>
											</span>
		                                @endif
		                        </div> 
		                        <div class="form-group">
		                        	<div class="col-md-12 text-center">
		                        		<button class="btn btn-info btn-xs" type="submit">Agregar Pregunta</button>
		                        	</div>
		                        </div>
							</form>
							
					</div>
				</div>
			</div>
		</div>				
	</div>

<div class="modalmio">
    <div class="overlay cerrar"></div>

    <div class="ventana">
        <a href="#" class="boton-cerrar cerrarModal">x</a>
        
        <div class="cuerpo text-justify">
			¿Esta seguro que desea realizar esta accion?
        </div>
        <div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <a class="btn btn-info" href="/Docentes/create">Crear nuevo docente</a>
                </div>
                <div class="col-md-6  text-right">
                    <a href="#" class="btn btn-success cerrarModal">Cancelar</a>        
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	let borrado					= document.getElementsByClassName('borrado_confirm');
	let ventana_confirmacion 	= document.getElementsByClassName('modalmio')[0];
	let boton_cerrar			= document.getElementsByClassName('cerrarModal');

		for (let i = 0, l = boton_cerrar.length; i < l; i++)
	{
		boton_cerrar[i].addEventListener('click', function (evt)
		{
			ventana.classList.remove('activo');
		})
	}

	for (let i = 0, l = borrado.length; i < l; i++){
		borrado[i].addEventListener('click', function(evt){
			//alert("esto seria un modal");
			evt.preventDefault();
			ventana_confirmacion.classList.add('activo');
		});
	}
</script>			
@endsection