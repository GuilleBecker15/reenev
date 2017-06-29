@extends('layouts.app')
@section('title', 'Agregar preguntas a una encuesta')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Agregar preguntas a la encuesta <a href="">{{$encuesta->id}}</a></h1>
					@include('layouts.flashes')
				</div>
				<div class="panel-body">
					@if ($preguntas->count())
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>ID</th>
									<th>Enunciado</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($preguntas as $key => $pregunta)
								<tr>
									<!-- <td>{{ $loop->iteration }}</td> -->
									<td>{{ $pregunta->id }}</td>
									<td>{{ $pregunta->enunciado }}</td>
									<td>
										<div>
											<a class="btn btn-primary btn-xs" href="{{ route('Encuestas.Preguntas.edit', [$encuesta->id , $pregunta->id]) }}">Editar</a>
										</div>
									</td>
									<td>
										<form id="{{ $pregunta->id }}.formulario" class="form-inline form-delete" method="POST" action="{{ route('Encuestas.Preguntas.destroy', [$encuesta->id, $pregunta->id]) }}">
											<input name="_method" type="hidden" value="DELETE">
											{{ csrf_field() }}
											<button name="confirmarBorrar" type="submit" class="btn btn-danger btn-xs delete borrado_confirm" id = "{{ $pregunta->id }}.boton">Borrar</button>
										</form>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@endif
					<form id="formAltaPregunta" class="form-horizontal" role="form" action="{{ route('Encuestas.Preguntas.store', $encuesta->id) }}" method="POST">
						{{ csrf_field() }}
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
								<button class="btn btn-success" type="submit">Agregar Pregunta</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@include('layouts.modalconfirmacion')
@endsection
