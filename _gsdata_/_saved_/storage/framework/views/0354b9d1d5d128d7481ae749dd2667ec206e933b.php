
<div class="text-center" style="line-height:100px;"><div class="goto btn btn-primary d-none"><?php echo e(e2("Goto Card On Board")); ?></div></div>
<script type="text/javascript">
$(".goto").on("click",function(){
	localStorage.setItem('goto',"j<?php echo e(get('id')); ?>");
});
<?php if(getesit("w","configration-endbearbeitung")) { ?>
$(".finish2").removeClass("d-none");
<?php } ?>
</script>
<div class="row">
	<div class="col-md-6">
<div class="detail" style="height:400px;overflow:auto">
			<table class="table table-bordered table-hover table-striped">
			<?php $veri = db("sap-planning")->orderBY("id","DESC")->first();
$sap = array();
$j = j($veri->json);
foreach($j['row'] AS $v) {
	

	$sap[$v['ID']] = $v;
}
?>
<?php if(!isset($sap[get("id")])): ?> 
	<div class="alert alert-info"><?php echo e(get("id")); ?> <?php echo e(e2("Not found")); ?></div>
<script type="text/javascript">
$(".delete").removeClass("d-none");
$(".modal-footer .delete").unbind(); 
var id = "<?php echo e(get("id")); ?>";
var secici = '.planning-board .j'+id;
var plan_secici = '.planning-board #j'+id;
var drag_secici = '.drag-data[jid="'+id+'"]';
var secici2 = '.drag-data #j'+id;
$(".modal-footer .delete").on("click",function(){
	
	
	
	console.log(secici);
	$(secici).remove();
	$(drag_secici).html($(plan_secici).parent().html());
	$(plan_secici).remove();
	
	
	$(secici2).show();
	jobEvent();
	$(this).html("All work deleted from plan");
	saveIfProcess();
});
</script>
<?php exit(); ?>
<?php endif; ?>
<?php

$veri = $sap[get("id")];
			?>
			<?php foreach($sap[get("id")] AS $key => $value) { ?>
			<?php if($key=="Color") { ?>
			<tr><td><?php echo e($key); ?></td><td style="background:<?php echo e($value); ?>"></td></tr>
			<?php } else { ?>
			<tr><td><?php echo e($key); ?></td><td><?php echo e($value); ?></td></tr>
			<?php } ?>
			<?php } ?>
			</table>
		</div>
</div>
<div class="col-md-6">

		<?php echo e(e2("Select Shift")); ?>

		<div class="row text-center vardiyalar">

			<div class="col-lg-4">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" name="Schicht[]" class="css-control-input" value="F" checked="">
					<span class="css-control-indicator"></span> <?php echo e(e2("Früh")); ?>

				</label>
			</div>
			<div class="col-lg-4">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" name="Schicht[]" class="css-control-input" value="S" checked="">
					<span class="css-control-indicator"></span> <?php echo e(e2("Spät")); ?>

				</label>
			</div>
			<div class="col-lg-4">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" name="Schicht[]" class="css-control-input" value="N" checked="">
					<span class="css-control-indicator"></span> <?php echo e(e2("Nacht")); ?>

				</label>
			</div>
		</div>
		<div class="select-workstation d-none">
		<?php echo e(e2("Select Workstation")); ?>

		<select name="" id="" class="form-control">
		<?php 
		$w = get("w"); 
		$slugs = explode(",",$w);
			$s = db("contents")->whereIn("slug",$slugs)->orderBy("s","ASC")->first(); ?>
		<?php $alt = db("contents")->where("kid",$s->slug)->get(); ?>
		<?php if(isset($alt)) { ?>
		<?php foreach($alt AS $a) { ?>
				<option value="<?php echo e($a->title); ?>"><?php echo e($a->title); ?></option>
		<?php } ?>
		<?php } ?>
			</select></div>
		<?php echo e(e2("Total")); ?>

		<input type="number" step="any"  name="Bedarfsmenge SD"  class="form-control" readonly disabled required id="BedarfsmengeSD" />
		<?php echo e(e2("How many of this product can be produced in one shift?")); ?>

		<input type="number" step="any" name="qty"  value="" class="form-control" required id="qty" />
		<br />
		<div class="calculate-zone">
			<div class="btn btn-primary" onclick="calculate()"><?php echo e(e2("Calculate")); ?></div>
			<div class="btn-group">
				<div class="btn btn-warning one_shift"></div>
				<div class="btn btn-warning">+</div>
				<div class="btn btn-warning one_shift_kalan"></div>
			</div>
		</div>

	<script type="text/javascript">
	var total = ("<?php echo e($veri[map('Bedarfsmenge SD')]); ?>".replace(".",""));
	$("#qty").val($(".modal-title .title").text().split("/")[0]);
	total = (total.replace(",","."));
	$(".modal-body #BedarfsmengeSD").val(total);
	$(".modal-body #qty").attr("max",total).prop("max",total);
	console.log(total);
	
	
	</script>
	<div class="json-data d-none" style="display:none !important"><?php echo json_encode($veri) ?></div>
	<script type="text/javascript">
