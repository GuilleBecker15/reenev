@extends('layouts.app')

@section('title', 'Listado de usuarios')

@section('content')
@if (session('status') == 'ok')
<div class="alert alert-success">
    Perfil modificado con exito!
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel-haeding"><h1>Usuarios del Sistema</h1></div>
            <div class="panel-body">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Primer nombre</th>
                            <th>Segundo nombre</th>
                            <th>Primer apellido</th>
                            <th>Segundo apellido</th>
                            <th>Fecha de Nacimiento</th>
                            <th>generacion</th>
                            <th>Cedula</th>
                            <th>Correo</th>
                        </tr>
                    </thead>
                    @foreach ($users as $key => $user)
                    <tbody>
                        <tr>
                            <td>{{ $user->name1 }}</td>
                            <td>{{ $user->name2 }}</td>
                            <td>{{ $user->apellido1 }}</td>
                            <td>{{ $user->apellido2 }}</td>
                            <td>{{ $user->nacimiento }}</td>
                            <td>{{ $user->generacion }}</td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a class="btn btn-success" href="{{ route('Users.edit', $user->id) }}" role="button">Modificar</a>
                            </td>
                            <td>
                                <!-- <form action="" method="POST">
                                <input name="_method" type="hidden" value="DELETE">
                                <div>
                                <button type="submit" class="btn btn-warning">Borrar</button>
                            </div>
                        </form> -->
                        {{ Form::open(['method' => 'DELETE', 'route' => ['Users.destroy', $user->id]]) }}
                        {{ Form::hidden('id', $user->id) }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                        {{ Form::close() }}
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</div>

</div>

</div>

@endsection
