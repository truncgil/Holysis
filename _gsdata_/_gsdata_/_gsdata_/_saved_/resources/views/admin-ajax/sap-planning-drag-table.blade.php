<?php $sap = db("sap-planning")->orderBy("id","DESC")->first();
$j = j($sap->json);

$new = array();
$k=0;
$mrp = map('MRP Contr.');
$arp = map('Arbeitsplatz');
$mat = map('MatBereitstell');
$bere = map('Bereitstellungstermin ist gefährdet');
$beda = map('Bedarfsmenge SD');
$auf = map('Auftrag');
$text =  map('Bedarfsmenge SD');
$vors = map('Vorstufe');
$prelim = map('Prelim. Stage');

foreach($j['row'] AS $r) {
//	@array_push($new[@$r['MRP Contr.']][@$r['Arbeitsplatz']],$r);
	if(@$r[$mrp]!="") {
		$new[@$r[$mrp]][@$r[$arp]][$k] = $r;
	}
	
$k++;
}

$renkler = db("contents")->where("kid","configration-status")->get();
$renkler2 = array();
foreach($renkler AS $r) {
	if($r->html) {
		$renkler2[$r->title] = "{$r->html},{$r->min}";
		
	}
	
}
$renkler = $renkler2;
//print_R($renkler);
$w = "HF,B00,PR,END";

if(getisset("w") && !getesit("w","")) {
	switch(get("w")) {
		case "silikapr-workstations" : 
			$w = "PR";
			$alt_key="P-SI";
		break;
		case "schamottepr-workstations" : 
			$w = "PR";
			$alt_key="P-SA";
		break;
		case "configration-endbearbeitung" : 
			$w = "END";
		break;
		case "configration-handformerei" : 
			$w = "HF";
		break;
		
		
	} 	
}
$w = explode(",",$w);
$olmayan = explode(",","ID,Color,Serial No,Sequenz,Quality Versian,YSOR vers.");
 ?>


<script type="text/javascript">
$(function(){
		var data = [];
		<?php foreach($new AS $a => $d) { ?>
<?php if(in_array($a,$w)) { ?>
         <?php $k=0;
	   $eklenen = array();
	   foreach($d AS $x => $y) {
		   
		   ?>
		   <?php foreach($y AS $z) { 
		  
		 //  if(!in_array($z['Serial No.'],$eklenen)) {
			 //  array_push($eklenen,$z['Serial No.']);
		   if(!isset($alt_key)) {
			   $alt_key = $z[$arp];
		   }
		   if(strpos($z[$arp],$alt_key)!==false) { 
	
			$renk = $z['Color'];
			$renk2 = "black";
		//	e($z['MRP Contr.']);
			$simdi = strtotime(date("Y-m-d"));
			$tarih = strtotime($z[$mat]);
			$fark = round(($tarih-$simdi)/86400,2);
			switch($z[$mrp]) {
			/*	case "END" : 
					$renk = $renkler['Endbearbeitung'];
					$renk2 = "white";
				break;
			*/
			}
			$r = explode(",",$renkler[$bere]);
			if($fark>0 && $fark<=$r[1]) {
				$renk = $r[0];
				$renk2 = "white";
			}
			if($z[$prelim]=="x") {
				$r = explode(",",$renkler[$vprs]);
				$renk = $r[0];
				$renk2 = "black";
			}
			$data = array();
			$zzk=0;
			$drag_data = "<div class='drag-data' jid='{$z['ID']}' >
				<div draggable='true' style='background:{$renk};color:{$renk2}' 
				title='{$z[$text]} / {{$z[$beda]}} / {$z[$arp]} / {$z[$mat]}' 
				class='job' id='j{$z['ID']}' jid='{$z['ID']}' ondragstart='drag(event, $(this))'>";
				//$drag_data .="<div class='json d-none'>".json_encode_tr($z)."</div>";
			if($z[$mrp]=="END") {  
				$drag_data .='<span class="arrow-left float-left d-none"></span>';
			} 
			$drag_data .= "{$z[$auf]} / {$z[$text]} / {$z[$beda]} / {$z[$arp]} / {$z[$mat]}</div></div>";
			array_push($data,$drag_data);
			$data['customjid'] = $z['ID'];
			
			foreach($z AS $a => $zz) {
				
				if(!in_array($a,$olmayan)) {
				
					if($zzk==1) {
					//	$zz ="<div style='background:$zz;width:100px;height:50px;'></div>";
					}
					array_push($data,$zz);
				}
				$zzk++;
			}
		   ?>
		   
            data.push(  <?php echo json_encode_tr($data);	?>  );
		 <?php
		   $k++;
		 //  if($k>10) break;
		   }
		   }
	//	   } //in_array
	   } 
	   } 
	   } 
	   ?>
		$.fn.dataTable.ext.errMode = 'none';
	$('#sap-detail').on( 'processing.dt', function ( e, settings, processing ) {
        $('.loading').css( 'display', processing ? 'block' : 'none' );
    } );
    var table = $('#sap-detail').DataTable({
		data : data,
		scrollY:        "400px",
		deferRender:    true
	});
	
	var page = localStorage.getItem("page");
	//console.log("page"+page);
	
  
	table.on( 'page.dt', function () {
		var info = table.page.info();
		//$('#pageInfo').html( 'Showing page: '+info.page+' of '+info.pages );
		localStorage.setItem("page",info.page);
		//console.log("page.dt="+info.page);
		
	} );
	function renklendir() {
		$(".dataTable .job").each(function(){
			var jid = $(this).attr("jid");
			//console.log(jid);
			var bu = $(this);
			var secici = $(".planning-board .j"+jid);
			//console.log(secici.length);
			if(secici.attr("checked")!=undefined) {
				bu.addClass("checked");
			}
			if(secici.length>0) {
				bu.addClass("onboard");
				$(".onboard").parent().parent().parent().addClass("onboardtr"); 
			}
		});
		
	}
	window.setInterval(function(){
		renklendir();
	},1000);
	$(".paginate_button").on("click",function(){
		renklendir();
		
	});
});
</script>
<div class="table-responsive">

	<table id="sap-detail" class="table table-bordered table-hover table-striped dataTable" >
		<thead>
		<tr>
			<th>{{e2("Drag Card")}}</th>
		<?php foreach($j['col'] AS $c) { ?>
		<?php if(!in_array($c,$olmayan)) { ?>
			<th>{{$c}}</th>
		<?php } ?>
		<?php } ?>
		</tr>
		</thead>
		<tbody>
	
			
		</tbody>
	</table>
</div>
<div class="loading"><i class="fa fa-spin fa-spinner"></i></div>
