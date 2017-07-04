@if(Session::has('message'))
    <div class="alert alert-success success-dismissable">
        <button aria-hidden="true" data-dismiss="alert" class="close cerrarflash" type="button">×</button>
        {{ Session::get('message') }}
    </div>
    {{ Session::forget('message') }}
@endif
@if(Session::has('error'))
	<div class="alert alert-danger danger-dismissable">
		<button aria-hidden="true" data-dismiss="alert" class="close cerrarflash" type="button">×</button>
		{{ Session::get('error') }}
	</div>
    {{ Session::forget('error') }}
@endif
