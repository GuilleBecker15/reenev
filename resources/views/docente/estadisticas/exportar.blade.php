<!DOCTYPE html>
<html>
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.2/jspdf.plugin.autotable.js"></script>
    <title></title>
</head>
<body>
    <script type="text/javascript">

	    var doc = new jsPDF('p', 'pt');

	    doc.setTextColor(30, 144, 255);
	    doc.setFontSize(20);
	    doc.text('{{$encuesta->asunto}}', 40, 300);
	    doc.setFontSize(10);
	    doc.setTextColor(100);
	    doc.text('{{$encuesta->descripcion}}', 60, 325);
	    doc.setTextColor(0);
	    doc.setFontSize(15);
		doc.text('Estadisticas para el docente: '+'{{$docente->nombre}} {{$docente->apellido}}', 40, 375);

	    var columns_referencia = ["Puntaje", "Significado"];
		var rows_referencia = [
		    [0,"No corresponde"],
		    [1,"Muy mal"],
		    [2,"Mal"],
		    [3,"Normal"],
		    [4,"Bien"],
		    [5,"Muy bien"], ];
		doc.autoTable(columns_referencia, rows_referencia, {startY: 350, showHeader: 'firstPage'});
		doc.addPage();
	
		var columns_numeros = ["{{$curso->nombre}}", "0", "1", "2", "3", "4", "5"];
		var rows_numeros = [
				@foreach ($encuesta->preguntas as $pregunta)
				    ["{{$pregunta->enunciado}}",
				     "{{$docente->responden(0, $curso->id, $pregunta->id)}}",
				     "{{$docente->responden(1, $curso->id, $pregunta->id)}}",
				     "{{$docente->responden(2, $curso->id, $pregunta->id)}}",
				     "{{$docente->responden(3, $curso->id, $pregunta->id)}}",
				     "{{$docente->responden(4, $curso->id, $pregunta->id)}}",
				     "{{$docente->responden(5, $curso->id, $pregunta->id)}}", ] ,
				@endforeach
			];
		doc.autoTable(columns_numeros, rows_numeros);
		doc.addPage();

		var columns_porcentajes = ["{{$curso->nombre}}", "0", "1", "2", "3", "4", "5"];
		var rows_porcentajes = [
				@foreach ($encuesta->preguntas as $pregunta)
				    ["{{$pregunta->enunciado}}",
				     "{{$docente->porcentaje(0, $curso->id, $pregunta->id)}}%",
				     "{{$docente->porcentaje(1, $curso->id, $pregunta->id)}}%",
				     "{{$docente->porcentaje(2, $curso->id, $pregunta->id)}}%",
				     "{{$docente->porcentaje(3, $curso->id, $pregunta->id)}}%",
				     "{{$docente->porcentaje(4, $curso->id, $pregunta->id)}}%",
				     "{{$docente->porcentaje(5, $curso->id, $pregunta->id)}}%", ] ,
				@endforeach
			];
		doc.autoTable(columns_porcentajes, rows_porcentajes);
	
		var hoy = new Date();
		var year = hoy.getFullYear();
		var month = hoy.getMonth();
		var day = hoy.getDate();
		var hours = hoy.getHours();
		var minutes = hoy.getMinutes();
		var seconds = hoy.getSeconds();
		var semestre_curso = "{{$curso->semestre}}-{{$curso->nombre}}";
		var nombre_apellido = "{{$docente->nombre}}-{{$docente->apellido}}";
		var marca_tiempo = year+"-"+month+"-"+day+"_"+hours+"h"+minutes+"m"+seconds+"s";
	
		doc.save(semestre_curso+"_"+nombre_apellido+"_"+marca_tiempo+'.pdf');
    
    </script>
</body>
</html>
