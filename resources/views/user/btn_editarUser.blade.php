{{ Form::open(['method' => 'GET', 'route' => ['Users.edit', $user->id]]) }}
{{ Form::hidden('id', $user->id) }}
{{ Form::submit('Editar usuario', ['class' => 'btn btn-xs btn-primary']) }}
{{Form::close()}}
