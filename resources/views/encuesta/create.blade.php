@extends('layouts.app')
@section('title', 'Crear una encuesta')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading"><h1>Crear una encuesta</h1></div>
				<?php 
// use Carbon\Carbon;
// var_dump(Carbon::now()->toDateString());
// $hoy=Carbon::now()->toDateString();
// var_dump(Carbon::createFromDate(2017, 06, 20)->toDateString());
// $otro=Carbon::createFromDate(2017, 06, 20)->toDateString();
// if($hoy<$otro) echo "el mayor";
//     else echo "no es mayor <br> <br> ";
//     if(!isset($e)){
// dd($e);
//     }
				?>
				<div class="panel-body">
					@include('layouts.flashes')
					<form action="{{ route('Encuestas.store') }}" role="form" method="POST" class="form-horizontal" accept-charset="utf-8">
						{{ csrf_field() }}
						<div class="form-group{{ $errors->has('asunto') ? ' has-error' : '' }}">
							<label for="asunto" class="col-md-4 control-label">Asunto</label>
							<div class="col-md-6">
								<input id="asunto" type="text" class="form-control" name="asunto" value="{{ old('asunto') }}" placeholder="Encuesta 2017" required autofocus>
								@if ($errors->has('asunto'))
								<span class="help-block">
									<strong>{{ $errors->first('asunto') }}</strong>
								</span>
								@endif
							</div>
						</div> 
						<div class="form-group{{ $errors->has('descripcion') ? ' has-error' : '' }}">
							<label for="descripcion" class="col-md-4 control-label">Descripción</label>
							<div class="col-md-6">
								<input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion') }}" placeholder="Esta encuesta es para..." required autofocus>
								@if ($errors->has('descripcion'))
								<span class="help-block">
									<strong>{{ $errors->first('descripcion') }}</strong>
								</span>
								@endif
							</div>
						</div>  
						<div class="form-group{{ $errors->has('vence') ? ' has-error' : '' }}">
							<label for="vence" class="col-md-4 control-label">Fecha límite</label>
							<div class="col-md-6">
								<input id="vence" type="fecha" class="form-control" name="vence" value="" placeholder="dd/mm/aaaa" required autofocus>
								<input hidden type="text" id="hidden_vence" name="hidden_vence">
								@if ($errors->has('vence'))
								<span class="help-block">
									<strong>{{ $errors->first('vence') }}</strong>
								</span>
								@endif
							</div>
						</div> 
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button id="btn-guardar" type="submit" class="btn btn-primary">
									Guardar
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