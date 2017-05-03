@extends('layouts.app')

@section('title', 'Perfil')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">LLena todos los campos</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('Users.update', $user->id ) }}">
                    <input name="_method" type="hidden" value="PUT">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name1') ? ' has-error' : '' }}">
                            <label for="name1" class="col-md-4 control-label">Primer nombre</label>

                            <div class="col-md-6">
                                <input id="name1" type="text" class="form-control" name="name1" placeholder="{{ $user->name1 }}" value="{{ $user->name1 }}" required autofocus>

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
                                <input id="name2" type="text" class="form-control" name="name2" value="{{ $user->name2 }}" required autofocus>

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
                                <input id="apellido1" type="text" class="form-control" name="apellido1" value="{{ $user->apellido1 }}" required autofocus>

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
                                <input id="apellido2" type="text" class="form-control" name="apellido2" value="{{ $user->apellido2 }}" required autofocus>

                                @if ($errors->has('apellido2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('apellido2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('nacimiento') ? ' has-error' : '' }}">
                            <label for="nacimiento" class="col-md-4 control-label">Nacimiento</label>

                            <div class="col-md-6">
                                <input id="nacimiento" type="date" class="form-control" name="nacimiento" value="{{ $user->nacimiento }}" required autofocus>

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
                                <input id="generacion" type="date" class="form-control" name="generacion" value="{{ $user->generacion }}" required autofocus>

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
                                <input id="ci" type="string" class="form-control" name="ci" value="{{ $user->ci }}" required autofocus>

                                @if ($errors->has('ci'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('ci') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Correo</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Modifcar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection