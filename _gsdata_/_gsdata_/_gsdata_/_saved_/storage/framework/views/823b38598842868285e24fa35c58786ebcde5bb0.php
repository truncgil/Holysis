
<?php $__env->startSection("title","Planning Board Monitor"); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h1><?php echo e(e2("Planning Board Monitor")); ?>

			<div class="float-right" style="margin-top: 10px;">
				<img src="assets/img/logo.svg" alt="" />
			</div>
			</h1>
		</div>
		<div class="col-12">
			
			<div class="planning-board-ajax" id="nav-board"></div>
			<script type="text/javascript">
			$(function(){
				$(".planning-board-ajax").load('?ajax2=admin.type.planning.board');
			//	$("*").unbind();
			});
			</script>
			<style type="text/css">
			.gizle {
				display:none !important;
			}
			* {
				resize:none !important
			}
			
			</style>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/planning-board.blade.php ENDPATH**/ ?>