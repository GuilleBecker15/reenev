@extends('layouts.app')
@section('title', 'Ver un docente')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading"><h1>Ver el docente</h1></div>
				<div class="panel-body">
					@include('layouts.flashes')
					<div class="table responsive">
						<table class="table table-condensed table-responsive table-user-information">
							<tbody>
								<caption>Estos son los datos personales del profesor</caption>
								<tr>
									<td>
										<strong>
											<i class="fa fa-address-card text-primary" aria-hidden="true"></i>
											Nombre
										</strong>
									</td>
									<td class="text">{{ $docente->nombre }}</td>
								</tr>
								<tr>
									<td>
										<strong>
											<i class="fa fa-address-card-o text-primary" aria-hidden="true"></i>
											Apellido
										</strong>
									</td>
									<td class="text">{{ $docente->apellido}}</td>
								</tr>
								<tr>
									<td>
										<strong>
											<i class="fa fa-id-card text-primary" aria-hidden="true"></i>
											Cédula de indentidad
										</strong>
									</td>
									<td class="text">{{ $docente->ci }}</td>
								</tr>
								<tr>
									<td>
										<strong>
											<i class="fa fa-envelope-o text-primary" aria-hidden="true"></i>
											Correo electrónico
										</strong>
									</td>
									<td class="text">
										<a href="mailto:$docente->email">{{$docente->email}}</a>
									</td>
								</tr>
							</tbody>
						</table>
						<hr>
						<a class="btn btn-default" href="{{ route('Docentes.index') }}">
						<span class="glyphicon glyphicon-arrow-left"></span></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection