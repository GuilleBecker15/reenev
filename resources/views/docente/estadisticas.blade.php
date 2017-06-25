@extends('layouts.app')
@section('title', 'Ver encuesta')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h1>
	                	Informe estadistico para
	                	<a href="">
							{{$docente->nombre}} {{$docente->apellido}}
	                	</a>
                	</h1>
                </div>
                <div class="panel-body">
						@foreach ($encuestas as $encuesta) 
				        	<h4>Encuesta <a href="">{{$encuesta->asunto}}</a></h4>
				        	<ul id="chartparent">
				        	@foreach ($cursos as $curso) 
								<li>para el curso <a href="">{{$curso->nombre}}</a></li>
						        @include('docente.grafica')
						        <div id="chart_div_{{$encuesta->id}}{{$curso->id}}"></div>
				        	@endforeach
				        	</ul>
				        @endforeach
	                </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
