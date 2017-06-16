@extends('layouts.app')
@section('title', 'Perfil del usuario')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Informacion del usuario</h1></div>
                <div class="panel-body">
                <?php 
                // dd($user[0])
                //dd($user[0])
                 ?>
                <h3>
                    @if($user[0]->deleted_at)
                        <span class="glyphicon glyphicon-remove"></span>
                        {{$user[0]->tipo($user[0]->esAdmin)}} eliminado
                    @else
                        <span class="glyphicon glyphicon-ok"></span>
                        {{$user[0]->tipo($user[0]->esAdmin)}}
                    @endif
                </h3>
                @include('layouts.flashes')
                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td>Primer nombre:</td>
                                <td>{{ $user[0]->name1 }}</td>
                            </tr>
                            <tr>
                                <td>Segundo nombre:</td>
                                <td>{{ $user[0]->name2 }}</td>
                            </tr>
                            <td>Primer apellido:</td>
                            <td>{{ $user[0]->apellido1 }}</td>
                        </tr>
                        <tr>
                            <td>Segundo apellido:</td>
                            <td>{{ $user[0]->apellido2 }}</td>
                        </tr>
                        <tr>
                            <td>Fecha de nacimiento:</td>
                            <td>{{ $user[0]->uyNacimiento($user[0]->nacimiento) }}</td>
                        </tr>
                        <tr>
                            <td>Generacion:</td>
                            <td>{{ $user[0]->generacion }}</td>
                        </tr>
                        <tr>
                            <td>Cedula:</td>
                            <td>{{ $user[0]->ci }}</td>
                        </tr>
                        <tr>
                            <td>Correo electronico:</td>
                            <td><a href="mailto:{{ $user[0]->email }}">{{ $user[0]->email }}</a></td>
                        </tr>
                        <tr class="col-md-12 visible-xs">
                            <td><span class="glyphicon glyphicon-asterisk"></span></td>
                            <td>@include('user.btn_hacerAdmin')</td>
                        </tr>
                        @if($user[0]->deleted_at)
                            <tr class="col-md-12 visible-xs">
                                <td><span class="glyphicon glyphicon-asterisk"></span></td>
                                <td>@include('user.btn_recuperar')</td>
                            </tr>
                        @else
                            <tr class="col-md-12 visible-xs">
                                <td><span class="glyphicon glyphicon-asterisk"></span></td>
                                <td>@include('user.btn_borrar')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="col-md-12 hidden-xs">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>@include('user.btn_hacerAdmin')</td>
                                <td>
                                    @if($user[0]->deleted_at)
                                        @include('user.btn_recuperar')
                                    
                                    @else
                                        @include('user.btn_borrar')                                        
                                    @endif
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
