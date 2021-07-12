<?php $tab = explode(",","schamotte,silika,handformerei,mass-mortel");
$path = "admin.type.requirements.list";
foreach($tab AS $t) {
	if(getisset("$t-add")) {
		ekle(array(
			"json" => json_encode_tr($_POST)
		),"rq-".$t);
		?>
		<?php echo $__env->make("$path.$t", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php
		exit();
	}
}
 ?>
<?php $path = "admin.type.requirements"; ?>
<div class="content">
	<div class="block">

			<ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">   
				<li class="nav-item">
					<a class="nav-link active"  onclick="$('.silika-ajax').load('?ajax2=<?php echo e($path); ?>.list.silika');" href="#silica"><?php echo e(e2("SilikaPR")); ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link"  onclick="$('.schamotte-ajax').load('?ajax2=<?php echo e($path); ?>.list.schamotte');"  href="#chamotte"><?php echo e(e2("SchamottePR")); ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link"  onclick="$('.handformerei-ajax').load('?ajax2=<?php echo e($path); ?>.list.handformerei');"  href="#handformerei"><?php echo e(e2("Handformerei")); ?></a>
				</li>
				<li class="nav-item">
					<a class="nav-link"  onclick="$('.mass-mortel-ajax').load('?ajax2=<?php echo e($path); ?>.list.mass-mortel');"  href="#mass-mortel"><?php echo e(e2("Mass & Mörtel")); ?></a>
				</li>
				

			</ul>
			
			<div class="block-content tab-content">
				<div class="tab-pane active" id="silica" role="tabpanel">
					<?php echo $__env->make("$path.silika", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				<div class="tab-pane" id="chamotte" role="tabpanel">
					<?php echo $__env->make("$path.schamotte", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				<div class="tab-pane" id="handformerei" role="tabpanel">
					<?php echo $__env->make("$path.handformerei", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				<div class="tab-pane" id="mass-mortel" role="tabpanel">
					<?php echo $__env->make("$path.mass-mortel", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				

			</div>
		</div>

</div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/requirements.blade.php ENDPATH**/ ?>