<div class="row">
	<div class="input-group">
		<select required name="Temporary Workers" id="" class="form-control">
			<option value="">{{e2("Temporary Workers")}}</option>
			<option value="Leiharbeiter">{{e2("Leiharbeiter")}}</option>
			<option value="Stammmitarbeiter">{{e2("Stammmitarbeiter")}}</option>
			<!--<option value="Dauerkrank">{{e2("Dauerkrank")}}</option>
			<option value="Schulung / Seminar">{{e2("Schulung / Seminar")}}</option>-->
		</select>
		<select required name="Presence" id="" class="form-control">
			<option value="">{{e2("Presence")}}</option>
			<option value="Anwesend">{{e2("Anwesend")}}</option>
			<option value="Urlaub">{{e2("Urlaub")}}</option>
			<option value="Krank">{{e2("Krank")}}</option>
			<option value="Dauerkrank">{{e2("Dauerkrank")}}</option>
			<option value="Schulung / Seminar">{{e2("Schulung / Seminar")}}</option>
		</select>
		<select name="Department" required id="" class="form-control">
			<option value="">{{e2("Select Department")}}</option>
			<?php $department = contents("departments");  foreach($department AS $d) { ?>

			<option value="{{$d->title}}">{{$d->title}}</option>
			<?php } ?>
		</select>
		<select name="kw" id="kw" style="width:100px" class="form-control">
		<?php for($k=1;$k<=52;$k++) { ?>
			<option value="{{$k}}">{{$k}}.{{e2("KW")}}</option>
		<?php } ?>
		</select> 
		<button class="btn btn-primary"><i class="fa fa-calculator"></i></button>
	</div>
	
	
</div>



<?php 
$type="bar";
$id = "temporary";
$url = "";
$label = "Test";
$labels = explode(",","1,2");
$values = explode(",","123,342");
 ?>
 @include("admin.chart.chart")
 