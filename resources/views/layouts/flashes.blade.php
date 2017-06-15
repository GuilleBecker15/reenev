@if(Session::has('message'))
    <div class="alert alert-success success-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close cerrarflash" type="button">×</button>
        {{ Session::get('message') }}
    </div>
@endif
@if($errors->has('enunciado'))

	<div class="alert alert-danger danger-dismissable">
		<button aria-hidden="true" data-dismiss="alert" class="close cerrarflash" type="button">×</button>
		{{ $errors->first('enunciado') }}
	</div>
@endif