function card(id,html,style,qty,miktar,workstation,vardiya) {
var k = 1;
if(vardiya=="" || vardiya===undefined) {
	var secici = $("[workstation='"+workstation+"']:empty");
	console.log("tüm vardiyalar");
} else {
	console.log("bazı vardiyalar");
	vardiyasec = [];
	vardiya.each(function(i,v){
		vardiyasec.push("[workstation='"+workstation+"'][vardiya='"+v+"']:empty")
	});
	console.log("secilen vardiyalar= "+vardiyasec.split(","));
	var secici = $(vardiyasec.split(","));
	
}

if(secici.length<miktar) {
	alert("<?php echo e(e2("Settlement could not be made because the calendar is full. Number of remaining fields: ")); ?>"+secici.length);
} else {
	secici.each(function(){
		console.log("gelen boyut="+miktar);
		if(k<=miktar) {
			$(this).html('<div class="job fill j'+id+'" draggable="true" ondragstart="drag(event)"  jid="'+id+'" style="'+style+'" title="'+qty+'/'+' <?php echo e(e2("Part")); ?> '+k+'">'+html+'<div class="delete"></div></div>');
		}
		k++;
	});
}
}
					var style = $("#j<?php echo e($veri['ID']); ?>").attr("style");
					console.log("style="+style);
					var dizi = JSON.parse($(".json-data").html());
					var json = JSON.stringify(dizi);
					$("#job-detail .modal-body table").html("");
					$.each( dizi, function( key, value ) {
						if(key!="") {
							if(key=="Color") {
								$("#job-detail .modal-body table").append("<tr><td>"+key+"</td><td style='background:"+value+"'></td></tr>");
							} else {
								$("#job-detail .modal-body table").append("<tr><td>"+key+"</td><td>"+value+"</td></tr>");
							}
							
						}
					});
					
					var total = (dizi['<?php echo e(map('Bedarfsmenge SD')); ?>'].replace(".",""));
					total = (total.replace(",","."));
					$(".modal-body #BedarfsmengeSD").val(total);
					$(".modal-body #qty").attr("max",total).prop("max",total);
					console.log(total);
				//	console.log(dizi);
					$(".finish input").unbind(); 
					var bu = $(".j<?php echo e($veri['ID']); ?>");
					if(bu.length==0) {
						bu = $("#j<?php echo e($veri['ID']); ?>");
					} 
					if(bu.attr("checked")!=undefined) {
						$(".finish input").attr("checked","checked");
						$(".finish input").prop("checked",true);
					} else {
						$(".finish input").removeAttr("checked");
						$(".finish input").prop("checked",false);
					}
					$(".finish input").on("click",function(){
						console.log(id);
						if(bu.attr("checked")!=undefined) {
							bu.attr("style",style);
							$(".j"+id).attr("style",style).css("display","block");
							bu.removeAttr("checked");
							
						} else {
							bu.css("background","#9ccc65");
							$(".j"+id).css("background","#9ccc65").css("display","block");
							bu.attr("checked","checked");
							
						}
						window.setTimeout(function(){
							saveIfProcess();
						},0);
						
					});
					window.setTimeout(function(){
						var checked2 = $(".j"+id).attr("checked2");
						console.log("checked2="+checked2);
						if(checked2!==undefined) {
							$(".finish2 input").attr("checked","checked");
							$(".finish2 input").prop("checked",true);
						} else {
							$(".finish2 input").removeAttr("checked");
							$(".finish2 input").prop("checked",false);
						}	
					},500);
					
					$(".finish2 input").unbind();
					$(".finish2 input").on("click",function(){
						console.log("finish2_id="+id);
						var bu = $(".j"+id);
						
						if(bu.attr("checked2")!==undefined) {
							$(".j"+id+" .arrow-left").addClass("d-none");
							$("#j"+id+" .arrow-left").addClass("d-none");
							$(".j"+id).removeAttr("checked2");
							$("#j"+id).removeAttr("checked2");
						
							
							
						} else {
							$(".j"+id+" .arrow-left").removeClass("d-none");
							$("#j"+id+" .arrow-left").removeClass("d-none");
							$(".j"+id).attr("checked2","true");
							$("#j"+id).attr("checked2","true");
						}
						window.setTimeout(function(){
							saveIfProcess();
						},0);
						
						
					});
					var id = dizi['ID'];
					console.log("id "+id);
					if($('.planning-board .j'+id).length>0 || $('.planning-board #j'+id).length>0) { //eğer planlamaya alınan bir işlem varsa
						console.log("bu işlem planlamada var");
						$(".modal-footer .delete").removeClass("d-none");
						$(".goto").removeClass("d-none");
						$(".calculate-zone").addClass("d-none");
						$(".modal-footer .schedule").addClass("d-none");
					} else {
						console.log("bu işlem planlamada yok");
						$(".modal-footer .delete").addClass("d-none");
						$(".goto").addClass("d-none");
						$(".calculate-zone").removeClass("d-none");
					}
					$(".modal-footer .delete").unbind(); 
					var secici = '.planning-board .j'+id;
					var plan_secici = '.planning-board #j'+id;
					var drag_secici = '.drag-data[jid="'+id+'"]';
					var secici2 = '.drag-data #j'+id;
					$(".modal-footer .delete").on("click",function(){
						
						if(confirm("<?php echo e(e2("Are you sure delete this card?")); ?>")) {
							console.log(secici);
							$(secici).remove();
							$(drag_secici).html($(plan_secici).parent().html());
							$(plan_secici).remove();
							
							
							$(secici2).show();
							jobEvent();
							$(this).html("All work deleted from plan");
							window.setTimeout(function(){
								saveIfProcess();	
							},1000);
							
						}
					});
					$(".calculate").unbind();
					$(".calculate").on("click",function(){
						$(".modal-footer .schedule").removeClass("d-none");
					});
					$(".schedule").unbind(); 
					var workstation = dizi['<?php echo e(map('Arbeitsplatz')); ?>'];
						//eğer HAND veya END ise workstation listesini göster
						if(dizi['<?php echo e(map('MRP Contr.')); ?>']=="HF" || dizi['<?php echo e(map('MRP Contr.')); ?>']=="END") {
							$(".select-workstation").removeClass("d-none");
							workstation = $(".select-workstation select").val(); // ilk değeri varsayılan
							$(".select-workstation select").on("change",function(){
								workstation = $(this).val();
								console.log("seçilen workstation: "+workstation);
							});
						} else {
							$(".select-workstation").addClass("d-none");
						}
						
					
					$(".schedule").on("click",function(){
						
						//workstationın ismini alıyoruz
						console.log("seçilen workstation: "+workstation);
						
						var vardiya = $(".vardiyalar [name='Schicht[]']:checked").map(function(){
						  return $(this).val();
						}).get(); 
						var miktar = $(".one_shift").html(); //boyut
						var kalan_miktar = $(".one_shift_kalan").html(); //boyut
						var qty = $("#qty").val(); //boyut
						var yarim_qty = qty/2; // yarım vardiyaya düşen 
						//miktar = miktar -1;
						var miktar2 = miktar;//miktar/vardiya.length;
						
						var vm = vardiya.length;
						console.log("vardiya"+vm);
						console.log("miktar"+miktar);
						console.log(vardiya);
						console.log("html"+bu.html());
						var boyut=miktar*2;
						if(vm==3) { //3 vardiya da seçili demektir o zaman tek parça yap
							console.log("3 vardiya seçildi");
							console.log("boyut" + boyut);
							isaretle(id,json,style,workstation,miktar,boyut,bu.html(),yarim_qty,"");
						} else {
							//card(id,bu.html(),style,yarim_qty,miktar,workstation,vardiya);
							isaretle(id,json,style,workstation,miktar,boyut,bu.html(),yarim_qty,vardiya);
							/*
							return false;
							boyut = boyut / 3;  
							$.each(vardiya,function(key,v){
								
									console.log("checked",v);
									
									isaretle(id,json,style,workstation,miktar,boyut,bu.html(),yarim_qty,v);
								
							});	
							*/
						}
						if(vm==3) {
							
							if(kalan_miktar!=0) { //eğer kalan miktar varsa 
								console.log("kalan miktar");
								console.log(kalan_miktar); 
								var parca = 1;
								if(kalan_miktar>yarim_qty) {
									parca = 2;
									kalan_miktar = kalan_miktar/2;
								} 
								isaretle(id,json,style,workstation,kalan_miktar,parca,bu.html(),kalan_miktar,"");
								
							}
							
						} else {
							if(kalan_miktar!=0) { //eğer kalan miktar varsa 
								console.log("kalan miktar");
								console.log(kalan_miktar); 
								var parca = 1;
								if(kalan_miktar>yarim_qty) {
									parca = 2;
									kalan_miktar = kalan_miktar/2;
								} 
								isaretle(id,json,style,workstation,kalan_miktar,parca,bu.html(),kalan_miktar,vardiya);
								
							}
						}
					//	$(secici2).addClass("onboard");
						
						saveIfProcess();
					}); 

	</script>
	</div>
	</div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin-ajax/planning-detail.blade.php ENDPATH**/ ?>