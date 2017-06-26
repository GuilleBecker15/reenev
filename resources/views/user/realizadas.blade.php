@extends('layouts.app')
@section('title', 'Encuestas completadas por un usuario')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Encuestas completadas por el usuario</h1></div>
                <div class="panel-body">
                @include('layouts.flashes')
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Cuando</th>
                                    <th>Encuesta</th>
                                    <th>Docente</th>
                                    <th>Curso</th>
                                    <th>Semestre</th>
                                </tr>
                            </thead>
                            @foreach ($realizadas as $key => $realizada)
                            <tbody>
                                <tr>
                                    <td>{{ $realizada->id }}</td>
                                    <td>{{ $realizada->uyCuando($realizada->cuando) }}</td>
                                    <td>
                                    <a target="_blank" href="/Realizadas/{{ $realizada->id }}/edit">
                                        {{ $realizada->encuesta->asunto }}
                                    </a>
                                    </td>
                                    <td>
                                    <a target="_blank" href="/Docentes/{{ $realizada->docente->id }}">
                                        {{ $realizada->docente->nombre }}
                                        {{ $realizada->docente->apellido }}
                                    </a>
                                    </td>
                                    <td>{{ $realizada->curso->abreviatura }}</td>
                                    <td>{{ $realizada->curso->semestre }}</td>
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
