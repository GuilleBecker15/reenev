@extends('layouts.app')
@section('title','Agregar pregunta a una encuesta')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel-default">
					<div class="panel-heading">
						<h2>Agregar un pregunta a la encuesta: {{$encuesta->asunto}}</h2>
					</div>
					<div class="panel-body">
					<h3>Preguntas: </h3>
					<div class="">
							@foreach ($preguntas as $key => $pregunta)
							<div class="form-group">
		                                <div class="col-md-12 hidden-xs form-group">
		                                    <label type="text" name="pregunta" form="pregunta">{{ $pregunta->numero }} : {{ $pregunta->enunciado }}</label>
		                                </div>
		                            </div>		                            					
							@endforeach
					</div>

						<form id="formAltaPregunta" class="form-horizontal" role="form" action="{{ route('Encuestas.Preguntas.store', $encuesta->id) }}" method="POST">
							{{ csrf_field() }}
							<div class="form-group text-center">
	                                <div class="col-md-12">
	                                    <label type="text" name="pregunta" form="pregunta">Ingrese una pregunta para la encuensta</label>
	                                </div>
	                        </div>
	                        <div class="form-group">
	                                <div class="col-md-12">
	                                    <input type="text" class="form-control" id="descPregunta" name="descPregunta" placeholder="¿Que pregunta desea formular?">
	                                </div>
	                        </div> 
	                        <div class="form-group">
	                        	<div class="col-md-12 text-center">
	                        		<button class="btn btn-info btn-xs" type="submit">Agregar Pregunta</button>
	                        	</div>
	                        </div>
						</form>
						<!-- {{ Form::open(['method' => 'POST', 'route' => ['Encuestas.Preguntas.store', $encuesta->id]]) }}
						{{ Form::token() }}
						<div class="form-group text-center">
                                <div class="col-md-12">
									{{ Form::label('pregunta', 'Ingrese una pregunta para la encuesta') }}
                                </div>
                        </div>
                        <div class="form-group">
                                <div class="col-md-12">
									{{ Form::text('pregunta','¿Que pregunta desea realizar?') }}
                                </div>
                        </div> <br><br><br>
                        <div class="form-group">
                        	<div class="col-md-12 text-center">
								{{ Form::submit('Agregar Pregunta', ['class' => 'btn-xs btn btn-info']) }}
                        	</div>
                        </div>
						{{Form::close()}} -->
					</div>
				</div>
			</div>
		</div>				
	</div>
@endsection