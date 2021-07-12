<?php if(getisset("w")) {
	$week = get("w");
} else {
	$week = date("W");
}
if(!getisset("m")) {
    $_GET["m"] = date("n") - 1;
}
if(!getisset("y")) {
    $_GET["y"] = date("Y");
}
?>

	<div class="block">
		<div class="block-header">{{e2("Workstation Shift Tonnage Statistics (SAP)")}}
		<div class="pull-right d-none"><input type="number" onchange="$('.workstation-chart').load('?ajax2=admin.dashboard.worker&w='+$(this).val());" name="" min="1" max="52" value="{{$week}}" id="" /> {{".Week)"}}
		</div>
		<div class="pull-right">
			
		</div>
		
		</div>
		<div class="block-content">
		<div class="input-group">
				
				<input type="number" style="height: 36px;" min="{{date("Y")-3}}" max="{{date("Y")}}" value="<?php if(getisset("y")) echo get("y"); else echo date("Y"); ?>"  name="Year" id="Year2" class="form-control">
				<select name="Month" id="Month" class="form-control">
					<option value="">{{e2("All Month")}}</option>
				<?php for($k=1;$k<=12;$k++) { ?>
					<option value="{{$k}}" <?php if(getesit("m",$k)) echo "selected"; ?>>{{$k}}. {{e2("Month")}}</option>
				<?php } ?>
				</select>
				<select name="" id="type" class="form-control">
					<option value="">{{e2("Normal Chart")}}</option>
					<option value="stack" <?php if(getesit("type","stack")) echo "selected"; ?>>{{e2("Stack Bar Chart")}}</option>
				</select>
				<button class="btn btn-primary" onclick="$('#workstation').load('?ajax2=admin.dashboard.worker.workstation&m='+$('#Month').val()+'&y='+$('#Year2').val()+'&type='+$('#type').val());"><i class="fa fa-calculator"></i></button>
				
			</div>
		<?php 
		$id="workstation-chart";
		$type="bar"; 
		$sap = db("sap");

		$sap = $sap->orderBy("id","DESC");
		$sap = $sap->get();

        $data = [];

        $data['SilikaPR'] = 0;
		$data['SchamottePR'] = 0; 
        $data['Handformerei'] = 0;
        
        $month_to_get_data = get("m");
        $year_to_get_data = get("y");
        $first_timestamp_to_get_data = strtotime("1-" . $month_to_get_data . "-" . $year_to_get_data);
        $last_timestamp_to_get_data = strtotime("1-" . ( $month_to_get_data + 1 ) . "-" . $year_to_get_data);

		foreach($sap AS $s) {

            if(file_exists($s->title)) {
                
                $file = file_get_contents($s->title);
                
                $satir = explode("\n", $file);
                
                $ilk = $satir[0];
                
                $ilk = explode(";", $ilk);

                $index_of_ruckmeldung = "";
                $index_of_arbeitsplatz = "";
                $index_of_buchungsdatum = "";

                $say = 0;
                foreach($ilk AS $col) {
                    if($col == "Rückmeldung [TO]") {
                        $index_of_ruckmeldung = $say;
                    }

                    if($col == "Arbeitsplatz") {
                        $index_of_arbeitsplatz = $say;
                    }

                    if($col == "Buchungsdatum") {
                        $index_of_buchungsdatum = $say;
                    }
                    
                    $say++;
                }
            
                unset($satir[0]);

    			$labels = [];

                foreach($satir AS $s) {
                    $a = explode(";",$s);

                    // echo "<pre>";
                    // print_r(@$a[$index_of_arbeitsplatz]);
                    // echo "</pre>";
                    if (strtotime(@$a[$index_of_buchungsdatum]) >= $first_timestamp_to_get_data && strtotime(@$a[$index_of_buchungsdatum]) < $last_timestamp_to_get_data) {

                        $etiket = "";

                        if ( strpos( @$a[$index_of_arbeitsplatz], "HAND" ) !== false ) {
                            $etiket = "Handformerei";
                            //$table = "rq-handformerei";
                        }

                        if ( strpos( @$a[$index_of_arbeitsplatz], "P-SI" ) !== false ) {
                            $etiket = "SilikaPR";
                            //$table = "rq-silika";
                        }

                        if ( strpos( @$a[$index_of_arbeitsplatz], "P-SA" ) !== false ) {
                            $etiket = "SchamottePR";
                            //$table = "rq-schamotte";
                        }

                        if ($etiket !== "") {
                            //print_r($etiket . "\n");


                            @$a[$index_of_ruckmeldung] = str_replace(".", " ", $a[$index_of_ruckmeldung]);
                            @$a[$index_of_ruckmeldung] = str_replace(",", ".", $a[$index_of_ruckmeldung]);
                            
                            @$data[$etiket] += $a[$index_of_ruckmeldung];
                        }
                        
                    }
                    
                }
            
            }

        }

		$d2 = array(); 
		$tablolar = explode(",","rq-handformerei,rq-silika,rq-schamotte");
		$d2['rq-handformerei']=0;
		$d2['rq-silika']=0;
		$d2['rq-schamotte']=0;
		foreach($tablolar AS $t) {
			$sorgu = db($t);
			
			if(getisset("m")) {
				$sorgu = $sorgu->where("json->Month_Number",get("m"));
			}
			$sorgu = $sorgu->get();
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
		foreach($data AS $b) { //labelleri diziye aktaralım 
			if(!in_array("'$b'",$d)) {
				array_push($d,"'$b'");
			}
			
		}
		foreach($d2 AS $b) {
			if(!in_array("'$b'",$d2)) {
				array_push($data2,"'$b'");
			}
			
		}
		if(getesit("type","stack")) {
			$stack = "stack1";
			$stack2 = "stack1";
		} else {
			$stack = "stack1";
			$stack2 = "stack2";
		}
		
		$d = implode(",",$d);
		$data2 = implode(",",$data2);
		$url = "?ajax=worker-detail";
		$labels = explode(",","'SilikaPR','SchamottePR','Handformerei'");
		$data_p = $data;
		$data = array(
			array(
				"label"=> _("IST Tonnage"),
				"data" =>"{$data['SilikaPR']},{$data['SchamottePR']},{$data['Handformerei']}",
				"stack" => "$stack",
				"color"=>"'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(75, 192, 192, 0.2)'"
			),
			array(
				"label"=> _("SOLL Tonnage"),
				"data" =>"{$d2['rq-silika']},{$d2['rq-schamotte']},{$d2['rq-handformerei']}",
				"stack" => "$stack2",
				"color"=>"'rgba(21, 32, 132, 0.2)',
                'rgba(21, 32, 132, 0.2)',
                'rgba(21, 32, 132, 0.2)',
                'rgba(21, 32, 132, 0.2)'"
			)
			
		);
		?>
			@include("admin.chart.chart-workstation")
		</div>
		{{e2("IST Tonnage")}}
		<script type="text/javascript">
		/*
		$("[title]").popover({
			trigger:'click'
		});
		*/
		</script>
		<?php 
		$data = $data_p;
		$app_total = $data['SilikaPR']+$data['SchamottePR']+$data['Handformerei']; 
		if($app_total==0) $app_total=1;
		?>
		
		<div class="progress">
		  <div class="progress-bar bg-success" title="{{$data['SilikaPR']}}" style="width:{{100*$data['SilikaPR']/$app_total}}%">
			SilikaPR
		  </div>

		  <div class="progress-bar bg-warning" title="{{$data['SchamottePR']}}" style="width:{{@100*$data['SchamottePR']/$app_total}}%">
			SchamottePR 
		  </div>
		  <div class="progress-bar bg-danger" title="{{$data['Handformerei']}}" style="width:{{@100*$data['Handformerei']/$app_total}}%">
			Handformerei 
		  </div>
		</div> 
		{{e2("SOLL Tonnage")}}
		<?php $sol_total = $d2['rq-silika']+$d2['rq-schamotte']+$d2['rq-handformerei']; 
		if($sol_total==0) $sol_total=1;
		?>
		<div class="progress">
		  <div class="progress-bar bg-success" title="{{$d2['rq-silika']}}" style="width:{{@100*$d2['rq-silika']/$sol_total}}%">
			SilikaPR
		  </div>
		  <div class="progress-bar bg-warning" title="{{$d2['rq-schamotte']}}" style="width:{{@100*$d2['rq-schamotte']/$sol_total}}%">
			SchamottePR
		  </div>
		  <div class="progress-bar bg-danger" title="{{$d2['rq-handformerei']}}" style="width:{{@100*$d2['rq-handformerei']/$sol_total}}%">
			Handformerei
		  </div>
		</div> 
	
</div>