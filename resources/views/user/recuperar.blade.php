{{ Form::open(array('action' => array('UserController@recuperar', $user->id))) }}
{{ Form::submit('Recuperarlo', ['class' => 'btn-xs btn btn-success']) }}
{{Form::close()}}
