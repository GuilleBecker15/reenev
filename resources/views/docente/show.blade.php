@extends('layouts.app')
@section('title', 'Editar un docente')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Informacion del docente</h1></div>

                <div class="panel-body">
                   @include('layouts.flashes')

                         <div class="table responsive">
                            <table class="table table-condensed table-responsive table-user-information">
                                <tbody>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-user  text-primary"></span>
                                                Nombre
                                            </strong>
                                        </td>
                                        <td class="text-primary">{{ $docente->nombre }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-bookmark text-primary"></span>
                                                Apellido
                                            </strong>
                                        </td>
                                        <td class="text-primary">{{ $docente->apellido}}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-asterisk text-primary"></span>
                                                Documento de indentidad
                                            </strong>
                                        </td>
                                        <td class="text-primary">{{ $docente->ci }}</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <strong>
                                                <span class="glyphicon glyphicon-envelope text-primary"></span>
                                                Email
                                            </strong>
                                        </td>
                                        <td class="text-primary">{{ $docente->email }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>
                                            </strong>
                                                <a class="btn btn-primary" href="{{ route('Docentes.index') }}"><span class="glyphicon glyphicon-arrow-left"></span>Volver</a>
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
