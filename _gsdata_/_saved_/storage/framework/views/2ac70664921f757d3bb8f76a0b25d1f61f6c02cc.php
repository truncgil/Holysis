<?php $worker = db("workers");
$worker = $worker
->where("json->Department",get("label"))
->where("json->KW",date("W"))
//->groupBy("json->Department")
->groupBy("json->Head_of_Department")
->get();
//print_r($worker);

 ?>
 <script>
$(document).ready(function(){
  $("#worker-search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#worker-table tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<input type="search" name="" id="worker-search" placeholder="<?php echo e(e2("Search...")); ?>" class="form-control" />
 <table  id="worker-table" class="table table-hover table-striped table-bordered">
 <thead>
	<tr>
		<th><?php echo e(e2("Head of Department")); ?></th>
		<th><?php echo e(e2("Employees")); ?></th>
		<th><?php echo e(e2("Temporary Workers")); ?></th>
		<th><?php echo e(e2("Function")); ?></th>
	</tr>
</thead>
<tbody>
	<?php $__currentLoopData = $worker; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $w): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<?php $j = j($w->json); ?>
	<tr>
		<td><?php echo e($j['Head_of_Department']); ?></td>
		<td><?php echo e($j['Employees']); ?></td>
		<td><?php echo e($j['Temporary_Workers']); ?></td>
		<td><?php echo e($j['Function']); ?></td>
	</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</tbody>
 </table><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin-ajax/worker-detail.blade.php ENDPATH**/ ?>