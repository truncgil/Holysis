<form action="?schamotte-add" class="seri" ajax=".schamotte-ajax" method="post">
	<?php echo e(csrf_field()); ?>

	<div class="">
			<?php echo e(e2("Month Number:")); ?>

			<input type="number" name="Month Number" min="1" max="12" id="" class="form-control" />
			<?php echo e(e2("Tonnage:")); ?>

			<input type="number" step="any" name="Tonnage" min="1" id="" class="form-control" />
	</div>
	<br />
	<button class="btn btn-primary"><?php echo e(e2("Save")); ?></button>
</form>
<div class="schamotte-ajax" ajax2="<?php echo e($path); ?>.schamotte"></div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/requirements/schamotte.blade.php ENDPATH**/ ?>