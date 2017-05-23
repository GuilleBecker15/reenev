{{ Form::open(['method' => 'DELETE', 'route' => ['Users.destroy', $user->id]]) }}
{{ Form::hidden('id', $user->id) }}
{{ Form::submit('Eliminarlo/Recuperarlo', ['class' => 'btn-xs btn btn-danger']) }}
{{Form::close()}}
