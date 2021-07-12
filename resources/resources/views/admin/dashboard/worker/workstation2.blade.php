<?php if(getisset("w")) {
	$week = get("w");
} else {
	$week = date("W");
} ?>

	<div class="block">
		<div class="block-header">{{e2("Workstation Shift Tonnage Statistics (SAP)")}}
		<div class="pull-right d-none"><input type="number" onchange="$('.workstation-chart').load('?ajax2=admin.dashboard.worker&w='+$(this).val());" name="" min="1" max="52" value="{{$week}}" id="" /> {{".Week)"}}
		</div>
		<div class="pull-right">
			
		</div>
		
		</div>
		<div class="block-content">
		<div class="input-group">
				<select name="Month" id="Month" class="form-control">
					<option value="">{{e2("All Month")}}</option>
				<?php for($k=1;$k<=12;$k++) { ?>
					<option value="{{$k}}">{{$k}}. {{e2("Month")}}</option>
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
			$tonaj = "Rückmeldung [TO]";
			$vardiya = "Arbeitsplatz";
			
			$tonaj = @$j['map'][$tonaj];
			$vardiya = @$j['map'][trim($vardiya)];
		//	e($vardiya);
			$data = array();
			$labels = array();
			//$data["IST"] = 0;
			foreach($j['row'] AS $r) {
				if(isset($r[$tonaj])) {
					
					$tonaj = number($r[$tonaj]);
					
					if(isset($r[$vardiya])) {
					
						if(!isset($data[$r[$vardiya]])) {
							$data[$r[$vardiya]] = 0;
						}
					
						@$data[$r[$vardiya]] +=$tonaj;
						
						//$data["IST"] +=$tonaj;
						array_push($labels,"'{$r[$vardiya]}'");
						
						
					}
				}
			}
			
		}
	//	array_push($labels,"'IST'");
		$d = array();
		//print_r($data);
		foreach($data AS $b) {
			array_push($d,$b);
		}
		$d = implode(",",$d);
		$url = "?ajax=worker-detail";
		
		$data = array(
			array(
				"label"=> "Tonnage",
				"data" =>"$d"
			)
			
		);
		?>
			@include("admin.chart.multi-chart")
		</div>
		
	
</div>