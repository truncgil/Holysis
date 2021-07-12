<?php $tab = explode(",","schamottepr,silikapr,handformerei");
$path = "admin.type.mass-orders.list";
foreach($tab AS $t) {
	if(getisset("$t-add")) {
		ekle(array(
			"json" => json_encode_tr($_POST)
		),$t."-mo");
		?>
		<?php echo $__env->make("$path.$t", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php
		exit();
	}
}
 ?>
<?php $path = "admin.type.mass-orders"; ?>
<?php
$active = 1;
if(getisset("active")) {
	$active = get("active");
}
?>
<div class="content">
	<div class="block">

			<ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">   
				<li class="nav-item">
					<a class="nav-link <?php if(1==$active): ?> active <?php endif; ?>"  onclick="$('.SilicaPR-ajax').load('?ajax2=<?php echo e($path); ?>.list.silikapr');" href="#silica">SilikaPR</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if(2==$active): ?> active <?php endif; ?>"  onclick="$('.SchamottePR-ajax').load('?ajax2=<?php echo e($path); ?>.list.schamottepr');"  href="#chamotte">SchamottePR</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?php if(2==$active): ?> active <?php endif; ?>"  onclick="$('.handformerei-ajax').load('?ajax2=<?php echo e($path); ?>.list.handformerei');"  href="#handformerei">Handformerei</a>
				</li>
				

			</ul>
			
			<div class="block-content tab-content">
				<div class="tab-pane active" id="silica" role="tabpanel">
					<?php echo $__env->make("$path.silica", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				<div class="tab-pane" id="chamotte" role="tabpanel">
					<?php echo $__env->make("$path.schamotte", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				<div class="tab-pane" id="handformerei" role="tabpanel">
					<?php echo $__env->make("$path.handformerei", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
				

			</div>
		</div>

</div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/mass-orders.blade.php ENDPATH**/ ?>