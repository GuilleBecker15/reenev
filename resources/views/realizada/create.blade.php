@extends('layouts.app')

@section('title', 'Completar encuesta')

@section('content')
<div class="container">

    <div class="row">
        
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Completar encuesta</h1></div>
                <div class="panel-body">
                    <form onsubmit="return validarCampos();" class="form-horizontal" role="form" method="POST" action="{{ route('Realizadas.store') }}">
                        {{ csrf_field() }}
                        {{ print_r($_REQUEST) }}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
