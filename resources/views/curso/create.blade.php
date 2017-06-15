@extends('layouts.app')
@section('title', 'Dar de alta un curso')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Dar de alta un curso</h1></div>
                <div class="panel-body">
                    @if(Session::has('message'))
                    <div class="alert alert-info success-dismissable">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        {{ Session::get('message') }}
                    </div>
                    @endif
                    <form onsubmit="return validarCampos();" class="form-horizontal" role="form" method="POST" action="{{ route('Cursos.store') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Docente</label>

                            <div class="col-md-6">
                                <select id="comboDocentesParaCrearCurso" name="docente_id" type="text" class="form-control">
                                @foreach ($docentes as $key => $d)
                                    <option value="{{ $d->id }}">
                                    {{ $d->id }} - {{ $d->nombre }} {{ $d->apellido }}
                                </option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nombre') ? ' has-error' : '' }}">
                            <label for="nombre" class="col-md-4 control-label">Nombre</label>

                            <div class="col-md-6">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Matematica Discreta y Logica 1" required autofocus>

                                @if ($errors->has('nombre'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('nombre') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('abreviatura') ? ' has-error' : '' }}">
                            <label for="abreviatura" class="col-md-4 control-label">Abreviatura</label>

                            <div class="col-md-6">
                                <input id="abreviatura" type="text" class="form-control" name="abreviatura" value="{{ old('abreviatura') }}" placeholder="MDyL1" required>

                                @if ($errors->has('abreviatura'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('abreviatura') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('semestre') ? ' has-error' : '' }}">
                            <label for="semestre" class="col-md-4 control-label">Semestre</label>

                            <div class="col-md-6">
                                <input id="semestre" type="number" class="form-control" name="semestre" value="{{ old('semestre') }}" min="1" max="6" required>

                                @if ($errors->has('semestre'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('semestre') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
 <div class="modalmio">
    <div class="overlay cerrar"></div>

    <div class="ventana">
        <a href="#" class="boton-cerrar cerrarYvolver">x</a>
        
        <div class="cuerpo text-justify">
            Lo lamento, aun no puede crear un nuevo curso debido a que no exiten profesores en el sistema.
        </div>
        <div>
            <div class="row">
                <div class="col-md-6 text-center">
                    <a class="btn btn-success" href="/Docentes/create">Crear nuevo docente</a>
                </div>
                <div class="col-md-6  text-right">
                    <a class="btn btn-warning" href="javascript:history.back();">Volver</a>        
                </div>
            </div>
        </div>
    </div>

</div>

<button type="button" id="activar">
    Abrir
</button>

<script>
let bot_abrir   = document.getElementById('activar');
let ventana     = document.getElementsByClassName('modalmio')[0];
let bots_cerrar = ventana.getElementsByClassName('cerrarYvolver');

// bot_abrir.addEventListener('click', function (evt)
// {
//     ventana.classList.add('activo');
// })

if( document.getElementById('comboDocentesParaCrearCurso').childElementCount == 0) {
    ventana.classList.add('activo');
}

for (let i = 0, l = bots_cerrar.length; i < l; i++)
{
    bots_cerrar[i].addEventListener('click', function (evt)
    {
        //ventana.classList.remove('activo');
        history.back();
    })
}


</script>
@endsection
