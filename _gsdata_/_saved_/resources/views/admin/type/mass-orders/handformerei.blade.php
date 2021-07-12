<h4 class="font-w400">Handformerei</h4>
					<p>
						<form action="?handformerei-add" class="seri handformerei" ajax=".handformerei-ajax" method="post">
						{{csrf_field()}}
							<select name="" id="" onchange="location.href='?id='+$(this).val()+'&active=2'" class="form-control">
								<option value="">{{e2("Select History")}}</option>
							<?php $sorgu = db("handformerei-mo")->take(5)->orderBy("id","DESC")->get(); foreach($sorgu AS $s) { 
								$j = j($s->json,false);
							?>
								<option value="{{$s->id}}" <?php if(getesit("id",$s->id)) echo "selected"; ?>>{{$s->created_at}}</option>
							<?php } ?>
							</select>
							<?php if(getisset("id") && !getesit("id","")) {
								$sorgu =  db("handformerei-mo")->where("id",get("id"))->orderBy("id","DESC")->get();
							} ?>
							<?php if(isset($sorgu[0])) { ?>
							<?php $j = j($sorgu[0]->json); unset($j['_token']); //print_r($j);  ?>
							<script type="text/javascript">
							$(function(){
								<?php foreach($j AS $a => $d) { $a = str_replace("_"," ",$a); ?>
								$(".handformerei [name='{{$a}}']").val("{{$d}}");
								<?php } ?>
							});
							</script>
							<?php } ?>
							{{e2("Lieferdatum")}}:
							<input type="date" name="Lieferdatum" id="" class="form-control" />
							{{e2("Schicht")}}:
							<select name="Schicht" id="" class="form-control">
								<option value="{{e2("Früh")}}">{{e2("Früh")}}</option>
								<option value="{{e2("Spät")}}">{{e2("Spät")}}</option>
								<option value="{{e2("Nacht")}}">{{e2("Nacht")}}</option>
							</select>
							{{e2("Mass Stock in to")}}:
							<input type="number" min="0" step="any" name="Mass Stock in to" id="" class="form-control" />
							{{e2("Quality")}}:
							<input type="text" name="Quality" id="" class="form-control" />
							{{e2("Versatz")}}:
							<input type="text" name="Versatz" id="" class="form-control" />
							{{e2("Workstation")}}:
							<select name="Workstation" id="" class="form-control select2">
								<option value="">{{e2("Please Select")}}</option>
							<?php $ws = contents("configration-handformerei"); foreach($ws AS $w) { ?>
								<option value="{{$w->title}}">{{e2($w->title)}}</option>
							<?php } ?>
							</select>
							{{e2("Bedarf in to")}}:
							<input type="number" name="Bedarf in to" id="" class="form-control" min="0" step="any" />
							{{e2("Remark")}}:
							<textarea name="Remark" id="" cols="30" rows="10" class="form-control"></textarea>
							
							
							<button type="submit" class="btn btn-primary min-width-125 mt-20">Save</button>
						
						</form>
						<div class="handformerei-ajax" ajax2="{{$path}}.list.handformerei"></div>
						
					</p>