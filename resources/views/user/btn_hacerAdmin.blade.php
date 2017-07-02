{{ Form::open(array('action' => array('UserController@hacerAdmin', $user->id))) }}
{{ Form::submit('Hacer admin', ['class' => 'btn-xs btn btn-default']) }}
{{Form::close()}}
