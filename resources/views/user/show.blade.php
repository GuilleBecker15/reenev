@extends('layouts.app')

@section('title', 'Perfil del usuario')

@section('content')

<div class="container">

    <div class="row">

        <div class="col-md-6 col-md-offset-3">

            <div class="panel panel-default">

                <div class="panel-heading"><h1>Informacion del usuario</h1></div>

                <div class="panel-body">

                    @if($user->esAdmin)
                    <h2> * Administrador del sistema</h2>
                    @endif

                    @if(!$user->esAdmin)
                    <h2> * Estudiante de la carrera</h2>
                    @endif

                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td>Primer nombre:</td>
                                <td>{{ $user->name1 }}</td>
                            </tr>
                            <tr>
                                <td>Segundo nombre:</td>
                                <td>{{ $user->name2 }}</td>
                            </tr>
                            <td>Primer apellido:</td>
                            <td>{{ $user->apellido1 }}</td>
                        </tr>
                        <tr>
                            <td>Segundo apellido:</td>
                            <td>{{ $user->apellido2 }}</td>
                        </tr>
                        <tr>
                            <td>Fecha de nacimiento:</td>
                            <td>{{ $user->uyNacimiento($user->nacimiento) }}</td>
                        </tr>
                        <tr>
                            <td>Generacion:</td>
                            <td>{{ $user->generacion }}</td>
                        </tr>
                        <tr>
                            <td>Cedula:</td>
                            <td>{{ $user->ci }}</td>
                        </tr>
                        <tr>
                            <td>Correo electronico</td>
                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                        </tr>
                    </tbody>
                </table>
                
                <div class="col-md-3">

                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                {{ Form::open(array('action' => array('UserController@hacerAdmin', $user->id))) }}
                                {{ Form::submit('Hacer admin', ['class' => 'btn btn-warning']) }}
                                {{Form::close()}}
                            </td>
                            <td>
                                {{ Form::open(['method' => 'DELETE', 'route' => ['Users.destroy', $user->id]]) }}
                                {{ Form::hidden('id', $user->id) }}
                                {{ Form::submit('Borrar', ['class' => 'btn btn-danger']) }}
                                {{Form::close()}}
                            </td>
                        </tr>
                    </tbody>
                </table>

                </div>

            </div>

        </div>

    </div>

</div>

</div>

@endsection
