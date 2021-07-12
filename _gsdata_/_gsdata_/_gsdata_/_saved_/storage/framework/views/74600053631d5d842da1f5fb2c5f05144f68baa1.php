<?php 
$sap = db("sap-planning")
	//->where("id",get("id"))
	->orderBy("id","DESC")
	->first();
$j = j($sap->json);

$new = array();
$k=0;
foreach($j['row'] AS $r) {
//	@array_push($new[@$r['MRP Contr.']][@$r['Arbeitsplatz']],$r);
	if(@$r['MRP Contr.']!="") {
		$new[@$r['MRP Contr.']][@$r['Arbeitsplatz']][$k] = $r;
	}
	
$k++;
}
  ?>
 <script>
$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#accordion .block-body div").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<?php
/*
<option value="silikapr-workstations">{{e2("SilikaPR")}}</option>
			<option value="schamottepr-workstations">{{e2("Schamotte")}}</option>
			<option value="configration-handformerei">{{e2("Handformerei")}}</option>
			<option value="configration-endbearbeitung">{{e2("Endbearbeitung")}}</option>
*/ 
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

?>
<input type="search" name="" id="search" placeholder="<?php echo e(e2("Search...")); ?>" class="form-control" />
<div id="accordion">
<?php foreach($new AS $a => $d) { ?>
<?php if(in_array($a,$w)) { ?>
  <div class="block block-bordered block-rounded mb-2">
    <div class="block-header">
      <a  data-toggle="collapse" href="#<?php echo e(str_slug($a)); ?>">
        <?php echo e($a); ?>

      </a>
    </div>
    <div id="<?php echo e(str_slug($a)); ?>" >
      <div class="block-body">
		<ul class="list-group sap-planning" style="position:relative">
       <?php $k=0;
	   $eklenen = array();
	   foreach($d AS $x => $y) {
		   
		   ?>
		   <?php foreach($y AS $z) { 
		   if(!in_array($z['Auftrag'],$eklenen)) {
			   array_push($eklenen,$z['Auftrag']);
		   if(!isset($alt_key)) {
			   $alt_key = $z['Arbeitsplatz'];
		   }
		   if(strpos($z['Arbeitsplatz'],$alt_key)!==false) { 
	
			$renk = $z['Color'];
			$renk2 = "black";
		//	e($z['MRP Contr.']);
			$simdi = strtotime(date("Y-m-d"));
			$tarih = strtotime($z['MatBereitstell']);
			$fark = round(($tarih-$simdi)/86400,2);
			switch($z['MRP Contr.']) {
			/*	case "END" : 
					$renk = $renkler['Endbearbeitung'];
					$renk2 = "white";
				break;
			*/
			}
			$r = explode(",",$renkler['Bereitstellungstermin ist gefährdet']);
			if($fark>0 && $fark<=$r[1]) {
				$renk = $r[0];
				$renk2 = "white";
			}
			if($z['Prelim. Stage']=="x") {
				$r = explode(",",$renkler['Vorstufe']);
				$renk = $r[0];
				$renk2 = "black";
			}
		   ?>
			<li class="list-group-item drag-data" jid="<?php echo e($z['ID']); ?>" >
				<div  draggable="true" json="<?php echo e(json_encode_tr($z)); ?>" style="background:<?php echo e($renk); ?>;color:<?php echo e($renk2); ?>" 
				title="<?php echo e($z['Text']); ?> / <?php echo e($z['Bedarfsmenge SD']); ?> / <?php echo e($z['Arbeitsplatz']); ?> / <?php echo e($z['MatBereitstell']); ?>" 
				class="job" id="j<?php echo e($z['ID']); ?>" jid="<?php echo e($z['ID']); ?>" ondragstart="drag(event)">
				<?php if($z['MRP Contr.']=="END") {  ?><span class="arrow-left float-left"></span><?php } ?>
				<?php echo e($z['Auftrag']); ?> / <?php echo e($z['Text']); ?> / <?php echo e($z['Bedarfsmenge SD']); ?> / <?php echo e($z['Arbeitsplatz']); ?> / <?php echo e($z['MatBereitstell']); ?></div>
			</li>
			
		   <?php
		   $k++;
		 //  if($k>10) break;
		   }
		   }
		   } //in_array
	   } ?>
		</ul>
      </div>
    </div>
  </div>
<?php } ?>
<?php } ?>


</div>
<style type="text/css">
	
</style><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin-ajax/sap-planning-drag.blade.php ENDPATH**/ ?>