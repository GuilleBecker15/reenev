@extends('layouts.app')
@section('title', 'Cursos')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	@if (isset($docente))
	                    <h1>
	                    	{{ $h1 }}
	                    	<a href="{{ route('Docentes.show', $docente->id) }}">
	                    	{{$docente->id}}</a>
	                    </h1>
                    @else
                    	<h1>{{ $h1 }}</h1>
                    @endif
                </div>
                <div class="panel-body">
                @include('admin.toolbar', ['route' => $route])
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Docentes asignados</th>
                                    <th>Semestre</th>
                                    <th>Abreviatura</th>
                                </tr>
                            </thead>
                            @foreach ($cursos as $curso)
                            <tbody>
                                <tr>
                                    <td>{{ $curso->id }}</td>
                                    <td>{{ $curso->nombre }}</td>
                                    <td>
                                    <table>
                                    	@if ($curso->docentes->count()==0)
                                    		- Ninguno -
                                    	@endif
                                        @foreach($curso->docentes as $docente)
                                            <tbody>- 
                                                <tr><a href="{{ route('Docentes.show', $docente->id) }}">{{ $docente->nombre }} {{ $docente->apellido }} <br></a></tr>
                                            </tbody>
                                        @endforeach
                                    </table>
                                    </td>
                                    <td>{{ $curso->semestre }}</td>
                                    <td>{{ $curso->abreviatura }}</td>
                                    <td>
                                    	<a href="{{ route('Cursos.show', $curso->id) }}"
                                    	class="btn btn-info btn-xs">Ver</a>
                                    </td>
                                    <td>
                                        {{ Form::open(['method' => 'GET', 'route' => ['Cursos.edit', $curso->id]]) }}
                                        {{ Form::hidden('id', $curso->id) }}
                                        {{ Form::submit('Editar', ['class' => 'btn btn-xs btn-primary']) }}
                                        {{Form::close()}}
                                    </td>
                                    <td>
                                        {{ Form::open(['method' => 'GET', 'route' => ['Cursos.Docente.edit', $curso->id]]) }}
                                        {{ Form::hidden('id', $curso->id) }}
                                        {{ Form::submit('Agregar/quitar docente', ['class' => 'btn btn-xs btn-warning']) }}
                                        {{Form::close()}}
                                    </td>
                                    <td>
                                        <form id="{{ $curso->id }}.formulario" class="form-inline form-delete" method="POST" action="{{ route('Cursos.destroy', $curso->id) }}">
                                        <input name="_method" type="hidden" value="DELETE">
                                        {{ csrf_field() }}
                                        <button id="{{ $curso->id }}.curso" type="submit" class="btn btn-danger btn-xs borrado_confirm">Borrar</button>
                                        </form>
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
</div>
@endsection
