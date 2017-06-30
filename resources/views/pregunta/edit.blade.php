@extends('layouts.app')
@section('title', 'Editar una pregunta')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>Editar la pregunta</h1>
					@include('layouts.flashes')
				</div>
				<div class="panel-body">
				<form class="form-horizontal" role="form" action="{{ route('Encuestas.Preguntas.update',[$encuesta->id, $pregunta->id] ) }}" method="POST">
					<input type="hidden" name="_method" value="PUT">
						{{ csrf_field() }}
						<!-- <div class="form-group">
							<div class="col-md-12">
								<input class="form-control" id="enunciado" name="enunciado" value="{{ $pregunta->enunciado }}" autofocus required></input>
							</div>
							@if ($errors->has('enunciado'))
								<span class="help-block">
									<strong>{{ $errors->first('enunciado') }}</strong>	
								</span>
								@endif
						</div> -->
						<div class="form-group{{ $errors->has('enunciado') ? ' has-error' : '' }}">
							<div class="col-md-12">
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
