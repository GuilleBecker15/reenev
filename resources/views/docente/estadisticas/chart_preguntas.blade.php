<script type="text/javascript">

// Load the Visualization API and the corechart package.
google.charts.load('current', {'packages':['corechart']});

// Set a callback to run when the Google Visualization API is loaded.
google.charts.setOnLoadCallback(drawChart);

// Callback that creates and populates a data table,
// instantiates the pie chart, passes in the data and
// draws it.

function drawChart() {

    // Create the data table.

    var data = google.visualization.arrayToDataTable([
        ['Puntaje', 'No corresponde', 'Muy mal', 'Mal', 'Normal', 'Bien', 'Muy bien', { role: 'annotation' } ],
    	@foreach ($encuesta->preguntas as $pregunta)
        ['{{$pregunta->enunciado}}',
        {{$docente->responden(0, $curso->id, $pregunta->id)}},
        {{$docente->responden(1, $curso->id, $pregunta->id)}},
        {{$docente->responden(2, $curso->id, $pregunta->id)}},
        {{$docente->responden(3, $curso->id, $pregunta->id)}},
        {{$docente->responden(4, $curso->id, $pregunta->id)}},
        {{$docente->responden(5, $curso->id, $pregunta->id)}}, ''],
        @endforeach
    ]);

    var chartwidth = $('#chartparent').width();

    var options = {
    	title: '{{$curso->nombre}} (semestre {{$curso->semestre}})',
        isStacked: 'percent',
        is3D: true,
        width: chartwidth,
        height: 480, 
        legend: {position: 'top', maxLines: 60},
        hAxis: {
            minValue: 0,
            ticks: [0, .25, .50, .75, 1]
        }
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(
    	document.getElementById("chart_div_{{$encuesta->id}}{{$curso->id}}"));
    chart.draw(data, options);

}
</script>