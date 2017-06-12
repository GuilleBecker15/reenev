@extends('layouts.app')
@section('title', 'Cursos')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Cursos</h1>
                <?php 
                    //dd($cursos[0]->docentes()->get());
                 ?>
                </div>
                <div class="panel-body">
                @include('admin.toolbar', ['route' => $route])
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Docente</th>
                                    <th>Semestre</th>
                                    <th>Abreviatura</th>
                                </tr>
                            </thead>
                            @foreach ($cursos as $key => $curso)
                            <tbody>
                                <tr>
                                    <td>{{ $curso->id }}</td>
                                    <td>{{ $curso->nombre }}</td>
                                    <td>
                                    {{ $curso->docentes()->get()[0]->nombre }}
                                    {{ $curso->docentes()->get()[0]->apellido }}
                                    </td>
                                    <td>{{ $curso->semestre }}</td>
                                    <td>{{ $curso->abreviatura }}</td>
                                    <td>
                                        {{ Form::open(['method' => 'GET', 'route' => ['Cursos.edit', $curso->id]]) }}
                                        {{ Form::hidden('id', $curso->id) }}
                                        {{ Form::submit('Editar', ['class' => 'btn btn-xs btn-primary']) }}
                                        {{Form::close()}}
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
