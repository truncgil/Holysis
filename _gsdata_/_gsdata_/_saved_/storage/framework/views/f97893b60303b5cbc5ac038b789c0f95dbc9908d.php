
<div class="chart" id="container" >
	<canvas id="<?php echo e($type); ?><?php echo e(($id)); ?>"></canvas>
</div>
<div id="ajax<?php echo e($type); ?><?php echo e(($id)); ?>"></div>
<script>
var ctx = document.getElementById('<?php echo e($type); ?><?php echo e(($id)); ?>').getContext('2d');
var myChart = new Chart(ctx, {
	type: '<?php echo e($type); ?>',
	data: {
		labels: [<?php echo(implode(",",$labels)); ?>],
		datasets: [{
			label: '# <?php echo e($label); ?>',
			
			data: [<?php echo(implode(",",$values)); ?>],
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
			borderWidth: 1
		}]
	},
	options: {
		responsive:true,
		onClick: function(evt, element) {
			  var activePoints = myChart.getElementAtEvent(evt);
			  var label = activePoints[0]._model.label
			  $("#ajax<?php echo e($type); ?><?php echo e(($id)); ?>").load("<?php echo e($url); ?>&label="+encodeURI(label));
		}
	}
});
</script>

<?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/chart/chart.blade.php ENDPATH**/ ?>