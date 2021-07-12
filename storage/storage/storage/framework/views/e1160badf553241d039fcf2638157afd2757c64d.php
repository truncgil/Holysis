<div class="content">
 

            <?php 
            $level = u()->level;
            if($level=="Admin") {
 ?>
 <?php echo $__env->make("admin.type.hastalar.admin", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php 
            } else {
 ?>
  <?php echo $__env->make("admin.type.hastalar.doktor", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
 <?php 
            }
            ?>

  
</div><?php /**PATH /home/sphyzer/app/resources/views/admin/type/hastalar.blade.php ENDPATH**/ ?>