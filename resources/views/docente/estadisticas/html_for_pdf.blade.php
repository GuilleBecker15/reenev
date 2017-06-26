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
	    var columns_referencia = ["Puntaje", "Significado"];
		var rows_referencia = [
		    [0,"No corresponde"],
		    [1,"Muy mal"],
		    [2,"Mal"],
		    [3,"Normal"],
		    [4,"Bien"],
		    [5,"Muy bien"],];
		doc.autoTable(columns_referencia, rows_referencia);
		doc.addPage();
	    @foreach ($encuestas as $encuesta)
	    	@foreach ($cursos as $curso)
			    var columns = ["{{$curso->nombre}}", "0", "1", "2", "3", "4", "5"];
			    var rows = [
			    	@foreach ($encuesta->preguntas as $pregunta)
			        ["{{$pregunta->enunciado}}",
			        "{{$docente->responden(0, $curso->id, $pregunta->id)}}",
			        "{{$docente->responden(1, $curso->id, $pregunta->id)}}",
			        "{{$docente->responden(2, $curso->id, $pregunta->id)}}",
			        "{{$docente->responden(3, $curso->id, $pregunta->id)}}",
			        "{{$docente->responden(4, $curso->id, $pregunta->id)}}",
			        "{{$docente->responden(5, $curso->id, $pregunta->id)}}",],
			        @endforeach
			    ];
			    doc.autoTable(columns, rows);
			    doc.addPage();
		    @endforeach
	    @endforeach
	    doc.save('table.pdf');
    </script>
</body>
</html>
