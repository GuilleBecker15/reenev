<!DOCTYPE html>
<html>
<head>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.2/jspdf.plugin.autotable.js"></script>
	<title></title>
</head>
<body>
	<script type="text/javascript">
		var columns = ["ID", "Name", "Country"];
		var rows = [
		    [1, "Shaw", "Tanzania"],
		    [2, "Nelson", "Kazakhstan"],
		    [3, "Garcia", "Madagascar"],
		];
		// Only pt supported (not mm or in)
		var doc = new jsPDF('p', 'pt');
		doc.autoTable(columns, rows);
		doc.save('table.pdf');
	</script>
</body>
</html>