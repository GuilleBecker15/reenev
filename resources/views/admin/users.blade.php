@extends('layouts.app')
@section('title', 'Usuarios')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Usuarios</h1></div>
                <div class="panel-body">
                @include('admin.toolbar')
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Primer nombre</th>
                                    <th>Segundo nombre</th>
                                    <th>Primer apellido</th>
                                    <th>Segundo apellido</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Generacion</th>
                                    <th>C.I.</th>
                                    <th>eMail</th>
                                    <th>Tipo</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            @foreach ($users as $key => $user)
                            <tbody>
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name1 }}</td>
                                    <td>{{ $user->name2 }}</td>
                                    <td>{{ $user->apellido1 }}</td>
                                    <td>{{ $user->apellido2 }}</td>
                                    <td>{{ $user->uyNacimiento($user->nacimiento) }}</td>
                                    <td>{{ $user->generacion }}</td>
                                    <td>{{ $user->ci }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->tipo($user->esAdmin) }}</td>
                                    <td>
                                        {{ Form::open(['method' => 'GET', 'route' => ['Users.show', $user->id]]) }}
                                        {{ Form::hidden('id', $user->id) }}
                                        {{ Form::submit('Ver', ['class' => 'btn btn-xs btn-info']) }}
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
