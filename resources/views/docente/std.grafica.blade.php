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
        ['Marca los objetivos específicos de cada clase', 10, 24, 20, 32, 18, 5, ''],
        ['Explica en clase con orden y claridad', 16, 22, 23, 30, 16, 9, ''],
        ['Define el vocabulario técnico o específico que utiliza', 28, 19, 29, 30, 12, 13, ''],
        ['Sintetiza y subraya los conceptos que considera importantes', 10, 24, 20, 32, 18, 5, ''],
        ['Establece coAnexiones con contenidos de otras asignaturas', 16, 22, 23, 30, 16, 9, ''],
        ['Hace buen uso de pizarra, o herramientas tecnológicas', 28, 19, 29, 30, 12, 13, ''],
        ['Favorece el planteo de preguntas y se preocupa por responderlas', 10, 24, 20, 32, 18, 5, ''],
        ['Motiva al estudiante por la asignatura', 16, 22, 23, 30, 16, 9, ''],
        ['Cumple con los horarios de clase', 28, 19, 29, 30, 12, 13, ''],
        ['Tiene una actitud respetuosa hacia los estudiantes', 10, 24, 20, 32, 18, 5, ''],
        ['Juicio global del docente', 16, 22, 23, 30, 16, 9, ''],
    ]);

    var chartwidth = $('#chartparent').width();

    var options = {
        isStacked: 'percent',
        width: chartwidth,
        height: 450, 
        legend: {position: 'top', maxLines: 6},
        hAxis: {
            minValue: 0,
            ticks: [0, .25, .50, .75, 1]
        }
    };

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.BarChart(document.getElementById("chart_div_{{}}"));
    chart.draw(data, options);

}
</script>