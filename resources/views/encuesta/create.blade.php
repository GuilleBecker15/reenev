@extends('layouts.app')

@section('title', 'Dar de alta una encuesta')

@section('content')
<div class="container">
    
    <div class="row">

        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Dar de alta una encuesta</h1></div>
                <?php 
                        // use Carbon\Carbon;
                        // var_dump(Carbon::now()->toDateString());
                        // $hoy=Carbon::now()->toDateString();
                        // var_dump(Carbon::createFromDate(2017, 06, 20)->toDateString());
                        // $otro=Carbon::createFromDate(2017, 06, 20)->toDateString();
                        // if($hoy<$otro) echo "el mayor";
                        //     else echo "no es mayor <br> <br> ";
                        //     if(!isset($e)){
                        // dd($e);
                        //     }

                ?>
                <div class="panel-body">
                    @include('layouts.flashes')
                        <form action="{{ route('Encuestas.store') }}" method="POST" class="form-horizontal" accept-charset="utf-8">
                         {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('asunto') ? 'has-error' : '' }}">
                                <label type="text" name="asunto" class="col-md-4 control-label" for="asunto" value="">Asunto</label>  
                                <div class="col-md-6">
                                    <input class="form-control" id="asunto" name="asunto" value="{{ old('asunto') }}" placeholder="" required autofocus >
                                    @if ($errors->has('asunto'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('asunto') }}</strong>
                                        </span>
                                    @endif
                                </div>               
                            </div>
                            <div class="form-group{{ $errors->has('descripcion') ? 'has-error' : '' }}">
                                <label type="text" name="descripcion" class="col-md-4 control-label" for="descripcion" value="">descripcion</label>  
                                <div class="col-md-6">
                                    <input class="form-control" id="descripcion" type="text" name="descripcion" value="{{ old('descripcion') }}" placeholder="Ingrese un descripcion" required>
                                    @if ($errors->has('descripcion'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('descripcion') }}</strong>
                                        </span>
                                    @endif
                                </div>               
                            </div>
                            <div class="form-group{{ $errors->has('vence') ? 'has-error' : '' }}">
                                <label type="text" name="descripcion" class="col-md-7 control-label" for="descripcion" value="">Fecha limite para completar la encuesta</label>  
                                <div class="col-md-3">
                                    <input class="form-control" id="vence" type="fecha" name="vence" value="{{ old('vence') }}" placeholder="" required>
                                </div> 
                                <div class="col-md-8 col-md-offset-2">              
                                    @if ($errors->has('vence'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('vence') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Aceptar
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
