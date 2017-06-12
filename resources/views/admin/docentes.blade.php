@extends('layouts.app')
@section('title', 'Docentes')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">

              <h1>{{ $h1 }}</h1>

                </div>
                <div class="panel-body">
                @include('admin.toolbar')
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>eMail</th>
                                    <th>C.I.</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Cursos</th>
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
                                            {{ $docente->cursos()->count() }}
                                        </a>
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
