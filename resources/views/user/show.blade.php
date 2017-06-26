@extends('layouts.app')
@section('title', 'Ver un usuario')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Ver el usuario</h1></div>
                <div class="panel-body">
                <?php 
                // dd($user)
                //dd($user)
                 ?>
                <h3>
                    @if($user->esAdmin)
                        <span class="glyphicon glyphicon-certificate"></span>
                    @else
                        <span class="glyphicon glyphicon-education"></span>
                    @endif
                    {{$user->tipo($user->esAdmin)}}
                </h3>
                @include('layouts.flashes')
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
                            <td>@include('user.btn_editarUser')</td>
                        </tr>
                        @if($user->esAdmin)
                            <tr class="col-md-12 visible-xs">
                                <td><span class="glyphicon glyphicon-asterisk"></span></td>
                                <td>@include('user.btn_desHacerAdmin')</td>
                            </tr>
                        @else
                            <tr class="col-md-12 visible-xs">
                                <td><span class="glyphicon glyphicon-asterisk"></span></td>
                                <td>@include('user.btn_hacerAdmin')</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="col-md-12 hidden-xs">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>@include('user.btn_editarUser')</td>
                                <td>
                                    @if($user->esAdmin)
                                        @include('user.btn_desHacerAdmin')
                                    @else
                                        @include('user.btn_hacerAdmin')
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
