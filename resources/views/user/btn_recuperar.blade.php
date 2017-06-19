{{ Form::open(['method' => 'POST', 'route' => ['Users.recuperar', $user[0]->id]]) }}
{{ Form::hidden('id', $user[0]->id) }}
{{ method_field('PUT') }}
{{ Form::submit('Recuperar', ['class' => 'btn-xs btn btn-danger']) }}
{{Form::close()}}