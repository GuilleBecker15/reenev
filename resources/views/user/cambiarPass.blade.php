@extends('layouts.app')

@section('title', 'Modificar Password - Reenev')

@section ('content')
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">

					<h1>Modificar contraseña</h1>
							
                                <?php 
                                	/*var_dump($user);
                                	echo "<br>-------------------------<br>";
                                	var_dump(Session::All());
                                	echo "<br>-------------------------<br>";
                                	echo "<br>-------------------------<br>";
                                	var_dump(bcrypt('qwerty'));
                                	echo "<br>-------------------------<br>";*/
                                	
                                	/*if (Session::has('error')  ) {
                                		var_dump(Session::get('error'));
                                	}
                                	echo "<br>-------------------------<br>";                                	
                                	if (Session::has('message')  ) {
                                		var_dump(Session::get('message'));
                                	}*/
                                ?>
                                <!-- {{ $errors->first('incorrecta') }} -->

						<br>
						
					</div>
					<div class="panel-body">
						@if(Session::has('error')||Session::has('message'))
                        <div class="alert alert-success alert-dismissable">
                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                            <i class="glyphicon glyphicon-success"></i> {{ Session::get('message') }}
                        </div>
                    	@endif


						<form id="formularioUpdatePass" class="form-horizontal" role="form" method="POST" action="{{ route('updatePass', $user->id ) }}">

                   			 <input name="_method" type="hidden" value="PUT">
                        	{{ csrf_field() }}
								<div class="form-group{{ $errors->has('pass1') ? ' has-error' : '' }}">
										<label for="pass1" class="col-md-4 control-label">Contraseña nueva</label>
									<div class="col-md-6">
										<input id="pass1" type="password" name="pass1" value="" class="form-control" placeholder="******" required>	
									</div>						
									<div class="col-md-6 col-md-offset-4">
										@if ($errors->has('pass1'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('pass1') }}</strong>
	                                    </span>
	                                	@endif                                		
                                	</div>
                                	
								</div>				

								<div class="form-group{{ $errors->has('pass2') ? ' has-error' : '' }}">
										<label for="pass2" class="col-md-4 control-label">Repita contraseña </label>
									<div class="col-md-6">
										<input id="pass2" type="password" name="pass2" value="" class="form-control" placeholder="******" required>										
									</div>
									<div class="col-md-6 col-md-offset-4">	
										@if ($errors->has('pass2'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('pass2') }}</strong>
	                                    </span>
	                                	@endif
	                                </div>
								</div>

								<div class="form-group{{ $errors->has('pass') ? ' has-error' : '' }}">
										<label for="pass" class="col-md-4 control-label">Contraseña actual</label>
									<div class="col-md-6">
										<input id="pass" type="password" name="pass" value="" class="form-control" placeholder="******" required>										
									</div>
									<div class="col-md-offset-4 col-md-6">
										@if ($errors->has('pass'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('pass') }}</strong>
	                                    </span>
	                                	@endif
	                                </div>
<!-- 									<div class="col-md-offset-4 col-md-6">
										@if ($errors->has('incorrecta'))
	                                    <span class="help-block">
	                                        <strong>{{ $errors->first('incorrecta') }}</strong>
	                                    </span>
	                                	@endif                                		
                                	</div> -->
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