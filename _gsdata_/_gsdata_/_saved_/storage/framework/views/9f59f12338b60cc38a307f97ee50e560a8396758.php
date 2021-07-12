<?php $__env->startSection("title"); ?>
	<?php echo e(e2("Dashboard")); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

		<div class="content">
			
			<div class="row">
				
				<?php echo $__env->make("admin.dashboard.down-setup", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			<div class="row">
				<div class="col-12 col-lg-6 worker-chart">
					<?php echo $__env->make("admin.dashboard.worker", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				<div class="col-12 col-lg-6 workstation-chart">
					<?php echo $__env->make("admin.dashboard.workstation", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
			</div>
				
				
			
		</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/index.blade.php ENDPATH**/ ?>