@extends('layouts.app')
@section('title', 'Usuarios')
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
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Fecha de nacimiento</th>
                                    <th>Generación</th>
                                    <th>C.I.</th>
                                    <th>e-Mail</th>
                                    <th>Tipo</th>
                                </tr>
                            </thead>
                            @foreach ($users as $key => $user)
                            <tbody>
                            	@if ($user->deleted_at)
                                	<tr style="color : tomato; text-decoration : line-through;">
                                @endif
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name1 }}</td>
                                    <td>{{ $user->apellido1 }}</td>
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
