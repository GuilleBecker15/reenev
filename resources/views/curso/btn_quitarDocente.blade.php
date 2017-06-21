<form class="form-inline form-delete"
 method="POST" action="{{ route('Cursos.Docente.destroy', $curso->id) }}">
	{{ csrf_field() }}
	<input name="_method" type="hidden" value="DELETE">
	<input name="docente_id" type="hidden" value="{{ $dA->id }}">
	<button type="submit" class="btn btn-default btn-xs">Quitar</button>
</form>
