<?php if(getisset("w")) {
	$week = get("w");
} else {
	$week = date("W");
} ?>

	<div class="block">
		<div class="block-header">{{e2("Department Worker Statistics")}}
		<div class="pull-right"><input type="number" onchange="$('.worker-chart').load('?ajax2=admin.dashboard.worker&w='+$(this).val());" name="" min="1" max="52" value="{{$week}}" id="" /> {{".Week)"}}
		</div></div>
		<div class="block-content">
		<?php $worker = db("workers")->where("json->KW",$week)->groupBy("json->Department")->get();
		
			$chart = array();
			foreach($worker AS $w) {
				$j = j($w->json);
				$say = db("workers")
					->where("json->Department",$j['Department'])
					->groupBy("json->Head_of_Department")
					->get()->count();
				
				@$chart[$j['Department']]=$say;
			}		
//print_r($chart);	
			$labels = array();
			$values = array();
			foreach($chart AS $a => $d) {
				array_push($labels,"'$a'");
				array_push($values,$d);
			}
		?>
		<?php $id="worker-chart";
		$type="horizontalBar"; 
		$label=__("Working"); 
		$url = "?ajax=worker-detail";
		?>
			@include("admin.chart.chart")
		</div>
		
	
</div>