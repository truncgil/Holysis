<?php if(!isset($col)) {
	$col = "col-6 col-md-4 col-lg-2";
} ?>
<div class="<?php echo e($col); ?>" id="t<?php echo e($a->id); ?>" id2="<?php echo e($a->id); ?>">
<form action="<?php echo e(url('admin-ajax/cover-upload')); ?>" id="f<?php echo e($a->id); ?>"  class="d-none" enctype="multipart/form-data" method="post">
							<input type="file" name="cover" id="c<?php echo e($a->id); ?>" onchange="$('#f<?php echo e($a->id); ?>').submit();" required />
							<input type="hidden" name="id" value="<?php echo e($a->id); ?>" />
							<input type="hidden" name="slug" value="<?php echo e($a->slug); ?>" />
							<?php echo e(csrf_field()); ?>

						</form>
			<div class="block main-block  block-rounded block-bordered block-link-shadow text-center" >
				<div class="block-header block-header-default">
					<h3 class="block-title">
						<input type="text" name="title" value="<?php echo e($a->title); ?>" placeholder="<?php echo e(e2("Başlık Giriniz")); ?>" table="contents" id="<?php echo e($a->id); ?>" class="title<?php echo e($a->id); ?> form-control edit" />
					</h3>
					<div class="block-options">
					<a class="btn-block-option d-none" href="<?php echo e(url($a->slug)); ?>" target="_blank" title="<?php echo e(e2("Web'de Gör")); ?>">
							<i class="fa fa-globe"></i>
					</a>
					<a class="btn-block-option ajax_modal" href="<?php echo e(url("admin/contents/".$a->id."?ajax")); ?>" target="_blank" title="<?php echo e($a->title); ?> <?php echo e(e2("Düzenle")); ?>">
							<i class="fa fa-pen"></i>
					</a>
					<a class="btn-block-option d-none" href="<?php echo e(url('admin-ajax/content-duplicate?cid='. $a->id )); ?>"title="<?php echo e($a->title); ?> <?php echo e(__('Çoğalt')); ?>">
							<i class="fa fa-copy"></i>
					</a>
					<a class="btn-block-option" href="<?php echo e(url('admin/contents/'. $a->id .'/delete')); ?>" ajax="#t<?php echo e($a->id); ?>" teyit="<?php echo e($a->title); ?> <?php echo e(__('içeriğini silmek istediğinizden emin misiniz?')); ?>" title="<?php echo e($a->title); ?> <?php echo e(__('Silinecek!')); ?>">
							<i class="fa fa-times"></i>
					</a>
					</div>
				</div>
				<div class="block-content">
					<p class="mt-5">
					<?php if($a->cover!=''): ?>
						<a href="<?php echo e(url('admin/contents/'. $a->id)); ?>"  >
							<img src="<?php echo e(url('cache/small/'.$a->cover)); ?>" alt="" />
						</a>
					
						<?php else: ?>
					<?php foreach($types AS $t) {
						
					if($t->title==$a->type) {
						
						?>
						<a href="<?php echo e(url('admin/contents/'. $a->id)); ?>">
							<i class="fa fa-<?php echo e($t->icon); ?> fa-4x content-icon"></i>
						</a>
					<?php } } ?>
					<?php endif; ?>
					</p>
					<p class="font-size-h1">
						<strong>
							
						</strong>
					</p>
					<p class="font-w600">
					</p>
				</div>
				<div class="mb-10">

					<div class="block-options">
						<div class="btn-group float-left">
						<button type="button" class="btn-block-option" onclick="$('#c<?php echo e($a->id); ?>').trigger('click');" title="<?php echo e(__('Resim Yükle')); ?>"><i class="fa fa-upload"></i></button>
						<?php if($a->cover!=''): ?>
						<a teyit="<?php echo e(__('Resmi kaldırmak istediğinizden emin misiniz')); ?>" title="Resmi kaldır" href="<?php echo e(url('admin-ajax/cover-delete?id='.$a->id)); ?>" class="btn-block-option"><i class="fa fa-times"></i></a>
						<a title="<?php echo e(__('Resmi indir')); ?>" href="<?php echo e(url('cache/download/'.$a->cover)); ?>" class="btn-block-option"><i class="fa fa-download"></i></a>
						<?php endif; ?>
						</div>
						<label class="css-control css-control-sm css-control-primary css-switch" title="<?php echo e(e2("Yayınla/Yayından Kaldır")); ?>">
							<input type="checkbox" class="css-control-input yayinla" id="<?php echo e($a->id); ?>" <?php if($a->y==1): ?>checked=""<?php endif; ?>>
							<span class="css-control-indicator"></span> 
						</label>
						
					</div>
				</div>
			</div>
		</div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/inc/block.blade.php ENDPATH**/ ?>