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
	                <ul class="nav nav-tabs">
		                <li>
		                	<a href="/Docentes/estadisticas/{{$docente->id}}/graficas">
		                	Gráficas</a>
		                </li>
		                <li class="active">
		                	<a href="/Docentes/estadisticas/{{$docente->id}}/exportar">
		                	Exportar</a>
		                </li>
		                <li><a href="#">Enviar</a></li>
	                </ul>
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
							    <div id="chart_div_{{$encuesta->id}}{{$curso->id}}"></div>
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
@endsection
