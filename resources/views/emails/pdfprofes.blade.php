<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title></title>
	<link rel="stylesheet" href="">
	<style type="text/css">
		h1 {
			color: #002060;
		}
		h2 {
			color: #ff0000;
			text-decoration: underline;
		}
		.algo {
			background: red;
		}
		.table-responsive {
			min-height: 0.01% ; 
			overflow-x: auto ; 
		}
		table {
		    border-spacing: 0;
		    border-collapse: collapse;
		}
		tbody {
		    display: table-row-group;
		    vertical-align: middle;
		    border-color: inherit;
		    text-align: center;
		}
		tr {
		    display: table-row;
		    vertical-align: inherit;
		    border-color: inherit;
		}
		thead {
		    display: table-header-group;
		    vertical-align: middle;
		    border-color: inherit;
		}
		td {
		    border-left: 1px solid #ddd;
		}
		.table {
			background-color: rgba(0, 0, 0, 0);
			border-collapse: collapse ; 
			box-sizing: border-box ; 
			display: table ; 
			margin-bottom: 20px ; 
			max-width: 100% ; 
			width: 100%;
			display: table;
		    border-spacing: 2px;
		    border-color: grey;
		}
		child>th {
		    border-top: 0;
		}
		.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th{
		    padding: 8px;
		    line-height: 1.42857143;
		    vertical-align: top;
		    border-top: 1px solid #ddd;
		}
		.table>tbody+tbody {
		    border-top: 2px solid #ddd;
		}
		.table>tbody>tr>td {
		    padding: 8px;
		    line-height: 1.42857143;
		    vertical-align: middle;
		    border-top: 1px solid #ddd;
		}
		.table>thead>tr>th {
			text-align: center;
		    vertical-align: bottom;
		    border-bottom: 2px solid #ddd;
		}
	</style>
</head>
<header>
	<div style="text-align: center;">
		<div style="font-size: 8px;">TECN&Oacute;LOGO EN INFORM&Aacute;TICA</div>
		<div style="font-size: 8px; margin-bottom: 0.5rem">Sede Paysand&uacute;</div>
		<div>
			<img src="{{ public_path() }}/logos/anep.jpg" alt="" height="50" >
			<img src="{{ public_path() }}/logos/images.jpg" alt="" height="50" >
			<img src="{{ public_path() }}/logos/cti_flex_logo.png" alt="" height="50">
			<img src="{{ public_path() }}/logos/logo-cup.png" alt="" height="50" >
		</div>
	</div>
</header><!-- /header -->
<body>
	<h1>Evaluacion estudiantil {{ $semestre }} semestre a&ntilde;o {{ $anio }}</h1>
	<div>
		<h2>Referencia</h2>
		<p>1 - Malo</p>
		<p>2 - Regular</p>
		<p>3 - Aceptable</p>
		<p>4 - Bueno</p>
		<p>5 - Muy bueno</p>
		<p>N/C - No corresponde</p>
	</div>
	<div class="table-responsive">
		<table class="table">
			<caption>
				<h3>
					<strong>Docente: {{ $docente->nombre }} {{ $docente->apellido }}</strong><br>
					Curso: {{ $curso->nombre }}<br>
					Encuestados: {{ $cantidad }}
				</h3>
			</caption>
			<thead>
				<tr>
					<th>Pregunta</th>
					<th>N/C</th>
					<th>1</th>
					<th>2</th>
					<th>3</th>
					<th>4</th>
					<th>5</th>
			</thead>
			<tbody>
				@foreach ($encuesta->preguntas as $pregunta)
					<tr>
				    <td>{{$pregunta->enunciado}}</td>
				    <td>{{$docente->responden(0, $curso->id, $pregunta->id)}}</td>
				    <td>{{$docente->responden(1, $curso->id, $pregunta->id)}}</td>
				    <td>{{$docente->responden(2, $curso->id, $pregunta->id)}}</td>
				    <td>{{$docente->responden(3, $curso->id, $pregunta->id)}}</td>
				    <td>{{$docente->responden(4, $curso->id, $pregunta->id)}}</td>
				    <td>{{$docente->responden(5, $curso->id, $pregunta->id)}}</td>
				    </tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="table-responsive">
		<table class="table">
			<caption>
				<h3>
					<strong>Docente: {{ $docente->nombre }} {{ $docente->apellido }}</strong><br>
					Curso: {{ $curso->nombre }}<br>
					Encuestados: {{ $cantidad }}
				</h3>
			</caption>
			<thead>
				<tr>
					<th>Pregunta</th>
					<th>N/C</th>
					<th>1</th>
					<th>2</th>
					<th>3</th>
					<th>4</th>
					<th>5</th>
			</thead>
			<tbody>
				@foreach ($encuesta->preguntas as $pregunta)
					<tr>
				    <td>{{$pregunta->enunciado}}</td>
				    <td>{{$docente->porcentaje(0, $curso->id, $pregunta->id)}}</td>
				    <td>{{$docente->porcentaje(1, $curso->id, $pregunta->id)}}</td>
				    <td>{{$docente->porcentaje(2, $curso->id, $pregunta->id)}}</td>
				    <td>{{$docente->porcentaje(3, $curso->id, $pregunta->id)}}</td>
				    <td>{{$docente->porcentaje(4, $curso->id, $pregunta->id)}}</td>
				    <td>{{$docente->porcentaje(5, $curso->id, $pregunta->id)}}</td>
				    </tr>
				@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>