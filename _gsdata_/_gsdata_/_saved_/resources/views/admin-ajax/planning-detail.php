<div class="detail">
			<table class="table table-bordered table-hover table-striped">
			<?php $veri = db("sap-planning")->orderBY("id","DESC")->first();
$sap = array();
	$j = j($veri->json);
foreach($j['row'] AS $v) {
	

	$sap[$v['ID']] = $v;
}

			?>
			<tr><td>"+key+"</td><td style='background:"+value+"'></td></tr>
			</table>
		</div>
		{{e2("Select Shift")}}
		<div class="row text-center">

			<div class="col-lg-4">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" name="Schicht[]" class="css-control-input" value="F" checked="">
					<span class="css-control-indicator"></span> {{e2("Früh")}}
				</label>
			</div>
			<div class="col-lg-4">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" name="Schicht[]" class="css-control-input" value="S" checked="">
					<span class="css-control-indicator"></span> {{e2("Spät")}}
				</label>
			</div>
			<div class="col-lg-4">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" name="Schicht[]" class="css-control-input" value="N" checked="">
					<span class="css-control-indicator"></span> {{e2("Nacht")}}
				</label>
			</div>
		</div>
		<div class="select-workstation d-none">
		{{e2("Select Workstation")}}
		<select name="" id="" class="form-control">
		<?php 
		$w = get("w"); 
		$slugs = explode(",",$w);
			$s = db("contents")->whereIn("slug",$slugs)->orderBy("s","ASC")->first(); ?>
		<?php $alt = db("contents")->where("kid",$s->slug)->get(); ?>
		<?php if(isset($alt)) { ?>
		<?php foreach($alt AS $a) { ?>
				<option value="{{$a->title}}">{{$a->title}}</option>
		<?php } ?>
		<?php } ?>
			</select></div>
		{{e2("Total")}}
		<input type="number" step="any" name="Bedarfsmenge SD" value="" class="form-control" readonly disabled required id="BedarfsmengeSD" />
		{{e2("How many of this product can be produced in one shift?")}}
		<input type="number" step="any" name="qty"  value="" class="form-control" required id="qty" />
		<br />
		<div class="btn btn-primary" onclick="calculate()">{{e2("Calculate")}}</div>
		<div class="btn-group">
			<div class="btn btn-warning one_shift"></div>
			<div class="btn btn-warning">+</div>
			<div class="btn btn-warning one_shift_kalan"></div>
		</div>