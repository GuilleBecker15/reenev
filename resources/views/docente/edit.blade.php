@extends('layouts.app')
@section('title', 'Editar un docente')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading"><h1>Editar el docente</h1></div>
				<div class="panel-body">
					@include('layouts.flashes')
					<form onsubmit="return validarCampos();" class="form-horizontal" role="form" method="POST" action="{{ route('Docentes.update', $docente->id) }}">
						{{ csrf_field() }}
						<input name="_method" type="hidden" value="PUT">
						<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
							<label for="email" class="col-md-4 control-label">Correo</label>
							<div class="col-md-6">
								<input id="email" type="email" class="form-control" name="email" value="{{ $docente->email }}" required autofocus>
								@if ($errors->has('email'))
								<span class="help-block">
									<strong>{{ $errors->first('email') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('ci') ? ' has-error' : '' }}">
							<label for="ci" class="col-md-4 control-label">Cedula</label>
							<div class="col-md-6">
								<input id="ci" type="cedula" class="form-control" name="ci" value="{{ $docente->ci }}" required>
								@if ($errors->has('ci'))
								<span class="help-block">
									<strong>{{ $errors->first('ci') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
							<label for="nombre" class="col-md-4 control-label">Nombre</label>
							<div class="col-md-6">
								<input id="nombre" type="text" class="form-control" name="nombre" value="{{ $docente->nombre }}" required>
								@if ($errors->has('nombre'))
								<span class="help-block">
									<strong>{{ $errors->first('nombre') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group{{ $errors->has('apellido') ? ' has-error' : '' }}">
							<label for="apellido" class="col-md-4 control-label">Apellido</label>
							<div class="col-md-6">
								<input id="apellido" type="text" class="form-control" name="apellido" value="{{ $docente->apellido }}" required>
								@if ($errors->has('apellido'))
								<span class="help-block">
									<strong>{{ $errors->first('apellido') }}</strong>
								</span>
								@endif
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<a class="btn btn-default" href="{{ route('Docentes.index') }}">
									Volver</a>
								<button type="submit" class="btn btn-primary">
									Modificar
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection