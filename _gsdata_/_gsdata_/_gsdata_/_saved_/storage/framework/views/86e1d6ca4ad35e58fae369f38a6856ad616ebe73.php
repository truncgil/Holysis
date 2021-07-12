<?php 


	$db = db("rq-handformerei")->orderBy("id","DESC")->simplePaginate(8);
	$query = dbJson($db,"rq-handformerei");
	 ?>
	 <br />
<a name="list"></a>
<div class="block">
	<div class="block-header block-header-default">
		<h3 class="block-title">
			<?php echo e(e2("Handformerei List")); ?>

		</h3>
	</div>
	
	
	<?php echo $__env->make("admin.inc.table-list", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
	
</div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/requirements/list/handformerei.blade.php ENDPATH**/ ?>