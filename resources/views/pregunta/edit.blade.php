@extends('layouts.app')
@section('title', 'Editar una pregunta')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Editar la pregunta</h1>
				</div>
				<div class="panel-body">
					@include('layouts.flashes')
					<form class="form-horizontal" role="form" action="{{ route('Encuestas.Preguntas.update',[$encuesta->id, $pregunta->id] ) }}" method="POST">
						<input type="hidden" name="_method" value="PUT">
						{{ csrf_field() }}
						<div class="form-group{{ $errors->has('enunciado') ? ' has-error' : '' }}">
							<div class="col-md-12">
								<p><i>Pregunta para la encuesta '{{$encuesta->asunto}}'</i></p>
								<input id="enunciado" type="text" class="form-control" name="enunciado" value="{{ $pregunta->enunciado }}" required autofocus>
								@if ($errors->has('enunciado'))
								<span class="help-block">
									<strong>{{ $errors->first('enunciado') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12 text-center">
								<a class="btn btn-default" href="/Encuestas/{{$encuesta->id}}/Preguntas/create">
									Volver</a>
								<button class="btn btn-primary" type="submit">Modificar</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
