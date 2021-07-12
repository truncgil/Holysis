<?php $__env->startSection("title",__("Alanlar")); ?>
<?php $__env->startSection("desc",__("Bir türe ait girilen tüm alanların yönetildiği bölüm")); ?>
<?php $__env->startSection('content'); ?>
<div class="content">
	<div class="block">
        <div class="block-header block-header-default">
            <h3 class="block-title">Mevcut Alanlar</h3>
            <div class="block-options">
                <div class="block-options-item">
                </div>
            </div>
        </div>
        <div class="block-content">

	
            <table class="table table-striped table-hover table-bordered table-vcenter">
                <thead>
                    <tr>
                        <th><?php echo e(__("Title")); ?></th>
                        <th><?php echo e(__("Form Tipi")); ?></th>
                        <th><?php echo e(__("İçerik Tipi")); ?></th>
                        <th><?php echo e(__("Ön Tanımlı Değerler")); ?></th>
                    </tr>
                </thead>
                <tbody>
				<?php $__currentLoopData = $fields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
                        <td><?php echo e($a->title); ?></td>
                        <td><input type="text" name="input_type" value="<?php echo e($a->input_type); ?>" table="fields" id="<?php echo e($a->id); ?>" class="form-control  edit" /></td>
                        <td><?php echo e($a->type); ?></td>
                        <td>
						<input type="text" name="values" value="<?php echo e($a->values); ?>" table="fields"  id="<?php echo e($a->id); ?>" class=" js-tags-input form-control edit" /></td>
						
                       
                       
                    </tr>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     
                                    </tbody>
            </table>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/fields.blade.php ENDPATH**/ ?>