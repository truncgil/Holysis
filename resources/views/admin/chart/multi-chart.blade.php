
<div class="chart" id="container" >
	<canvas id="{{$type}}{{($id)}}"></canvas>
</div>
<div id="ajax{{$type}}{{($id)}}"></div>
<script>
<?php 
$multi = array();
foreach($data AS $a) {
	
	 array_push($multi,"
{
			label: '{$a['label']}',
			
			data: [{$a['data']}],
			backgroundColor: [
				'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(100, 68, 255, 0.2)',
                'rgba(200, 78, 255, 0.2)',
                'rgba(145, 32, 255, 0.2)',
                'rgba(98, 99, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
			],
			borderColor: [
				'rgba(255, 99, 132, 0.3)',
                'rgba(54, 162, 235, 0.3)',
                'rgba(255, 206, 86, 0.3)',
                'rgba(75, 192, 192, 0.3)',
                'rgba(153, 102, 255, 0.3)',
                'rgba(100, 68, 255, 0.3)',
                'rgba(200, 78, 255, 0.3)',
                'rgba(145, 32, 255, 0.3)',
                'rgba(98, 99, 255, 0.3)',
                'rgba(255, 159, 64, 0.3)'
			],
			borderWidth: 1
		}

");
	
}
$multi = implode(",",$multi);
 ?>
var ctx = document.getElementById('{{$type}}{{($id)}}').getContext('2d');
var myChart = new Chart(ctx, {
	type: '{{$type}}',
	data: {
		labels: [<?php echo(implode(",",$labels)); ?>],
		datasets: [<?php echo($multi) ?>]
	},
	options: {
		responsive:true,
		onClick: function(evt, element) {
			  var activePoints = myChart.getElementAtEvent(evt);
			  var label = activePoints[0]._model.label
			  $("#ajax{{$type}}{{($id)}}").load("{{$url}}&label="+encodeURI(label));
		}
	}
});
</script>

