@extends('layouts.app')
@section('title', 'Profesores de un curso')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Editar docentes del curso</h1></div>
                <div class="panel-body">
                    @if ($docentesActuales->count()>0)
                    <table class="table">
                        <caption>Docentes de <strong>{{$curso->nombre}}:</strong></caption>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Apellido</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($docentesActuales as $key => $dA)
                            <tr>
                                <td>{{$dA->id}}</td>
                                <td>{{$dA->nombre}}</td>
                                <td>{{$dA->apellido}}</td>
                                <td>@include('curso.btn_quitarDocente')</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    @endif
                    @if ($otrosDocentes->count()>0)
                    <form onsubmit="return validarCampos();" id="formularioModificacion"
                    class="form-horizontal" role="form" method="POST"
                    action="{{ route('Cursos.Docente.update', $curso->id) }}">
                    <input name="_method" type="hidden" value="PUT">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-4 control-label">Docentes disponibles:</label>
                        <div class="col-md-4">
                            <select id="docente_id" name="docente_id" type="text" class="form-control">
                                @foreach ($otrosDocentes as $key => $oD)
                                <option value="{{ $oD->id }}">
                                    {{ $oD->id }} - {{ $oD->nombre }} {{ $oD->apellido }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <button id="modificar" type="submit" class="btn btn-primary">Agregar</button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
@endsection
