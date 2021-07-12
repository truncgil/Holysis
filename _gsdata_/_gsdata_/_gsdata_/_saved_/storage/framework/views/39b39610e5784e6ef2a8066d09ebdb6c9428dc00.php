<?php 
//print_r($_POST); exit();
$d = post("module");
if($d=="mass-mortel") {
	$d = "mass-mortar";
}
$db = post("table");
$id = str_slug($d);
$sorgu = db($db);
	
	if(postisset("start")) {
		if(!postesit("start","")) {
			if(postesit("type","Setup")) {
				$col="setupTime";
			} else {
				$col="downTime";
			}
			$sorgu = whereJ($sorgu,$col,">=","'{$_POST['start']}'");
			$sorgu = whereJ($sorgu,$col,"<=","'{$_POST['end']}'");
			//$sorgu ->whereRaw("(json_extract(json, '$.\"$col\"')) <= '{$_POST['end']}'");	
		}
		

	}
	$sorgu = $sorgu->get();
	
		$setup = 0;
		$down = 0;
		$divide = 360;
		$work = array();
		foreach($sorgu AS $s) {
	//	print_r($s);
			$j = j($s->json);
			
			$col = $d."-Workstation";
		//	echo($col);
			if(isset($j["$col"])) {
				$col = $j["$col"];
				$setup1 = strtotime($j['setupTime']);
				$setup2 = strtotime($j['setupTimeTo']);
				$down1 = strtotime($j['downTime']);
				$down2 = strtotime($j['downTimeTo']);
				$setup += round(($setup2 - $setup1)/$divide,0);
				$down += round(($down2 - $down1)/$divide,0);
				$work[$col]['down'] = $down;
				$work[$col]['setup'] = $setup;	
			}
			
		}
	//	echo "$setup $down";

	 ?>
<?php 
	$labels = array();
	$downs = array();
	$setups = array();
	foreach($work AS $w => $d) { 
		$tam = $d['down'] + $d['setup'];
		$yuzde = round((100*$d['down'])/$tam,2);
		array_push($labels,"'$w'");
		array_push($downs,$d['down']);
		array_push($setups,$d['setup']);
	} 
	$yuzde_downs = array_sum($downs);
	$yuzde_setups = array_sum($setups);
	//echo "$yuzde_downs $yuzde_setups";
	$downs2 = array();
	$setups2 = array();
	foreach($downs AS $xx) {
		array_push($downs2,@round($xx*100/$yuzde_downs,2));
	}
	foreach($setups AS $xx) {
		array_push($setups2,@round($xx*100/$yuzde_setups,2));
	}
	$downs = $downs2;
	$setups = $setups2;
	

?>
<?php 
if(postesit("type","Setup")) {
	$title = "Setup Time";  $values = $setups; $id = "$id-setup";	
} else {
	$title = "Down Time";  $values = $downs; $id = "$id-down";	
}
 ?>
<?php echo $__env->make("admin.chart.pie", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin-ajax/chart-down-setup.blade.php ENDPATH**/ ?>