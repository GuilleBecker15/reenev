@extends('layouts.app')
@section('title','Agregar pregunta a una encuesta')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel-default">
					<div class="panel-heading">
						<h2>Agregar un pregunta a la encuesta: {{$encuesta->asunto}} : {{$encuesta->id}}</h2>
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
	                    @if(Session::has('error'))
							<div class="alert alert-danger danger-dismissable">
								<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
								{{ Session::get('error') }}
							</div>

	                    @endif
						<h3>Preguntas: </h3>
						<div class="">
								@foreach ($preguntas as $key => $pregunta)

								<div class="form-group">
	                                <div class="col-md-12 hidden-xs form-group">
	                                    <label type="text" name="pregunta" form="pregunta">{{ $loop->iteration }} : {{ $pregunta->enunciado }}  :  {{ $pregunta->encuesta()->get()[0]->id }}</label>
	                                </div>
	                                <div>
	                                	<a class="btn btn-warning btn-xs" href="{{ route('Encuestas.Preguntas.edit', [$encuesta->id , $pregunta->id]) }}">Editar</a>
	                                </div>
	                                <div>
	                                	<!-- <a class="btn btn-danger btn-xs" href="{{ route('Encuestas.Preguntas.destroy', [$encuesta->id , $pregunta->id]) }}">Borrar</a> -->
	                                	<form action="{{ route('Encuestas.Preguntas.destroy', [$encuesta->id,$pregunta->id]) }}" method="POST">
										    {{ method_field('DELETE') }}
										    {{ csrf_field() }}
										    <button class="btn btn-danger btn-xs" >Borrar</button>
										</form>
	                                </div>
			                    </div>		                            					
								@endforeach
						</div>

							<form id="formAltaPregunta" class="form-horizontal" role="form" action="{{ route('Encuestas.Preguntas.store', $encuesta->id) }}" method="POST">
								{{ csrf_field() }}
								<div class="form-group text-center">
		                                <div class="col-md-12">
		                                    <label type="text" name="pregunta" for="pregunta">Ingrese una pregunta para la encuensta</label>
		                                </div>
		                        </div>
		                        <div class="form-group">
		                                <div class="col-md-12">
		                                    <input type="text" class="form-control" id="enunciado" name="enunciado" placeholder="¿Que pregunta desea formular?" value="{{ old('enunciado') }}" required>
		                                </div>
		                                @if ($errors->has('enunciado'))
											<span class="help-block">
												<strong>{{ $errors->first('enunciado') }}</strong>
											</span>
		                                @endif
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