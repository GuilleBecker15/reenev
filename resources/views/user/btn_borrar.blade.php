{{ Form::open(['method' => 'DELETE', 'route' => ['Users.destroy', $user[0]->id]]) }}
{{ Form::hidden('id', $user[0]->id) }}
{{ Form::submit('Eliminar', ['class' => 'btn-xs btn btn-danger']) }}
{{Form::close()}}
