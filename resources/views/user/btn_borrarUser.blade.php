<form id="{{ $user->id }}.formulario" class="form-inline form-delete"
 method="POST" action="{{ route('Users.destroy', $user->id) }}">
	<input name="_method" type="hidden" value="DELETE">
	{{ csrf_field() }}
	<button id="{{ $user->id }}.user" type="submit" class="btn btn-danger btn-xs borrado_confirm">Banear usuario</button>
</form>