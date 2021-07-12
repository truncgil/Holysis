<form action="?ajax=chart-down-setup" class="seri" ajax=".pie-ajax<?php echo e($id); ?>" method="post">
<input type="hidden" name="id" value="<?php echo e($id); ?>" />
<input type="hidden" name="table" value="<?php echo e($table); ?>" />
<input type="hidden" name="type" value="<?php echo e($type); ?>" />
<input type="hidden" name="module" value="<?php echo e($module); ?>" />
<?php echo e(csrf_field()); ?>

	<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
		<input type="text" class="form-control datetimepicker" id="downTime" name="start" value="<?php echo e(get("start")); ?>" placeholder="From" data-week-start="1" data-autoclose="true"
			data-today-highlight="true">
	
		<div class="input-group-prepend input-group-append d-none"> 
			<span class="input-group-text font-w600">-to-</span>
		</div>
		<input type="text" class="form-control datetimepicker" id="downTimeTo" name="end" value="<?php echo e(get("end")); ?>" placeholder="To" data-week-start="1" data-autoclose="true"
			data-today-highlight="true">
		
		<button class="btn btn-primary"><?php echo e(e2("Filter")); ?></button>
	</div> 
</form><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/chart/picker.blade.php ENDPATH**/ ?>