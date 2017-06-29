<!DOCTYPE html>
<html>

<head>
	<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.2/jspdf.plugin.autotable.js"></script>
    <title>Exportar a PDF</title>
</head>

<body style="display: none">

	<!-- Informacion que va a ser escrita (excepto las tablas) -->
	@include('docente.estadisticas.pdf_informacion')        
    
    <script type="text/javascript">

    	var estilo = {
	        headerStyles: {
	            fillColor: [30, 144, 255],
	        },
    	};

	    var doc = new jsPDF('p', 'pt');

    	var specialElementHandlers = {
    		'DIV to be rendered out': function (element, renderer) {
    			return true;
    		}
    	};

    	doc.fromHTML($('#informacion').get(0), 39, 240, {
    		'width': 240, 'elementHandlers': specialElementHandlers
    	});
		
		doc.setDrawColor(112, 128, 144); // draw red lines
		doc.line(240+39+39, 642, 240+39+39, 264); // vertical line

    	doc.addPage();

    	// Tabla de referencias

	    var columns_referencia = ["Puntaje", "Significado"];
		var rows_referencia = [
		    [0,"No corresponde"],
		    [1,"Muy mal"],
		    [2,"Mal"],
		    [3,"Normal"],
		    [4,"Bien"],
		    [5,"Muy bien"], ];
		doc.autoTable(columns_referencia, rows_referencia, estilo);
   		doc.addPage();

		// Tabla de numero de respuestas
	
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
		doc.autoTable(columns_numeros, rows_numeros, estilo);
		doc.addPage();

		// Tabla de porcentaje de respuestas

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
		doc.autoTable(columns_porcentajes, rows_porcentajes, estilo);
	
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
	
		var algo = doc.save(semestre_curso+"_"+nombre_apellido+"_"+marca_tiempo+'.pdf');
		console.log(algo);
		// window.close();	
    <!-- </script> -->

</body>

</html>