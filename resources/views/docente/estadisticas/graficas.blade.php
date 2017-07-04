@extends('layouts.app')
@section('title', 'Graficos estadisticos de un docente')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h1>
	                	Estadísticas del docente
	                	<a href="{{ route('Docentes.show', $docente->id) }}">
							{{$docente->nombre}} {{$docente->apellido}}
	                	</a>
                	</h1>
                </div>
                <div id="chartparent" class="panel-body">
	                @include('layouts.flashes')
					@foreach ($encuestas as $encuesta)
        				@if ($encuesta->preguntas->count()>0)
					       	<h3>
					       		<a href="">
					        		{{$encuesta->asunto}}
					        	</a>
					        </h3>
					       	<p>{{$encuesta->descripcion}}</p>
					       	<p><strong>- A completarse entre el
					       	{{$encuesta->uyInicioVence($encuesta->inicio)}}
					       	y el
					       	{{$encuesta->uyInicioVence($encuesta->vence)}} -
					       	</strong></p>
						    @foreach ($cursos as $curso) 
							    @include('docente.estadisticas.chart_preguntas')
							    <div class="grafica" id="chart_div_{{$encuesta->id}}{{$curso->id}}"></div>
							    <div>
								    <i class="fa fa-paperclip" aria-hidden="true"></i>
								    <a id="mail" onclick="verCcMail({{$curso->id}});" href="#formcopias">Enviar por e-Mail</a>
							    </div>


								<div id="formcopias{{$curso->id}}" class="formcopias">
									

								    <form id="formulario{{$curso->id}}" class="formulario" action="/sendemailprofes/{{$docente->id}}/{{$encuesta->id}}/{{$curso->id}}" method="get">
								    	<label style="text-align: center" class="col-md-12 control-label">Si desea realizar una copia del email ingrese cada una de los destinatarios separados por un espacio</label>
										<input name="mails" type="hidden">
										<div class="input-container">
											<div id="fake-textarea" class="fake-textarea clearfix focus" >
												<div class="tag-input-wrapper">
													<input tabindex="4" type="text" autocomplete="off" class="tag-input">
												</div>
											</div>
										</div>

								    	<div id="btnAceptar">
											<button type="submit" class="btn btn-primary">Aceptar</button>
										</div>
								    </form>


							    </div>


							    <div>
								    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
								    <a target="_blank" href="/Docentes/exportar/{{$docente->id}}/{{$encuesta->id}}/{{$curso->id}}">Exportar a PDF</a>
							    </div>
							    <hr>
						    @endforeach
					    @endif
				    @endforeach
				    <center><p>
				    @if ($encuestas->count()==0)
				    	Este docente aun no ha generado estadísticas
				    @else
				    	Fin de las estadísticas para este docente
				    @endif
				    </p></center>
                </div>
            </div>
        </div>
    </div>
</div>

<link href="{{ asset('css/graficas.css') }}" rel="stylesheet">
<link href="{{ asset('css/tags.css') }}" rel="stylesheet">

<script src="{{ asset('/js/graficas.js') }}"></script>
<script src="{{ asset('/js/tags.js') }}"></script>

@endsection
