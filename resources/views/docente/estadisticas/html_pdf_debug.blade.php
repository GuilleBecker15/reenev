<ul>
    @foreach ($encuestas as $encuesta)
    <li>Encuesta ({{$encuesta->id}}) {{$encuesta->asunto}}</li>
    <ul>
        @foreach ($cursos as $curso)
        <li>Curso ({{$curso->id}}) {{$curso->nombre}}</li>
        <ul>
            @foreach ($encuesta->preguntas as $pregunta)
            <li>Pregunta ({{$pregunta->id}}) {{$pregunta->enunciado}}</li>
            <ul>
                <li>No corresponde: {{$docente->responden(0, $curso->id, $pregunta->id)}} alumnos</li>
                <li>Muy mal: {{$docente->responden(1, $curso->id, $pregunta->id)}} alumnos</li>
                <li>Mal: {{$docente->responden(2, $curso->id, $pregunta->id)}} alumnos</li>
                <li>Normal: {{$docente->responden(3, $curso->id, $pregunta->id)}} alumnos</li>
                <li>Bien: {{$docente->responden(4, $curso->id, $pregunta->id)}} alumnos</li>
                <li>Muy bien: {{$docente->responden(5, $curso->id, $pregunta->id)}} alumnos</li>
            </ul>
            @endforeach
        </ul>
        @endforeach
    </ul>
    @endforeach
</ul>