<?php if(getisset("sap-parser")) {
	$dosya_adi = upload("file","csv");
	$dosya = file_get_contents($dosya_adi);
	$dizi = explode("\n",$dosya);
	$k=0;
//	print_R($dizi); exit();
	$sap = array();
	$map = array();
	foreach($dizi AS $r) { 
		$c = explode(";",$r);
		$sap['row'][$k] = array();
		if($k==0) {
			$sap['col'] = array();	
			 $z=0;
			foreach($c AS $a) { 
				array_push($sap['col'],$a);
				$map[$a] = $z;
				$z++;
			} 
		} else {
			foreach($c AS $a) { 
				if(is_float ($a)) {
					array_push($sap['row'][$k],eval($a));
				} else {
					array_push($sap['row'][$k],($a));
				}
				
			}	
		}
		
		$k++; 
	}
	$sap['map'] = $map;
	//print_r($sap);
	$json = json_encode($sap);
	//echo $json;
	
	if(is_json($json)) {
		ekle(array(
		"title" => $dosya_adi,
		"json" => $json
		),"sap"); 
		bilgi("$k Parse Operation is Success!");
	} else {
		bilgi("CSV Parse Error!");
	}
	
	////exit();
	
} ?>

<h3><?php echo e(e2("SAP Parser")); ?></h3>
<form action="?sap-parser&active=4" enctype="multipart/form-data" method="post">
	<?php echo e(csrf_field()); ?>

	<?php echo e(e2("Select CSV File:")); ?>

	<div class="input-group">
	<input type="file" name="file" required id="" class="form-control" />
	
	<button class="btn btn-primary"><?php echo e(e2("Engine")); ?></button>
	</div>
	<br />
	<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				<tr>
					<th><?php echo e(e2("Created Date")); ?></th>
					<th><?php echo e(e2("File")); ?></th>
					<th><?php echo e(e2("Count")); ?></th>
					<th><?php echo e(e2("Operation")); ?></th>
				</tr>
				<?php $sap = db("sap")->orderBy("id","DESC")->get(); foreach($sap AS $s) { 
				$j = json_decode($s->json,true);;
				?>
				<tr id="t<?php echo e($s->id); ?>">
					<td><?php echo e($s->created_at); ?></td>
					<td><?php echo e($s->title); ?></td>
					<td><?php echo e(count($j['row'])); ?></td>
					<td>
						<div class="btn btn-primary ajax_modal" title="<?php echo e($s->created_at); ?> / <?php echo e($s->title); ?>" href="?ajax=sap-detail&id=<?php echo e($s->id); ?>"><i class="fa fa-table"></i></div>
						<a href="?ajax=delete-row&table=sap&id=<?php echo e($s->id); ?>" ajax="#t<?php echo e($s->id); ?>" teyit="<?php echo e(e2("Are you sure delete?")); ?>" class="btn btn-danger"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				<?php } ?>
			</table>
	</div>
</form>

<?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/key-figures/sap.blade.php ENDPATH**/ ?>