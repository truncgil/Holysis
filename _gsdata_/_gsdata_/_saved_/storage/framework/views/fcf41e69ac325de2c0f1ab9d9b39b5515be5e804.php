<?php use App\Contents;
if(getisset("add")) {
	
	$c = new Contents;
	$c->kid = get("add");
	$c->slug = rand(111111,9999999);
	$c->save();
	
}
$active = 1;
if(getisset("active")) {
	$active = get("active");
}
 ?>

<div class="content">
	<div class="block">
	
		<?php $conf = contents("configrations"); ?>
		<ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">   
		<?php $k=0;  foreach($conf AS $c) {  $k++; ?>
				<li class="nav-item">
					<a class="nav-link <?php if($k==$active): ?> active <?php endif; ?>" href="#<?php echo e($c->slug); ?>"><?php echo e($c->title); ?></a>
				</li>
		<?php } ?>
				
		</ul>
		<div class="block-content tab-content">
				<?php $k=0;  foreach($conf AS $c) {  $k++;  ?>
			
					<div class="tab-pane <?php if($k==$active): ?> active <?php endif; ?>" id="<?php echo e($c->slug); ?>" role="tabpanel">
						 <h4 class="content-heading text-black"><?php echo e(e2($c->title)); ?></h4>
						<div class="row items-push">
							<div class="col-lg-3">
								<p class="text-muted">
									<?php echo e(e2(("All {$c->title} definitions"))); ?>

								</p>
							</div>
							<div class="col-lg-7 offset-lg-1">
							<?php $alt = contents($c->slug); foreach($alt AS $a) { ?>
								<div class="form-group row" id="t<?php echo e($a->id); ?>">
									<div class="col-12">
										<div class="input-group"> 
											<input type="text" class="form-control form-control-lg edit" placeholder="<?php echo e(e2("Title")); ?>"  name="title" id="<?php echo e($a->id); ?>" table="contents"  value="<?php echo e($a->title); ?>">
										<?php if($c->title=="Vacation Days"): ?>
											<input type="date" class="form-control form-control-lg edit" placeholder="<?php echo e(e2("Date")); ?>" name="date" id="<?php echo e($a->id); ?>" table="contents"  value="<?php echo e($a->date); ?>">
										<?php endif; ?>
										<?php if($c->title=="Ofen"): ?>
											<input type="number" class="form-control form-control-lg edit" placeholder="<?php echo e(e2("Min")); ?>" step="any" name="min"  id="<?php echo e($a->id); ?>" table="contents"  max="<?php echo e($a->max); ?>" value="<?php echo e($a->min); ?>">
											<input type="number" class="form-control form-control-lg edit" placeholder="<?php echo e(e2("Max")); ?>" step="any"  name="max" onblur="$(this).next().attr('max',$(this).val()).prop('max',$(this).val());" id="<?php echo e($a->id); ?>" table="contents"  value="<?php echo e($a->max); ?>">
											<input type="date" class="form-control form-control-lg edit" placeholder="<?php echo e(e2("Date")); ?>" name="date" id="<?php echo e($a->id); ?>" table="contents"  value="<?php echo e($a->date); ?>">
										<?php endif; ?>
										<?php if($c->title=="Status"): ?>
											
											<input type="color" class="form-control form-control-lg edit" placeholder="<?php echo e(e2('Color')); ?>"  name="html" id="<?php echo e($a->id); ?>" table="contents"  value="<?php echo e($a->html); ?>">
											<input type="number" class="form-control form-control-lg edit" placeholder="<?php echo e(e2("Notification Timer")); ?>" step="any" name="min"  id="<?php echo e($a->id); ?>" table="contents"  max="<?php echo e($a->max); ?>" value="<?php echo e($a->min); ?>">
											
										<?php endif; ?>
										
										
											<div class="input-group-append">
												<a href="<?php echo e(url('admin/contents/'. $a->id .'/delete')); ?>" ajax="#t<?php echo e($a->id); ?>" teyit="<?php echo e($a->title); ?> <?php echo e(__('are you sure?')); ?>" title="<?php echo e($a->title); ?> <?php echo e(__('Silinecek!')); ?>" class=" btn  btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
													<i class="fa fa-times"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
								<a href="?add=<?php echo e($c->slug); ?>&active=<?php echo e($k); ?>" class="btn btn-primary"><i class="fa fa-plus"></i></a>
								
							</div>
						</div>
					</div>

			   

			<?php } ?>
			<!-- END Security -->
		</div>

</div>
</div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/configration.blade.php ENDPATH**/ ?>