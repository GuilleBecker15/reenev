@extends('layouts.app')
@section('title', 'Ver encuesta')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<h1>Informe estadistico para el docente...</h1>
                </div>
                <div id="chartparent" class="panel-body">
                @foreach($realizadas as $r)
                	@include('docente.grafica')
                	<div id="chart_div_{{$r->id}}"></div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
