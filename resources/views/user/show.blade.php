@extends('layouts.app')
@section('title', 'Perfil del usuario')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Informacion del usuario</h1></div>
                <div class="panel-body">
                <h3>
                    @if($user->estaBorrado)
                        <span class="glyphicon glyphicon-remove"></span>
                        {{$user->tipo($user->esAdmin)}} eliminado
                    @else
                        <span class="glyphicon glyphicon-ok"></span>
                        {{$user->tipo($user->esAdmin)}}
                    @endif
                </h3>
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
                            <td>Correo electronico:</td>
                            <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                        </tr>
                        <tr class="col-md-12 visible-xs">
                            <td><span class="glyphicon glyphicon-asterisk"></span></td>
                            <td>@include('user.btn_hacerAdmin')</td>
                        </tr>
                        <tr class="col-md-12 visible-xs">
                            <td><span class="glyphicon glyphicon-asterisk"></span></td>
                            <td>@include('user.btn_borrar')</td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-md-12 hidden-xs">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>@include('user.btn_hacerAdmin')</td>
                                <td>@include('user.btn_borrar')</td>
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
