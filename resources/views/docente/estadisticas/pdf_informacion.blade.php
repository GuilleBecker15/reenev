<div id="informacion">

	<h1 style="color: rgb(30, 144, 255);">{{$encuesta->asunto}}</h1>
	<sub><i>{{$encuesta->descripcion}}</i></sub>

	<h3 style="color: rgb(105, 105, 105);">Prof. {{$docente->nombre}} {{$docente->apellido}}</h3>
	<sub><i>{{$curso->nombre}} (semestre {{$curso->semestre}}) </i></sub>

	<p>El presente documento muestra datos estadísticos
	respecto a las encuestas completadas por estudiantes de esta institucion educativa</p>

	<p><b style="color: rgb(105, 105, 105);">Se mostraran tres tablas (una por página): </b></p>

	<p>- La primera es la tabla de referencia de puntajes</p>
	<p>- La segunda es una tabla con el numero de alumnos que respondieron con un determinado puntaje a una pregunta, acerca de la asignatura</p>
	<p>- La tercera es una tabla con el porcentaje de alumnos que respondieron con un determinado puntaje a una pregunta, acerca de la asignatura</p>

	<p>
		<i style="color: rgb(105, 105, 105);">Esta encuesta fue completada por
		<b>{{$docente->participantes($curso->id, $encuesta->preguntas()->first()->id)}}</b>
		alumnos entre el <b>{{$encuesta->uyInicioVence($encuesta->inicio)}}</b>
		y el <b>{{$encuesta->uyInicioVence($encuesta->vence)}}</b></i>
	</p>

</div>