<?php $__env->startSection("title",__('Ana İçerikler')); ?>
<?php $__env->startSection("desc",__('Bu sayfada ana içerikler yer almakta')); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
	<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title"><?php echo e(__('Ana İçerikler')); ?></h3>
            <div class="block-options">
                <div class="block-options-item">
				<div class="input-group">
					
					<select name="" id="" class="types_select form-control">
					<?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<option value="<?php echo e($t->title); ?>"><?php echo e($t->title); ?></option>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</select>
					<div onclick="location.href='<?php echo e(url('admin-ajax/content-add?id=main&type=')); ?>'+$('.types_select').val()" class="input-group-append">
						<button type="button" class="btn btn-secondary"><?php echo e(__('Ekle')); ?></button>
					</div>
					
				</div>
					
                </div>
            </div>
        </div>
	</div>
	<div class="row gutters-tiny draggable sortable">
	<?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<?php echo $__env->make("admin.inc.block", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</div>
	</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/new/contents.blade.php ENDPATH**/ ?>