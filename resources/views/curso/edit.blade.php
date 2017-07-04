@extends('layouts.app')
@section('title', 'Editar un curso')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading"><h1>Editar el curso</h1></div>
				<div class="panel-body">
					@include('layouts.flashes')
					<form onsubmit="return validarCampos();" id="formularioModificacion" class="form-horizontal" role="form" method="POST" action="{{ route('Cursos.update',$curso->id) }}">
						<input name="_method" type="hidden" value="PUT">
						{{ csrf_field() }}
						<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
							<label for="nombre" class="col-md-4 control-label">Nombre</label>
							<div class="col-md-6">
								<input id="nombre" type="text" class="form-control" name="nombre" value="{{ $curso->nombre }}" placeholder="Matematica Discreta y Logica 1" required autofocus>
								@if ($errors->has('nombre'))
								<span class="help-block">
									<strong>{{ $errors->first('nombre') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('abreviatura') ? ' has-error' : '' }}">
							<label for="abreviatura" class="col-md-4 control-label">Abreviatura</label>
							<div class="col-md-6">
								<input id="abreviatura" type="text" class="form-control" name="abreviatura" value="{{ $curso->abreviatura }}" placeholder="MDyL1" required>
								@if ($errors->has('abreviatura'))
								<span class="help-block">
									<strong>{{ $errors->first('abreviatura') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('semestre') ? ' has-error' : '' }}">
							<label for="semestre" class="col-md-4 control-label">Semestre</label>
							<div class="col-md-6">
								<input id="semestre" type="number" class="form-control" name="semestre" value="{{ $curso->semestre }}" min="1" max="6" required>
								@if ($errors->has('semestre'))
								<span class="help-block">
									<strong>{{ $errors->first('semestre') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4 ">
								<a class="btn btn-default" href="{{ route('Cursos.index') }}">
									Volver</a>
									<button id="modificar" type="submit" class="btn btn-primary btn-modificar">
										Modifcar
									</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection