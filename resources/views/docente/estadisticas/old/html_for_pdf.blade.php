<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bootstrap Example</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    .page-break {
    	page-break-after: always;
	}
    </style>
</head>
<body>

	<table>
		<caption>Referencias</caption>
		<thead>
			<tr>
				<thead>Puntaje</thead>
				<thead>Significado</thead>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>0</td>
				<td>No corresponde</td>
			</tr>
			<tr>
				<td>1</td>
				<td>Muy mal</td>
			</tr>
			<tr>
				<td>2</td>
				<td>Mal</td>
			</tr>
			<tr>
				<td>3</td>
				<td>Normal</td>
			</tr>
			<tr>
				<td>4</td>
				<td>Bien</td>
			</tr>
			<tr>
				<td>5</td>
				<td>Muy bien</td>
			</tr>
		</tbody>
	</table>

    <div class="page-break"></div>

	@foreach ($encuestas as $encuesta)
    <div id="container_{{$encuesta->id}}">
        <h3 id="encuesta_{{$encuesta->id}}">Encuesta : {{$encuesta->asunto}}</h3>
        <hr>
        @foreach ($cursos as $curso)
        <table id="table_{{$curso->id}}">
            <thead id="thead_{{$curso->id}}">
                <tr id="tr1_{{$curso->id}}">
                    <th id="th_{{$curso->id}}">Curso : {{$curso->nombre}}</th>
                    <th id="th0_{{$curso->id}}">0</th>
                    <th id="th1_{{$curso->id}}">1</th>
                    <th id="th2_{{$curso->id}}">2</th>
                    <th id="th3_{{$curso->id}}">3</th>
                    <th id="th4_{{$curso->id}}">4</th>
                    <th id="th5_{{$curso->id}}">5</th>
                </tr>
            </thead>
            <tbody  id="tbody_{{$curso->id}}">
            @foreach ($encuesta->preguntas as $pregunta)
                <tr id="pregunta_{{$pregunta->id}}">
                    <td id="enunciado_{{$pregunta->id}}">{{$pregunta->enunciado}}</td>
                    <td id="0_{{$pregunta->id}}">{{$docente->responden(0, $curso->id, $pregunta->id)}}</td>
                    <td id="1_{{$pregunta->id}}">{{$docente->responden(1, $curso->id, $pregunta->id)}}</td>
                    <td id="2_{{$pregunta->id}}">{{$docente->responden(2, $curso->id, $pregunta->id)}}</td>
                    <td id="3_{{$pregunta->id}}">{{$docente->responden(3, $curso->id, $pregunta->id)}}</td>
                    <td id="4_{{$pregunta->id}}">{{$docente->responden(4, $curso->id, $pregunta->id)}}</td>
                    <td id="5_{{$pregunta->id}}">{{$docente->responden(5, $curso->id, $pregunta->id)}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="page-break"></div>
        @endforeach
    </div>
    @endforeach
</body>
</html>