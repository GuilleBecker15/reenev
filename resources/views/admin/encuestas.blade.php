@extends('layouts.app')
@section('title', 'Encuestas')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>{{ $h1 }}</h1>
                </div>
                <div class="panel-body">
				<ul class="nav nav-tabs">
				  <li class="active" ><a href="{{ route('Encuestas.index')}}">Disponibles</a></li>
				  <li><a href="{{ route('Realizadas.index')}}">Completadas</a></li>
				  <li><a href="{{ route('Realizada.todos')}}">Participantes</a></li>
				</ul>
				<br>
                @include('admin.toolbar')
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Inicia</th>
                                    <th>Finaliza</th>
                                    <th>Asunto</th>
                                    <th>Descripcion</th>
                                </tr>
                            </thead>
                            @foreach ($encuestas as $key => $encuesta)
                            <tbody>
                                <tr>
                                    <td>{{ $encuesta->id }}</td>
                                    <td>{{ $encuesta->uyInicioVence($encuesta->inicio) }}</td>
                                    <td>{{ $encuesta->uyInicioVence($encuesta->vence) }}</td>
                                    <td>{{ $encuesta->asunto }}</td>
                                    <td>{{ $encuesta->descripcion }}</td>
                                    <td> <div>
                                      {{ Form::open(['method' => 'GET', 'route' => ['Encuestas.show', $encuesta->id]]) }}
                                        {{ Form::hidden('id', $encuesta->id) }}
                                        {{ Form::submit('Ver', ['class' => 'btn btn-xs btn-info']) }}
                                        {{Form::close()}}
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                        {{ Form::open(['method' => 'DELETE', 'route' => ['Encuestas.destroy', $encuesta->id]]) }}
                                        {{ Form::hidden('id', $encuesta->id) }}
                                        {{ Form::submit('Borrar', ['class' => 'btn-xs btn btn-danger borrado_confirm']) }}
                                        {{Form::close()}}
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
