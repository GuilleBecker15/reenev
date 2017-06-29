@extends('layouts.app')
@section('title', 'Docentes')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>{{ $h1 }}</h1>
                    @include('layouts.flashes')
                </div>
                <div class="panel-body">
                @include('admin.toolbar')
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>e-Mail</th>
                                    <th>C.I.</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Cursos que dicta</th>
                                </tr>
                            </thead>
                            @foreach ($docentes as $key => $docente)
                            <tbody>
                                <tr>
                                    <td>{{ $docente->id }}</td>
                                    <td>{{ $docente->email }}</td>
                                    <td>{{ $docente->ci }}</td>
                                    <td>{{ $docente->nombre }}</td>
                                    <td>{{ $docente->apellido }}</td>
                                    <td>
                                        <a href="/Cursos/docente/{{ $docente->id }}">
                                    	Un total de: {{ $docente->cursos()->count() }}
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-default btn-xs"
                                        href="Docentes/graficas/{{$docente->id}}">
                                    	Estadísticas
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-info btn-xs"
                                        href="{{ route('Docentes.show', $docente->id) }}">
                                    	Ver
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-xs" href="/Docentes/{{ $docente->id }}/edit">Editar</a>
                                    </td>
                                    <td>
                                        <form id="{{ $docente->id }}.formulario" class="form-inline form-delete" method="POST" action="{{ route('Docentes.destroy', $docente->id) }}">
                                        <input name="_method" type="hidden" value="DELETE">
                                        {{ csrf_field() }}
                                        <button id="{{ $docente->id }}.docente" type="submit" class="btn btn-danger btn-xs borrado_confirm">Borrar</button>
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
@endsection
