@extends('layouts.app')
@section('title', 'Editar una pregunta')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel-default">
				<h2>Editar la pregunta</h2>
			</div>
			<div class="panel-body">
				@include('layouts.flashes')
				<form class="form-horizontal" action="{{ route('Encuestas.Preguntas.update',[$encuesta->id, $pregunta->id] ) }}" method="POST" accept-charset="utf-8">
					<input type="hidden" name="_method" value="PUT">
					{{ csrf_field() }}
					<div class="form-group">
						<div class="col-md-12">
							<label type="text" name="enunciado">Edite la pregunta</label>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<input class="form-control" id="enunciado" name="enunciado" value="{{ $pregunta->enunciado }}" autofocus required></input>
								@if ($errors->has('enunciado'))
								<span class="help-block">
									<strong>{{ $errors->first('enunciado') }}</strong>	
								</span>
								@endif
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12 text-center">
							<button type="submit" class="btn btn-info btn-xs">Aceptar</button>
						</div>
					</div>					
				</form>
			</div>
		</div>
	</div>
</div>			
@endsection