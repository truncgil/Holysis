
<div class="block-content">
		<div class="table-responsive">
		<?php if(count($query['col'])>0) { ?>
		<table class="table table-striped table-bordered table-hover">
		
			<thead>
				<tr>
				<?php foreach($query['col'] AS $a) { 
				if($a!="id") {
				?>
					<th class="text-center"><?php echo e($a); ?></th>
				<?php } ?>
				<?php } ?>
					<th><?php echo e(e2("Process")); ?></th>
				</tr>
			</thead>
			<tbody>
			<?php foreach($query['row'] AS $r) { 
			$id = $r->id;
			unset($r->id);
			?>
				<tr id="t<?php echo e($id); ?>">
				<?php
				
				foreach($r AS $a) { ?>
				  <td><?php echo e($a); ?></td>
				<?php } ?>
				<td><a href="<?php echo e(url('admin-ajax/delete-row?id='.$id.'&table='.$query['table'])); ?>" teyit="<?php echo e(e2("Are you sure delete this item?")); ?>" ajax="#t<?php echo e($id); ?>" class="btn btn-primary"><i class="fa fa-times"></i></a></td>
			
				</tr>
			<?php } ?>
			</tbody>
		</table>
		<?php echo e($query['links']); ?>

		<?php } else { 
			bilgi("No results found");
		} ?>
		
		</div>
	</div>
<script type="text/javascript">
$(function(){
	$("[rel='next'],[rel='prev']").on("click",function(){
		var parent = $(this).parent().parent().parent().parent().parent().parent();
		var ajax = parent.attr("ajax2");
		var url = $(this).attr("href").split("?");
		console.log(url);
		if(ajax!=undefined) {
			console.log(ajax);
			parent.load("<?php echo e(url('admin?ajax2=')); ?>"+ajax+"&"+url[1]);
		}
		return false;
	});
	 $("[teyit]").on("click",function(){
		 $("#modal-popin .block-title").html($(this).attr("title")); 
		 $("#modal-popin .block-content").html($(this).attr("teyit")); 
		$("#modal-popin .modal-dialog").removeClass("modal-lg"); 
		 $(".modal-footer").show();
			 var ajax = $(this).attr("ajax");
			 var url = $(this).attr("href");
			 if(ajax==undefined) {
				$("#modal-popin .tamam").prop("href",url).removeAttr("data-dismiss");  
			 } else {
				 console.log(ajax);
				 $("#modal-popin .tamam").on("click",function(){
					 $(ajax).fadeOut();
					  $.get(url,function(){
						 
						 
					 });
				 });
				
			 }
			 
			 $("#modal-popin").modal(); 
			 return false;
			  
		  });
});
</script><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/inc/table-list.blade.php ENDPATH**/ ?>