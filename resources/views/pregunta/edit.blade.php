@extends('layouts.app')
@section('title', 'Editar una pregunta')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel-default">
					<h2>Edite la pregunta</h2>
					<?php 
						 //var_dump($pregunta->encuesta()->get()[0]->id);
						 //var_dump($encuesta->id);
					?>
				</div>
				<div class="panel-body">
					@if(Session::has('message'))
                        <div class="alert alert-success success-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <!-- <i class="glyphicon glyphicon-success"></i> -->
                            {{ Session::get('message') }}
                            <!-- {{ Session::forget('message') }} -->
                        </div>
                    @endif
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