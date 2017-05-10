
	<div class="panel-heading">
		Bienvenido Estudiante
	</div>
	<div class="panel-body">
		<a href="{{ url('/student/encuesta') }}">Completar encuesta</a> <br>
		<a href="{{ url('/student/misencuentas') }}">Mis encuests</a> <br>
		<a href="{{ route('Users.edit', Auth::user()->id )}}">Modificar mis datos</a> <br>
	</div>