{{ Form::open(array('action' => array('UserController@hacerAdmin', $user->id))) }}
{{ Form::submit('Deshacer admin', ['class' => 'btn-xs btn btn-warning']) }}
{{Form::close()}}
