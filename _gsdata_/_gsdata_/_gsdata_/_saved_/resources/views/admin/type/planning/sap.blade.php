<?php if(getisset("sap-parser")) {
	$dosya_adi = upload("file","csv-planning");
	$dosya = file_get_contents($dosya_adi);
	$dizi = explode("\n",$dosya);
	$k=0;
//	print_R($dizi); exit();
	$sap = array();
	$map = array();
	$eklenen = array();
	foreach($dizi AS $r) { 
		$c = explode(";",$r);
		$sap['row'][$k] = array();
		
		
		if($k==0) {
			// e�er ilk sa
			$sap['col'] = array();	
			 $z=0;
			array_push($sap['col'],"ID");
			array_push($sap['col'],"Color");
			foreach($c AS $a) { 
				array_push($sap['col'],$a);
				$map[$a] = $z;
				$z++;
			} 
		} else {
			$x=0;
			@$sap['row'][$k][$sap['col'][$x]] = date("His").rand(11111,99999);
			@$sap['row'][$k][$sap['col'][$x+1]] = "hsla(".rand(0,360).",".rand(50,100)."%,".rand(50,100)."%,0.3)"; 
			foreach($c AS $a) { 
				@$sap['row'][$k][$sap['col'][$x+2]] = $a;
			/*
				$deger = array(
					$sap['col'][$k] = $a
				);
				
				*/
				//array_push($sap['row'][$k],$deger);
				///$sap['row'][$sap['col'][$k]] = $a;
				/*
				if(is_float ($a)) {
					array_push($sap['row'][$k],eval($a));
				} else {
					array_push($sap['row'][$k],($a));
				}
				*/
				$x++;
			}	
		}
		
		$k++; 
	}
	$sap['row'] = array_filter($sap['row']);
	$sap['map'] = $map;
//	print_r($sap); exit();
	$json = json_encode($sap);
	//echo $json;
	
	if(is_json($json)) {
		ekle(array(
		"title" => $dosya_adi,
		"json" => $json
		),"sap-planning"); 
		bilgi("$k Parse Operation is Success!");
	} else {
		bilgi("CSV Parse Error!");
	}
	
	////exit();
	
} ?>

<h3>{{e2("SAP Parser")}}</h3>
<form action="?sap-parser&active=2" enctype="multipart/form-data" method="post">
	{{csrf_field()}}
	{{e2("Select CSV File:")}}
	<div class="input-group">
	<input type="file" name="file" required id="" class="form-control" />
	
	<button class="btn btn-primary">{{e2("Engine")}}</button>
	</div>
	<br />
	<div class="table-responsive">
			<table class="table table-bordered table-hover table-striped">
				
				<tr>
					<th>{{e2("Created Date")}}</th>
					<th>{{e2("File")}}</th>
					<th>{{e2("Count")}}</th>
					<th>{{e2("Data")}}</th>
				</tr>
				<?php $sap = db("sap-planning")->orderBy("id","DESC")->get(); foreach($sap AS $s) {
				$j = json_decode($s->json,true);;
					?>
				<tr id="t{{$s->id}}">
					<td>{{$s->created_at}}</td>
					<td><a href="{{url($s->title)}}">{{$s->title}}</a></td>
					<td>{{count($j['row'])}}</td>
					<td>
						<div class="btn btn-primary ajax_modal" title="{{$s->created_at}} / {{$s->title}}" href="?ajax=sap-planning-detail4&id={{$s->id}}"><i class="fa fa-table"></i></div>
						<a href="?ajax=delete-row&table=sap-planning&id={{$s->id}}" ajax="#t{{$s->id}}" teyit="{{e2("Are you sure delete?")}}" class="btn btn-danger"><i class="fa fa-times"></i></a>
					</td>
				</tr>
				<?php } ?>
			</table>
	</div>
</form>