<div class="content">
		<div class="row">
		<?php $type = db("types")->where("kid","communication-exchange")->orderBy("s","ASC")->get();
		foreach($type AS $t) {
		?>
		<div class="col-6 col-lg-3 text-center">
			<div class="block">
				<a href="<?php echo e(url('admin/types/'.$t->slug)); ?>">
					<i class="fa fa-<?php echo e($t->icon); ?> fa-4x content-icon"></i>
					<h3><?php echo e($t->title); ?></h3>
					<div class="block-footer"></div>
				</a>
			</div>
		</div>
		<?php } ?>
		</div>
		
	
</div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/communication-exchange.blade.php ENDPATH**/ ?>