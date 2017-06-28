@extends('layouts.app')
@section('title', 'Ver una encuesta')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Ver la encuesta</h1></div>
                <div class="panel-body">
                    @include('layouts.flashes')
                    <table class="table">
                        <thead>
                            <caption>Datos de la encuesta</caption>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Asunto:</strong></td>
                                <td>{{ $encuesta->asunto }}</td>
                            </tr>
                            <tr>
                                <td><strong>Descripcion:</strong></td>
                                <td>{{ $encuesta->descripcion }}</td>
                            </tr>
                            <tr>
                                <td><strong>Inicio:</strong></td>
                                <td>{{ $encuesta->inicio }}</td>
                            </tr>
                            <tr>
                                <td><strong>Vence:</strong></td>
                                <td>{{ $encuesta->vence }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <hr>
                    <table class="table">
                        <caption>Preguntas de la encuesta</caption>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Enunciado</th>
                            </tr>
                        </thead>
                        <tbody>
                        	@if ($preguntas->count()<1)
                        		<tr>
	                        		<td>No hay preguntas,
		                        		<a href="{{ route('Encuestas.Preguntas.create',
		                        		$encuesta->id) }}"> agregar una nueva</a>
	                        		</td>
                        		</tr>
                        	@endif
                            @foreach ($preguntas as $key => $p)
                            <tr>
                                <td>{{$p->id}}</td>
                                <td>{{$p->enunciado}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>@include('encuesta.btn_editarDatos')</td>
                                @if ($preguntas->count()>0)
                                	<td>@include('encuesta.btn_editarPreguntas')</td>
                                @endif
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
