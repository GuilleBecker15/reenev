@if ($hoy<$vence)
<div class="alert alert-warning">
	<strong>Te quedan {{$intervalo->days}} dias para completar esta encuesta</strong>
</div>
@else
<div class="alert alert-danger">
	<strong>Ya finalizo el plazo para completar esta encuesta</strong>
</div>
@endif
<p><strong>Asunto de la encuesta: </strong>{{ $encuesta->asunto }}</p>
<p><strong>Descripcion de la encuesta: </strong>{{ $encuesta->descripcion }}</p>
<p><strong>Docente que se evalua: </strong>{{ $docente->nombre }} {{ $docente->apellido }}</p>
<p><strong>Curso que dicta el docente: </strong>{{ $curso->nombre }}</p>
<p><strong>Semestre en el cual se dicta el curso: </strong>{{ $curso->semestre }}</p>
<hr>
{{ Form::hidden('encuesta', $encuesta->toJson()) }}
{{ Form::hidden('docente', $docente->toJson()) }}
{{ Form::hidden('curso', $curso->toJson()) }}
{{ Form::hidden('preguntas', $preguntas->toJson()) }}