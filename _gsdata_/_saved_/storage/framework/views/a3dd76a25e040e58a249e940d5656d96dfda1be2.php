<?php if(getisset("w")) {
	$week = get("w");
} else {
	$week = date("W");
} ?>

	<div class="block">
		<div class="block-header"><?php echo e(e2("Department Worker Statistics")); ?>

		<div class="pull-right"><input type="number" onchange="$('.worker-chart').load('?ajax2=admin.dashboard.worker&w='+$(this).val());" name="" min="1" max="52" value="<?php echo e($week); ?>" id="" /> <?php echo e(".Week)"); ?>

		</div></div>
		<div class="block-content">
		<?php $worker = db("workers")->where("json->KW",$week)->groupBy("json->Department")->get();
		
			$chart = array();
			foreach($worker AS $w) {
				$j = j($w->json);
				$say = db("workers")
					->where("json->Department",$j['Department'])
					->groupBy("json->Head_of_Department")
					->get()->count();
				
				@$chart[$j['Department']]=$say;
			}		
//print_r($chart);	
			$labels = array();
			$values = array();
			foreach($chart AS $a => $d) {
				array_push($labels,"'$a'");
				array_push($values,$d);
			}
		?>
		<?php $id="worker-chart";
		$type="horizontalBar"; 
		$label=__("Working"); 
		$url = "?ajax=worker-detail";
		?>
			<?php echo $__env->make("admin.chart.chart", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
		
	
</div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/dashboard/worker.blade.php ENDPATH**/ ?>