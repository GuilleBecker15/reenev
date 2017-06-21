{{ Form::open(['method' => 'GET', 'route' => ['Encuestas.edit', $encuesta->id]]) }}
{{ Form::submit('Editar datos', ['class' => 'btn btn-primary']) }}
{{ Form::close() }}
