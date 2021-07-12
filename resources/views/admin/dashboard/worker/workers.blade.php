<div class="row">

	<div class="input-group">
		<select required name="Temporary Workers" id="Temporary" class="form-control">
			<option value="">{{e2("Select Temporary Workers")}}</option>
			<option value="Leiharbeiter">{{e2("Leiharbeiter")}}</option>
			<option value="Stammmitarbeiter">{{e2("Stammmitarbeiter")}}</option>
			<!--<option value="Dauerkrank">{{e2("Dauerkrank")}}</option>
			<option value="Schulung / Seminar">{{e2("Schulung / Seminar")}}</option>-->
		</select>
		<select required name="Presence" id="Presence" class="form-control">
			<option value="">{{e2("Select Presence")}}</option>
			<option value="Anwesend">{{e2("Anwesend")}}</option>
			<option value="Urlaub">{{e2("Urlaub")}}</option>
			<option value="Krank">{{e2("Krank")}}</option>
			<option value="Dauerkrank">{{e2("Dauerkrank")}}</option>
			<option value="Schulung / Seminar">{{e2("Schulung / Seminar")}}</option>
		</select>
		<select name="Department" required id="Department" class="form-control">
			<option value="">{{e2("Select Department")}}</option>
			<?php $department = contents("departments");  foreach($department AS $d) { ?>

			<option value="{{$d->title}}">{{$d->title}}</option>
			<?php } ?>
		</select>
		<select name="kw" id="kw" style="width:100px" class="form-control">
			<option value="">{{e2("All Week")}}</option>
		<?php for($k=1;$k<=52;$k++) { ?>
			<option value="{{$k}}">{{$k}}.{{e2("KW")}}</option>
		<?php } ?>
		</select> 
		<select name="Year" id="Year" style="width:100px" class="form-control">
			<option value="">{{e2("All Year")}}</option>
		<?php for($k=date("Y")-2;$k<=date("Y");$k++) { ?>
			<option value="{{$k}}">{{$k}}</option>
		<?php } ?>
		</select> 
		<button class="btn btn-primary calc-worker"><i class="fa fa-calculator"></i></button>
	</div>
<script type="text/javascript">
<?php foreach($_POST AS $alan => $deger) { ?>
	 $("#{{$alan}}").val("{{$deger}}");
<?php } ?>
$(".calc-worker").on("click",function(){
		$.post('?ajax2=admin.dashboard.worker.workers',{
			"kw" : $("#kw").val(),
			"_token" : "{{csrf_token()}}",
			"Department" : $("#Department").val(),
			"Year" : $("#Year").val(),
			"Temporary" : $("#Temporary").val(),
			"Presence" : $("#Presence").val()
		},function(d){
			$("#workers").html(d);
		});
	});
</script>
	
</div>


<?php 
//print_r($_POST);
$s = db("workers");
if(!postesit("kw","")) {
	$s = $s->where("json->KW",post("kw"));
}
if(!postesit("Temporary","")) {
	$s = $s->where("json->Temporary_Workers",post("Temporary"));
}
if(!postesit("Presence","")) {
	$s = $s->where("json->Presence",post("Presence"));
}
if(!postesit("Department","")) {
	$s = $s->where("json->Department",post("Department"));
}
if(!postesit("Year","")) {
	$s = $s->where("json->Year",post("Year"));
}

$sorgu = $s->get();
$labels = array();
$values = array();
$label_values=array();
foreach($sorgu AS $s) {
	$j = j($s->json); 
	unset($j['_token']); 
	if(!isset($label_values[@$j['Department']])) {
		$label_values[@$j['Department']]=0;
	}
	//print_r($j);
	//array_push($labels,@$j['Department']);
	$label_values[@$j['Department']]++;
}
//print_r($label_values);
foreach($label_values AS $a=>$d) {
	if($a!="") {
		array_push($labels,"'$a'");
		array_push($values,$d);
	}
	
}
$type="bar";
$id = "temporary";
$url = "";
$label = "Arbeiter Statistik";
//$labels = explode(",","1,2");
 ?>
 @include("admin.chart.chart")
 