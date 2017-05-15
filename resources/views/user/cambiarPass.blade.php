@extends('layouts.app')

@section('title', 'Modificar Password - Reenev')

@section ('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">
						Modificar contraseña
							
                                <?php 
                                	/*var_dump($user);
                                	echo "<br>-------------------------<br>";
                                	var_dump(Session::All());
                                	echo "<br>-------------------------<br>";
                                	echo "<br>-------------------------<br>";
                                	var_dump(bcrypt('qwerty'));
                                	echo "<br>-------------------------<br>";
                                	var_dump($user->password);*/
                                	if (isset($errors)) {
                                		var_dump($errors->first('pass2'));
                                	}
                                ?>

						<br>
						
					</div>
					<div class="panel-body">
						<form id="formularioUpdatePass" class="form-horizontal" role="form" method="POST" action="{{ route('updatePass', $user->id ) }}">

                   			 <input name="_method" type="hidden" value="PUT">
                        	{{ csrf_field() }}
								<div class="form-group{{ $errors->has('pass2') ? ' has-error' : '' }}">
										<label for="pass1" class="col-md-4 control-label">contraseña nueva</label>
									<div class="col-md-6">
										<input id="pass1" type="text" name="pass1" value="" class="form-control" required>										
									</div>
									@if ($errors->has('pass2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pass2') }}</strong>
                                    </span>
                                	@endif
								</div>

								<div class="form-group">
									<div class="col-md-4 ">
										<label>Repita la contraseña</label>
									</div>									
									<div class="col-md-6">
										<input id="pass2" type="text" name="pass2" value="" class="form-control" required>										
									</div>
								</div>

								<!-- <div class="form-group">
									<div class="col-md-4 ">
										<label>contraseña actual</label>
									</div>									
									<div class="col-md-6">
										<input id="pass" type="text" name="pass" value="" class="form-control" required>										
									</div>
								</div> -->

								<div class="form-group{{ $errors->has('pass') ? ' has-error' : '' }}">
										<label for="pass" class="col-md-4 control-label">contraseña nueva</label>
									<div class="col-md-6">
										<input id="pass" type="text" name="pass" value="" class="form-control" required>										
									</div>
									@if ($errors->has('pass'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pass') }}</strong>
                                    </span>
                                	@endif
								</div>

							    <div class="form-group">
		                            <div class="col-md-6 col-md-offset-4 ">
		                                <button  id="cambiarPass" type="submit" class="btn btn-primary btn-cambiarPass">
		                                    Cambiar contraseña
		                                </button>
		                            </div>
                        		</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection