@extends('layouts.app')
@section('title', 'Ver un usuario')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-6 col-md-offset-3">
			<div class="panel panel-default">
				<div class="panel-heading">
				<h1>
					@if($user->esAdmin)
					<span class="glyphicon glyphicon-certificate text-primary"></span>
					Administrador
					@else
					<span class="glyphicon glyphicon-education"></span>
					Estudiante
					@endif
				</h1>
				</div>
				<div class="panel-body">
					<table class="table table-user-information">
						<tbody>
						<caption>
							Estos son los datos personales del
							{{$user->tipo($user->esAdmin)}}
						</caption>
							<tr>
								<td>
									<strong>
										<i class="fa fa-user text-info" aria-hidden="true"></i>
										Primer nombre
									</strong>
								</td>
								<td>{{ $user->name1 }}</td>
							</tr>
							<tr>
								<td>
									<strong>
										<i class="fa fa-user-o text-info" aria-hidden="true"></i>
										Segundo nombre
									</strong>
								</td>
								<td>{{ $user->name2 }}</td>
							</tr>
							<td>
								<strong>
									<i class="fa fa-user text-info" aria-hidden="true"></i>
									Primer apellido
								</strong>
							</td>
							<td>{{ $user->apellido1 }}</td>
						</tr>
						<tr>
							<td>
								<strong>
									<i class="fa fa-user-o text-info" aria-hidden="true"></i>
									Segundo apellido
								</strong>
							</td>
							<td>{{ $user->apellido2 }}</td>
						</tr>
						<tr>
							<td>
								<strong>
									<i class="fa fa-birthday-cake text-info" aria-hidden="true"></i>
									Fecha de nacimiento
								</strong>
							</td>
							<td>{{ $user->uyNacimiento($user->nacimiento) }}</td>
						</tr>
						<tr>
							<td>
								<strong>
									<i class="fa fa-calendar-check-o text-info" aria-hidden="true"></i>
									Año de ingreso
								</strong>
							</td>
							<td>{{ $user->generacion }}</td>
						</tr>
						<tr>
							<td>
								<strong>
									<i class="fa fa-id-card text-info" aria-hidden="true"></i>
									Cédula de indentidad
								</strong>
							</td>
							<td>{{ $user->ci }}</td>
						</tr>
						<tr>
							<td>
								<strong>
									<i class="fa fa-envelope-o text-info" aria-hidden="true"></i>
									Correo electrónico
								</strong>
							</td>
							<td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
						</tr>
						<tr class="col-md-12 visible-xs">
							<td><span class="glyphicon glyphicon-asterisk"></span></td>
							<td>@include('user.btn_editarUser')</td>
						</tr>
						@if($user->esAdmin)
						<tr class="col-md-12 visible-xs">
							<td><span class="glyphicon glyphicon-asterisk"></span></td>
							<td>@include('user.btn_desHacerAdmin')</td>
						</tr>
						@else
						<tr class="col-md-12 visible-xs">
							<td><span class="glyphicon glyphicon-asterisk"></span></td>
							<td>@include('user.btn_hacerAdmin')</td>
						</tr>
						@endif
						@if($user->deleted_at)
						<tr class="col-md-12 visible-xs">
							<td><span class="glyphicon glyphicon-asterisk"></span></td>
							<td>@include('user.btn_recuperarUser')</td>
						</tr>
						@else
						<tr class="col-md-12 visible-xs">
							<td><span class="glyphicon glyphicon-asterisk"></span></td>
							<td>@include('user.btn_borrarUser')</td>
						</tr>
						@endif
					</tbody>
				</table>
				<div class="col-md-12 hidden-xs">
					<table class="table">
						<tbody>
							<tr>
								<td>@include('user.btn_editarUser')</td>
								<td>
									@if($user->esAdmin)
									@include('user.btn_desHacerAdmin')
									@else
									@include('user.btn_hacerAdmin')
									@endif
								</td>
								<td>
									@if($user->deleted_at)
									@include('user.btn_recuperarUser')
									@else
									@include('user.btn_borrarUser')
									@endif
								</td>
							</tr>
						</tbody>
					</table>
					<hr>
				</div>
				<a class="btn btn-default" href="{{ route('Users.index') }}">
				<span class="glyphicon glyphicon-arrow-left"></span></a>
			</div>
		</div>
	</div>
</div>
</div>
@endsection
