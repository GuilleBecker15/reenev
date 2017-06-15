@extends('layouts.app')
@section('title', 'Profesores de un curso')
@section('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="default-panel">
					<div class="panel-heading">
						<h1>Agregar o quitar profesor de un curso</h1>
					</div>
					<div class="panel-body">
						@include('layouts.flashes')
						<div class="form-group">
							<div style="border: 1px solid transparent; border-radius: 4px; box-shadow: 0 1px 1px rgba(0,0,0,.05)" class="text-center">
	                            <label class="control-label ">Docente(s) actual(es)</label>
	                        </div>
	                        @foreach ($docentesActuales as $key => $docenteActual)
	                        <div class="row">
	                            <div class="col-md-8 col-md-offset-1">                                
	                            <label class="form-inline control-label">{{ $docenteActual->id }} -
	                                {{ $docenteActual->nombre }} {{ $docenteActual->apellido }} </label>
	                            </div>
	                            <div>
	                                <form class="form-inline form-delete" method="POST" action="{{ route('Cursos.Docente.destroy', $curso->id) }}">
	                                    {{ csrf_field() }}
	                                    <input name="_method" type="hidden" value="DELETE">
	                                    <input name="docente_id" type="hidden" value="{{ $docenteActual->id }}">
	                                <button type="submit" class="btn btn-danger ">Borrar</button>
	                                </form>
	                            </div>
	                        </div>
	                        @endforeach
                    	</div>
                        <div class="form-group">
                        <form id="formularioModificacion" class="form-horizontal" role="form" method="POST" action="{{ route('Cursos.Docente.update',$curso->id) }}">
                        	<input name="_method" type="hidden" value="PUT">
                        	{{ csrf_field() }}
                            <label class="col-md-4 control-label">Seleccione el docente</label>
                            <div class="col-md-6">
                                <select id="docente_id" name="docente_id" type="text" class="form-control">
                                @foreach ($otrosDocentes as $key => $d)
                                    <option value="{{ $d->id }}">
                                    {{ $d->id }} - {{ $d->nombre }} {{ $d->apellido }}
                                </option>
                                @endforeach
                                </select>
                            </div>
	                        <div class="form-group">
	                            <div class="col-md-6 col-md-offset-4 ">
	                                <button id="modificar" type="submit" class="btn btn-primary btn-modificar">
	                                    Agregar docente
	                                </button>
	                            </div>
	                        </div>
                        </form>
                        </div>

					</div>
				</div>
			</div>
		</div>
	</div>
@endsection