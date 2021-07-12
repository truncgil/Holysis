<?php
if(getisset("process")) {
	?>
	<script type="text/javascript">

	$(function(){
		$("#nav-board").load("?ajax2=admin.type.planning.board&w=<?php echo e(get("w")); ?>",function(){
			$("#process-modal").removeClass("modal");
			$("#process-modal .modal-dialog").removeClass("modal-dialog");
			$("#process-modal .modal-content").removeClass("modal-content");
			$(".planning-board, #page-header,.bg-image,.navigation,.process-list-button,.process-external").hide();
			//$("#sidebar").remove();
			$("#page-container").attr("class","");
		//	$(".content-header-section .fa-bars").parent().trigger("click");
		$("#process-modal").modal({
			backdrop:false
		});
		$("title").html("<?php echo e(e2("Process List")); ?>");
		/*
		window.setInterval(function(){
			
			$("[jid]").unbind();
			$("[jid]").on("dblclick",function(e){
				e.preventDefault();
				console.log("job dblclick");
			
				localStorage.setItem("job", $(this).attr("jid"));
				localStorage.setItem("current_page", $(".paginate_button.current").text());
				return false;
			});
		},1000);
		*/
		
		});
	});
	</script>
	<style type="text/css">
	 .modal-lg{
		width:100% !important;
		max-width:100% !important;
	}
	.table-responsive {
		max-height:initial !important;
	}
	body {
		overflow:auto !important;
	}
	</style>
	<div id="nav-board"></div>
	<?php
	
} else {
	?>
	<script type="text/javascript">
	window.setInterval(function(){ //diğer pencereden gelen mesajı dinlemek için 
		var refresh = localStorage.getItem("refresh");
		var git = localStorage.getItem("git");
		var w = localStorage.getItem("w");
		var go = localStorage.getItem("goto");
		console.log(refresh);
		console.log(w);
		console.log(go);
		
		if(refresh==="true") {
			console.log("refresh board");
			//$('.btn[value="'+w+'"]').trigger("click");
			loader();
			localStorage.setItem("refresh","false");
		}
		
		if($("."+go+":eq(0)").length>0) {
			$(".table-responsive").scrollLeft(0);
			var poz = $("."+go+":eq(0)").offset().left;
			console.log("poz="+poz);
		//	if(poz>301) {
				
				$(".table-responsive").animate({
					scrollLeft:poz-300
				});
		//	}
				for(k=1;k<=3;k++) {
					$("."+go).fadeOut(100);
					$("."+go).fadeIn(100);	
				}
			
			localStorage.setItem("goto","null");
		}
	},1000);

	</script>
	<?php
$active = 1;
if(getisset("active")) {
	$active = get("active");
}
?>
<?php if(getisset("new-board")) {
	ekle(array(
		"title" => date("d.m.Y H:i") . " - Planning Board",
		"type"=>get("new-board"),
		"json" => json_encode(array())
		),"planning-board"); 
?>
<script type="text/javascript">
$(function(){
	
	$("#workstation-select").val("<?php echo e(get("w")); ?>");
		//	$(".planning-board td:lt(10)").hide();
	$("#nav-board").load("?ajax2=admin.type.planning.board",function(){
		$("[value='<?php echo e(get("new-board")); ?>']").trigger("click");
	});
});
</script>
<?php
} ?>

<script type="text/javascript">
$(function(){
	
	
	
	$.ajaxSetup ({
		cache: false,
		success: function(result){
			
		},
		beforeSend: function(){
			$(".load-zone").removeClass("d-none");
		}
	});
	$( document ).ajaxComplete(function() {
		$(".load-zone").addClass("d-none");
	});
});
</script>
<div class="load-zone d-none" style="position:fixed;top:50px;right:20px; width:200px">
	<div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
		<span class="progress-bar-label"><?php echo e(e2("Please Wait")); ?></span>
	</div>
</div>
<div class="content">
	<div class="block">
		
			<ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link <?php if(1==$active): ?> active <?php endif; ?>" onclick="$('#nav-board').load('?ajax2=admin.type.planning.board')" href="#nav-board"><?php echo e(e2("Planning Board")); ?></a>
				</li>
				
				<li class="nav-item">
					<a class="nav-link <?php if(2==$active): ?> active <?php endif; ?>" href="#nav-sap">
						<?php echo e(e2("SAP")); ?>

					</a>
				</li>
			</ul>
			<div class="block-content tab-content">
				<div class="tab-pane <?php if(1==$active): ?> active <?php endif; ?>" id="nav-board" role="tabpanel">
					
						
					
				</div>
				<div class="tab-pane <?php if(2==$active): ?> active <?php endif; ?>" id="nav-sap" role="tabpanel">
					
						<?php echo $__env->make("admin.type.planning.sap", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					  
				</div>
			</div>
		
	</div>
</div>
<?php } ?><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/planning.blade.php ENDPATH**/ ?>