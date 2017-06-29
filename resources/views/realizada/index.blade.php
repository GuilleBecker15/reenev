@extends('layouts.app')
@section('title', 'Encuestas')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Encuestas completadas</h1>
                    @include('layouts.flashes')
                </div>
                <div class="panel-body">
				<ul class="nav nav-tabs">
				  <li><a href="{{ route('Encuestas.index')}}">Disponibles</a></li>
				  <li class="active" ><a href="{{ route('Realizadas.index')}}">Completadas</a></li>
				  <li><a href="{{ route('Realizada.todos')}}">Participantes</a></li>
				</ul>
				<br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Asunto</th>
                                    <th>Finaliza</th>
                                    <th>Encuestados</th>
                                </tr>
                            </thead>
                            @foreach ($realizadas as $key => $r)
                            <tbody>
                                <tr>
                                    <td>{{ $r->id }}</td>
                                    <td>{{ $r->asunto }}</td>
                                    <td>{{ $r->vence }}</td>
                                    <td>
                                    {{ $r->realizadas->groupBy('user_id')->count() }}
                                     alumnos</td>
                                    <td>
                                    	<a href="{{ route('Realizada.show.materia', $r->id) }}"
                                    	class="btn btn-xs btn-default"> Cursos afectados</a>
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