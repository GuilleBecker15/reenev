@extends('layouts.app')
@section('title', 'Ver un curso')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h1>
						<span class="glyphicon glyphicon-book"></span>
						Curso
					</h1>
				</div>
				<div class="panel-body">
					<div class="table responsive">
						<table class="table table-condensed table-responsive table-user-information">
							<tbody>
								<caption>Esta es la informacion de la materia</caption>
								<tr>
									<td>
										<strong>
											<i class="fa fa-bookmark text-info" aria-hidden="true"></i>
											Nombre
										</strong>
									</td>
									<td class="text">{{ $curso->nombre }}</td>
								</tr>
								<tr>
									<td>
										<strong>
											<i class="fa fa-bookmark-o text-info" aria-hidden="true"></i>
											Abreviatura
										</strong>
									</td>
									<td class="text">{{ $curso->abreviatura}}</td>
								</tr>
								<tr>
									<td>
										<strong>
											<i class="fa fa-hashtag text-info" aria-hidden="true"></i>
											Semestre
										</strong>
									</td>
									<td class="text">{{ $curso->semestre }}</td>
								</tr>
							</tbody>
						</table>
						@can('es_admin', App\User::class)
                        <hr>
                        <a class="btn btn-default" href="{{ route('Cursos.index') }}">
						<span class="glyphicon glyphicon-arrow-left"></span></a>
                        @endcan						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection