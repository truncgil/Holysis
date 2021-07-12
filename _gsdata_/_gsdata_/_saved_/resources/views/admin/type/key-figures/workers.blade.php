
<h4 class="font-w400">Workers (Mitarbeiter)</h4>
				
					<!-- Workers -->
					
					<select name="" id="" onchange="location.href='?id='+$(this).val()" class="form-control">
						<option value="">{{e2("Select History")}}</option>
					<?php $sorgu = db("workers")->take(5)->orderBy("id","DESC")->get(); foreach($sorgu AS $s) { 
						$j = j($s->json,false);
					?>
						<option value="{{$s->id}}" <?php if(getesit("id",$s->id)) echo "selected"; ?>>{{$s->created_at}}</option>
					<?php } ?>
					</select>
					<?php if(getisset("id") && !getesit("id","")) {
						$sorgu =  db("workers")->where("id",get("id"))->orderBy("id","DESC")->get();
					} ?>
					<?php $j = j($sorgu[0]->json); unset($j['_token']); //print_r($j);  ?>
					<script type="text/javascript">
					$(function(){
						<?php foreach($j AS $a => $d) { $a = str_replace("_"," ",$a); ?>
						$("[name='{{$a}}']").val("{{$d}}");
						<?php } ?>
					});
					</script>
					<form action="?workers-add&tab=1" class="seri" ajax=".workers-result" method="POST">
						{{csrf_field()}}
						{{e2("KW")}} :
						<input type="number" required min="1" max="52" name="KW" value="{{date('W')}}" class="form-control">

						{{e2("Department")}} :
						<select name="Department" required id="" class="form-control select2">
							<option value="">{{e2("Select Department")}}</option>
							<?php $department = contents("departments");  foreach($department AS $d) { ?>

							<option value="{{$d->title}}">{{$d->title}}</option>
							<?php } ?>
						</select>

						{{e2("Head of Department")}} :
						<select name="Head of Department" required id="" class="form-control select2">
							<option value="">{{e2("Select User")}}</option>
							<?php $user = users("Head of Department");  foreach($user AS $d) { ?>

							<option value="{{$d->name}} {{$d->surname}}">{{$d->name}} {{$d->surname}}</option>
							<?php } ?>
						</select>

						{{e2("Employees")}} : 
						<select name="Employees" required id="" class="form-control select2">
						<option value="">{{e2("Select User")}}</option>
							<?php $user = users("Worker");  foreach($user AS $d) { ?>
							
							<option value="{{$d->name}} {{$d->surname}}">{{$d->name}} {{$d->surname}}</option>
							<?php } ?>
						</select>

						{{e2("Function")}} :
						<input type="text" required name="Function" class="form-control">

						{{e2("Temporary Workers ")}} :
						<select required name="Temporary Workers" id="" class="form-control">
							<option value="">{{e2("Select")}}</option>
							<option value="Leiharbeiter">{{e2("Leiharbeiter")}}</option>
							<option value="Stammmitarbeiter">{{e2("Stammmitarbeiter")}}</option>
							<!--<option value="Dauerkrank">{{e2("Dauerkrank")}}</option>
							<option value="Schulung / Seminar">{{e2("Schulung / Seminar")}}</option>-->
						</select>

						{{e2("Presence")}} :
						<select required name="Presence" id="" class="form-control">
							<option value="">{{e2("Select")}}</option>
							<option value="Anwesend">{{e2("Anwesend")}}</option>
							<option value="Urlaub">{{e2("Urlaub")}}</option>
							<option value="Krank">{{e2("Krank")}}</option>
							<option value="Dauerkrank">{{e2("Dauerkrank")}}</option>
							<option value="Schulung / Seminar">{{e2("Schulung / Seminar")}}</option>
						</select>
						{{e2("Remark")}} :
						<textarea name="Remark" required id="" cols="30" rows="10" class="form-control"></textarea>
						
						<button type="submit" class="btn btn-primary min-width-125 mt-20">Save</button>
					</form>
					<!-- /Workers -->
					<div class="workers-result" ajax2="admin.type.key-figures.list.workers">
						@include("admin.type.key-figures.list.workers")
					</div>

					
				