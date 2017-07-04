<form id="{{ $user->id }}.formulario" class="form-inline form-delete"
 method="POST" action="{{ route('Users.recuperar', $user->id) }}">
	<input name="_method" type="hidden" value="PUT">
	{{ csrf_field() }}
	<button id="{{ $user->id }}.user" type="submit" class="btn btn-success btn-xs borrado_confirm">Recuperar usuario</button>
</form>