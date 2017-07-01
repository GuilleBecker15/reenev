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
	                	<a href="">
							{{$docente->nombre}} {{$docente->apellido}}
	                	</a>
                	</h1>
                </div>
                <div id="chartparent" class="panel-body">
	                <!-- <ul class="nav nav-tabs">
		                <li class="active">
		                	<a href="/Docentes/estadisticas/{{$docente->id}}/graficas">
		                	Gráficas</a>
		                </li>
		                <li>
		                	<a href="/Docentes/estadisticas/{{$docente->id}}/exportar">
		                	Exportar</a>
		                </li>
		                <li><a href="#">Enviar</a></li>
	                </ul> -->
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
									

								    <form id="formulario{{$curso->id}}" class="formulario" action="/prueba/{{$docente->id}}/{{$encuesta->id}}/{{$curso->id}}" method="get">
								    	<label style="text-align: center" class="col-md-12 control-label">Si desea realizar una copia del email ingrese cada una de los destinatarios separados por un espacio</label>
								    	<input class="form-control" id="copias" name="copias" placeholder="ejemplo@ejemplo.com example@example.com">
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

<script src="{{ asset('/js/graficas.js') }}"></script>

@endsection
