<?php if(getisset("w")) {
	$week = get("w");
} else {
	$week = date("W");
} ?>

	<div class="block">
		<div class="block-header">{{e2("Workstation Shift Tonnage Statistics (SAP)")}}
		<div class="pull-right"><input type="number" onchange="$('.workstation-chart').load('?ajax2=admin.dashboard.worker&w='+$(this).val());" name="" min="1" max="52" value="{{$week}}" id="" /> {{".Week)"}}
		</div></div>
		<div class="block-content">
		
		<?php $id="workstation-chart";
		$type="bar"; 
		$sap = db("sap")
		//	->where("json->Sorte",)
			->orderBy("id","DESC")
			->get();
		foreach($sap AS $s) {
			$j = j($s->json);
			//print_r($j['map']); exit();
			$tonaj = "Rückmeldung [TO]";
			$vardiya = "Schicht";
			
			$tonaj = @$j['map'][$tonaj];
			$vardiya = @$j['map'][trim($vardiya)];
			
			$data = array();
			$labels = array();
	
			foreach($j['row'] AS $r) {
				if(isset($r[$tonaj])) {
					
					$tonaj = number($r[$tonaj]);
					
					if(isset($r[$vardiya])) {
						if(!isset($data[$r[$vardiya]])) {
							$data[$r[$vardiya]] = 0;
						}
					
						@$data[$r[$vardiya]] +=$tonaj;
						array_push($labels,"'{$r[$vardiya]}'");
						
					}
				}
			}
			
		}
		$d = array();
		print_r($data);
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