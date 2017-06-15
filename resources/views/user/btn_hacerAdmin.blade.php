{{ Form::open(array('action' => array('UserController@hacerAdmin', $user[0]->id))) }}
{{ Form::submit('Hacer/Deshacer admin', ['class' => 'btn-xs btn btn-warning']) }}
{{Form::close()}}
