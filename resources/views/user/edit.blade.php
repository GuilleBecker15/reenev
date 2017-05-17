@extends('layouts.app')
@section('title', 'Datos del usuario')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">Ver o modificar datos del usuario</div>
                <br>
                <!-- <?php 
                    if (Session::has('error')  ) {
                        var_dump(Session::get('error'));
                    }
                    echo "<br>-------------------------<br>";                                   
                    if (Session::has('message')  ) {
                        var_dump(Session::get('message'));
                    }
                    echo "<br>-------------------------<br>";                                   
                        var_dump(Session::all());                      
                    echo "<br>-------------------------<br>";                                   
                        var_dump(Hash::check('qwerty', $user->password));                      
                    echo "<br>-------------------------<br>";                                   
                        var_dump(('qwerty'==bcrypt($user->password)));                      
                ?>
                 -->
                <div class="panel-body">
                    @if(Session::has('error'))
                        <div class="alert alert-{{ Session::get('error-type') }} alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <i class="glyphicon glyphicon-{{ Session::get('error-type') == 'error' ? 'ok' : 'remove'}}"></i> {{ Session::get('error') }}
                        </div>
                    @endif
                    @if(Session::has('message'))
                        <div class="alert alert-{{ Session::get('error-type') }} success-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <i class="glyphicon glyphicon-{{ Session::has('message') == 'success' ? 'ok' : 'remove'}}"></i> {{ Session::has('message') }}
                        </div>
                    @endif
                    <form onsubmit="return validarCampos();" id="formularioModificacion" class="form-horizontal" role="form" method="POST" action="{{ route('Users.updateByAjax',$user->id) }}">
                        <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name1" class="col-md-4 control-label">Opciones</label>
                            <div class="col-md-6">
                                <select
                                onchange="habilitar_o_no()"
                                id="verModificar" type="text" class="form-control" name="modificar" required autofocus>
                                <option value="no">Quiero VER mis datos</option>
                                <option value="si">Quiero MODIFICAR mis datos</option>
                                </select>
                            </div>
                    </div>
                    <div class="form-group{{ $errors->has('name1') ? ' has-error' : '' }}">
                        <label for="name1" class="col-md-4 control-label">Primer nombre</label>
                        <div class="col-md-6">
                            <input disabled id="name1" type="text" class="form-control" name="name1" value="{{ $user->name1 }}" required>
                            @if ($errors->has('name1'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name1') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name2') ? ' has-error' : '' }}">
                        <label for="name2" class="col-md-4 control-label">Segundo Nombre</label>
                        <div class="col-md-6">
                            <input disabled id="name2" type="text" class="form-control" name="name2" value="{{ $user->name2 }}" required>
                            @if ($errors->has('name2'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name2') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('apellido1') ? ' has-error' : '' }}">
                        <label for="apellido1" class="col-md-4 control-label">Primer apellido</label>
                        <div class="col-md-6">
                            <input disabled id="apellido1" type="text" class="form-control" name="apellido1" value="{{ $user->apellido1 }}" required>
                            @if ($errors->has('apellido1'))
                            <span class="help-block">
                                <strong>{{ $errors->first('apellido1') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('apellido2') ? ' has-error' : '' }}">
                        <label for="apellido2" class="col-md-4 control-label">Segundo apellido</label>

                        <div class="col-md-6">
                            <input disabled id="apellido2" type="text" class="form-control" name="apellido2" value="{{ $user->apellido2 }}" required>

                            @if ($errors->has('apellido2'))
                            <span class="help-block">
                                <strong>{{ $errors->first('apellido2') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('nacimiento') ? ' has-error' : '' }}">
                        <label for="nacimiento" class="col-md-4 control-label">Fecha de Nacimiento</label>
                        <div class="col-md-6">
                            <input disabled id="nacimiento" type="fecha" class="form-control" name="nacimiento" value="{{ $user->uyNacimiento($user->nacimiento) }}" required >
                            @if ($errors->has('nacimiento'))
                            <span class="help-block">
                                <strong>{{ $errors->first('nacimiento') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('generacion') ? ' has-error' : '' }}">
                        <label for="generacion" class="col-md-4 control-label">Generacion</label>
                        <div class="col-md-6">
                            <select disabled id="generacion" type="text" class="form-control" name="generacion" value="{{ $user->generacion }}" required></select>
                            @if ($errors->has('generacion'))
                            <span class="help-block">
                                <strong>{{ $errors->first('generacion') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('ci') ? ' has-error' : '' }}">
                        <label for="ci" class="col-md-4 control-label">Cedula</label>
                        <div class="col-md-6">
                            <input disabled id="ci" type="cedula" class="form-control" name="ci" value="{{ $user->ci }}" required >
                            @if ($errors->has('ci'))
                            <span class="help-block">
                                <strong>{{ $errors->first('ci') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                        <div id="divaniadir" class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo</label>
                        <div class="col-md-6">
                            <input disabled id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4 ">
                                <button disabled id="cambiarPass" type="button" class="btn btn-primary btn-cambiarPass" onClick="location.href='{{ route('cambiarPass', $user->id) }}'">
                                    Cambiar contraseña
                                </button>
                                <button disabled id="modificar" type="button" class="btn btn-primary btn-modificar">
                                    Modifcar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<!-- <button id="miboton" type="submit" class="btn btn-primary">Mi boton</button>
 --><!-- Ventana modal para modificar -->
 <div class="col-md-8 col-md-offset-4">     
    <div id="myModal" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Corfirmacion</h4>
                </div>
                <div class="modal-body">
                    <p>Para guardar los cambios debe introducir su contrase&ntilde;a</p>
                    <p class="text-warning">Intruduzca su contrase&ntilde;a</p>
                    <div id="divpass" class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Contraseña</label>
                        <div class="col-md-8">
                            <input id="confirmarPass" type="password" class="form-control" name="password" autofocus required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div><br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button id="modificarDatos" type="button" class="btn btn-primary">Guardar datos</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

