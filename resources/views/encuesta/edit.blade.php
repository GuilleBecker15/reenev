@extends('layouts.app')

@section('title', 'Editar una encuesta')

@section('content')
<div class="container">
    
    <div class="row">

        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Editar la encuesta</h1></div>
                <div class="panel-body">
                
                        @include('layouts.flashes')
                        <form id=formEncuesta action="{{ route('Encuestas.update', $encuesta->id) }}" method="POST" class="form-horizontal" accept-charset="utf-8">
                        <input name="_method" type="hidden" value="PUT">
                         {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('asunto') ? 'has-error' : '' }}">
                                <label type="text" name="asunto" class="col-md-4 control-label" for="asunto" value="">Asunto</label>  
                                <div class="col-md-6"> 
                                    <input class="form-control" id="asunto" name="asunto" value="{{ $encuesta->asunto }}" placeholder="" required autofocus >
                                    @if ($errors->has('asunto'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('asunto') }}</strong>
                                        </span>
                                    @endif
                                </div>               
                            </div>
                            <div class="form-group{{ $errors->has('descripcion') ? 'has-error' : '' }}">
                                <label type="text" name="descripcion" class="col-md-4 control-label" for="descripcion" value="">Descripción</label>  
                                <div class="col-md-6">
                                    <input class="form-control" id="descripcion" type="text" name="descripcion" value="{{ $encuesta->descripcion }}" placeholder="Ingrese un descripcion" required>
                                    @if ($errors->has('descripcion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('descripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>               
                            </div>                        

                            <div class="form-group{{ $errors->has('vence') ? 'has-error' : '' }}">
                                <label type="text" name="descripcion" class="col-md-6 control-label" for="descripcion" value="">Fecha limite para completar la encuesta</label>  
                                <div class="col-md-4">
                                    <input class="form-control" id="vence" type="fecha" name="vence" value="{{ $encuesta->vence }}" placeholder="" required>
                                </div>
                                <div class="col-md-6 col-md-offset-3">               
                                    @if ($errors->has('vence'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('vence') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="form-group text-center">
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary" value="Modificar"></input>
                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    
</script>
@endsection
