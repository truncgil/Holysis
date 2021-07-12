<?php echo e($title); ?>

<div class="pie">
<canvas id="pie<?php echo e(($id)); ?>"  height="300"></canvas>
<script>
var ctx = document.getElementById('pie<?php echo e(($id)); ?>').getContext('2d');
var myChart = new Chart(ctx, {
	type: 'pie',
	data: {
		labels: [<?php echo(implode(",",$labels)); ?>],
		datasets: [{
			label: '# <?php echo e(e2("of Percentage")); ?>',
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
		cutoutPercentage:20
		
	}
});
</script>
</div>
<?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/chart/pie.blade.php ENDPATH**/ ?>