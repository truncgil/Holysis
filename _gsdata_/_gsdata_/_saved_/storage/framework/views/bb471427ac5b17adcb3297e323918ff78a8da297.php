<?php if(getisset("w")) {
	$week = get("w");
} else {
	$week = date("W");
} ?>

	<div class="block">
		<div class="block-header"><?php echo e(e2("Workstation Shift Tonnage Statistics (SAP)")); ?>

		<div class="pull-right d-none"><input type="number" onchange="$('.workstation-chart').load('?ajax2=admin.dashboard.worker&w='+$(this).val());" name="" min="1" max="52" value="<?php echo e($week); ?>" id="" /> <?php echo e(".Week)"); ?>

		</div>
		<div class="pull-right">
			
		</div>
		
		</div>
		<div class="block-content">
		<div class="input-group">
				<select name="Month" id="Month" class="form-control">
					<option value=""><?php echo e(e2("All Month")); ?></option>
				<?php for($k=1;$k<=12;$k++) { ?>
					<option value="<?php echo e($k); ?>"><?php echo e($k); ?>. <?php echo e(e2("Month")); ?></option>
				<?php } ?>
				</select>
				<button class="btn btn-primary" onclick="$('#workstation').load('?ajax2=admin.dashboard.worker.workstation&m='+$('#Month').val());"><i class="fa fa-calculator"></i></button>
			</div>
		<?php $id="workstation-chart";
		$type="bar"; 
		$sap = db("sap");
		//	->where("json->Sorte",)
		if(!getesit("m","")) {
		//	$sap = $sap->where("MONTH(json->Buchungsdatum",get("m"));
		}
		$sap = $sap->orderBy("id","DESC");
		$sap = $sap->get();
		foreach($sap AS $s) {
			$j = j($s->json);
			//print_r($j['map']); exit();
			$deger = "Rückmeldung [TO]";
			$vardiya = "Arbeitsplatz";
			
			$deger = @$j['map'][$deger];
			$vardiya = @$j['map'][trim($vardiya)];
		//	e($vardiya);
			$data = array();
			$labels = array();
			//$data["IST"] = 0;
			$k = 0;
			foreach($j['row'] AS $r) {
			//	echo "$vardiya ";
				//print_r(@$r[$deger]);
				//print_r(@$r[$vardiya]);
				
				$k++;
				$etiket2 = @$r[$vardiya];
				$etiket = "";
				$table= "";
				if(strpos($etiket2,"HAND")!==false) {
					$etiket = "Handformerei";
					$table = "rq-handformerei";
				}
				if(strpos($etiket2,"P-SA")!==false) {
					$etiket = "SilikaPR";
					$table = "rq-silika";
				}
				if(strpos($etiket2,"P-SI")!==false) {
					$etiket = "SchamottePR";
					$table = "rq-schamotte";
				}
				if($etiket!="") {
					@$data[$etiket] += str_replace(",",".",@$r[$deger]);
					$l ="'".$etiket."'";
					if(!in_array($l,$labels)) {
						array_push($labels,$l);
					}	
				}
				
				
				//if($k==10) break;
			}
			
		}
		$d2 = array(); 
		$tablolar = explode(",","rq-handformerei,rq-silika,rq-schamotte");
		foreach($tablolar AS $t) {
			$sorgu = db($t)->get();
			foreach($sorgu AS $s) {
				$j = j($s->json);
				@$d2[$t] += $j['Tonnage'];
			//	print_r($j); exit();
			}
			
		}
		
	//	array_push($labels,"'IST'");
		$d = array(); 
		$data2 = array(); 
		
	//	print_r($data);
		foreach($data AS $b) {
			if(!in_array("'$b'",$d)) {
				array_push($d,"'$b'");
			}
			
		}
		foreach($d2 AS $b) {
			if(!in_array("'$b'",$d2)) {
				array_push($data2,"'$b'");
			}
			
		}
		$d = implode(",",$d);
		$data2 = implode(",",$data2);
		$url = "?ajax=worker-detail";
		
		$data = array(
			array(
				"label"=> _("SAP Tonnage"),
				"data" =>"{$data['SilikaPR']},{$data['SchamottePR']},{$data['Handformerei']}"
			),
			array(
				"label"=> _("APP Tonnage"),
				"data" =>"{$d2['rq-silika']},{$d2['rq-schamotte']},{$d2['rq-handformerei']}"
			)
			
		);
		?>
			<?php echo $__env->make("admin.chart.multi-chart", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		</div>
		
	
</div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/dashboard/worker/workstation.blade.php ENDPATH**/ ?>