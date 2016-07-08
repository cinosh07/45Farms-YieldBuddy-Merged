
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type='text/javascript'>
google.charts.load('current', {'packages':['annotationchart']});

function drawChart() {
	var data = new google.visualization.DataTable();
	data.addColumn('datetime', 'Date');
	data.addColumn('number', 'Temperature');
	data.addColumn('number', 'RH');

    <?php
		echo "data.addRows([";
		$rownum=0;
			while ($rownum < sizeof($Time_array)) {
				if ($rownum == (sizeof($Time_array) - 1)) {
					echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $Temp_array[$rownum] . "," . $RH_array[$rownum] . "]\n";
				} else {
						echo "[new Date('" . $parsed_year[$rownum] . "','" . ($parsed_month[$rownum] - 1) . "','" . $parsed_day[$rownum] . "','" . $parsed_hour[$rownum] . "','" . $parsed_min[$rownum] . "','" . $parsed_sec[$rownum] . "')," . $Temp_array[$rownum] . "," . $RH_array[$rownum] . "],\n";
				}
				$rownum = $rownum + 1;
			}
		echo "]);";
	?>
	
  var options = {
		displayAnnotations: false,
		title: "Test",
		'colors': ["#6633FF", "#FF5353", "#66FF00"],
    'thickness': 2,
    'zoomStartTime': new Date((new Date()).getTime() - 1 * 24 * 60 * 60 * 1000),
    chart: {
			backgroundColor: 'white', // for the area outside the chartArea
			chartArea: {
				backgroundColor: '#DEB19E'
			}
		}			
	};
	
	var chart = new google.visualization.AnnotationChart(
			document.getElementById('Temperature_Chart'));
  chart.draw(data, options);
	
}
	
google.charts.setOnLoadCallback(drawChart);

</script>