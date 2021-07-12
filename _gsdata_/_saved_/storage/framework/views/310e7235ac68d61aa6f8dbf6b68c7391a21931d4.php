<?php $week = date("W");
	if(getisset("w")) {
		$week = get("w");
	}
	$db = db("workers")->whereJsonContains("json->KW","$week")->orderBY("id","DESC")->simplePaginate(8);
	$query = dbJson($db,"workers");
	 ?>
	 <br />
<a name="list"></a>
<div class="block">
	<div class="block-header block-header-default">
		<h3 class="block-title">
			<div class="input-group">
				<input type="number" name="week" value="<?php echo e($week); ?>" class="form-control col-1 text-center" onchange="$('.workers-result').load('<?php echo e(url('admin?ajax2=admin.type.key-figures.list.workers&w=')); ?>'+$(this).val())"  id="" />
				<div class="input-group-append">.<?php echo e(e2("Week Workers Table")); ?></div>
			</div>
		</h3>
	</div>
	
	
	<?php echo $__env->make("admin.inc.table-list", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
	
</div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/key-figures/list/workers.blade.php ENDPATH**/ ?>