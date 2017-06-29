@extends('layouts.app')
@section('title', 'Encuestas')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1>Cursos afectados por la encuesta</h1>
                    @include('layouts.flashes')
                </div>
                <div class="panel-body">
				<ul class="nav nav-tabs">
				  <li><a href="{{ route('Encuestas.index')}}">Disponibles</a></li>
				  <li class="active" ><a href="{{ route('Realizadas.index')}}">Completadas</a></li>
				  <li><a href="{{ route('Realizada.todos')}}">Participantes</a></li>
				</ul>
				<br>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Curso</th>
                                    <th>Docente</th>
                                </tr>
                            </thead>
                            @foreach ($realizadasPorMateria as $key => $materias)
								@php $mates = $materias->groupBy('docente_id') @endphp
                            <tbody>
                                <tr>
                                    <td>{{ $materias->first->get()->id }}</td>
                                    @foreach ( $mates as $key => $profes)
                                    <td>{{ $profes[0]->nombre }}</td>
                                    <td>{{ $profes[0]->nombredocente }} {{ $profes[0]->apellido }}</td>
                                    <td>
										{{ Form::open(['method' => 'GET', 'route' =>
										['Realizada.quienes', $profes[0]->encuesta_id]]) }}
<!--
	@extends('layouts.app')
@section('title', 'Encuestas realizadas por materia')
@section('content')
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel-default">
				<div class="panel-heading">
					<h1>Materias encuestadas</h1>
									<?php 
										//dd($r[0]->id);
									?>
				</div>
				<div class="panel-body">
					@include('layouts.flashes')
					<div class="table-responsive">
						<table class="table" align="center">
							<thead align="center">
								<tr align="center">
									<th class="centrar">Id</th>
									<th class="centrar">Materia</th>
									<th class="centrar">Profesor</th>
									<th class="centrar">Cantidad de encuestados</th>
									<th></th>
								</tr>
							</thead>
							@foreach ($realizadasPorMateria as $key => $materias)
								@php $mates = $materias->groupBy('docente_id')@endphp
							<tbody>
								<tr align="center">
									<td align="center" class="centrarvertical" rowspan="{{ $mates->count() }}">{{ $materias->first->get()->id }}</td>
							@foreach ( $mates as $key => $profes)
									
									<td align="center" class="centrarvertical">{{ $profes[0]->nombre }} </td>
									<td align="center" class="centrarvertical">{{ $profes[0]->nombredocente }} {{ $profes[0]->apellido }}</td>
									<td align="center" class="centrarvertical">{{ $profes->count() }}</td>
									<td align="center" class="centrarvertical">
									<?php //dd($mates) ?>
										{{ Form::open(['method' => 'GET', 'route' => ['Realizada.quienes', $profes[0]->encuesta_id]]) }}
-->
                                        {{ Form::hidden('idEncuesta', $profes[0]->encuesta_id) }}
                                        {{ Form::hidden('idCurso', $profes[0]->curso_id) }}
                                        {{ Form::hidden('idDocente', $profes[0]->docente_id) }}
                                        {{ Form::submit('Alumnos encuestados',
                                        ['class' => 'btn btn-xs btn-default']) }}
                                        {{Form::close()}}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
