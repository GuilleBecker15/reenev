
			<div class="panel-heading">
				Bienvenido Administrador
			</div>
			<div class="panel-body">
                <a href="{{ route('Users.index') }}">Buscar estudiante</a> <br>
				<a href="{{ url('/admin/encuentas') }}">Ver encuests</a> <br>
				<a href="{{ route('Users.edit', Auth::user()->id )}}">Modificar mis datos</a><br>
		
			</div>
