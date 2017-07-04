@extends('layouts.app')
@section('title', 'Completar una encuesta')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading"><h1>Completar la encuesta</h1></div>
				<div class="panel-body">
					@include('layouts.flashes')
					<form onsubmit="return validarCampos();" class="form-horizontal" role="form" method="POST" action="{{ url('Realizadas/continuar') }}">
						{{ csrf_field() }}
						<div class="form-group">
							<label class="col-md-4 control-label">Encuesta</label>
							<div class="col-md-6">
								<select id="encuesta_id" name="encuesta_id" type="text" class="form-control">
									@foreach ($encuestas as $key => $e)
									<option value="{{ $e->id }}">
										{{ $e->id }} - {{ $e->asunto }}
									</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Docente</label>
							<div class="col-md-6">
								<select id="docente_id" name="docente_id" type="text" class="form-control">
									@foreach ($docentes as $key => $d)
									<option value="{{ $d->id }}">
										{{ $d->id }} - {{ $d->nombre }} {{ $d->apellido }}
									</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="form-group">
							<label class="col-md-4 control-label">Curso</label>
							<div class="col-md-6">
								<select id="curso_id" name="curso_id" type="text" class="form-control">
									@foreach ($cursos as $key => $c)
									<option value="{{ $c->id }}">
										{{ $c->id }} - {{ $c->nombre }}
									</option>
									@endforeach
								</select>
							</div>
						</div>
						@if ($encuestas->isNotEmpty() && $docentes->isNotEmpty() && $cursos->isNotEmpty())
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									Continuar
								</button>
							</div>
						</div>
						@endif
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection