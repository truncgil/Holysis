<h4 class="font-w400">SchamottePR</h4>
					<p>
						<form action="?schamottepr-add" class="seri schamottepr" ajax=".SchamottePR-ajax" method="post">
						<?php echo e(csrf_field()); ?>

							<select name="" id="" onchange="location.href='?id='+$(this).val()+'&active=2'" class="form-control">
								<option value=""><?php echo e(e2("Select History")); ?></option>
							<?php $sorgu = db("schamottepr-mo")->take(5)->orderBy("id","DESC")->get(); foreach($sorgu AS $s) { 
								$j = j($s->json,false);
							?>
								<option value="<?php echo e($s->id); ?>" <?php if(getesit("id",$s->id)) echo "selected"; ?>><?php echo e($s->created_at); ?></option>
							<?php } ?>
							</select>
							<?php if(getisset("id") && !getesit("id","")) {
								$sorgu =  db("schamottepr-mo")->where("id",get("id"))->orderBy("id","DESC")->get();
							} ?>
							<?php $j = j($sorgu[0]->json); unset($j['_token']); //print_r($j);  ?>
							<script type="text/javascript">
							$(function(){
								<?php foreach($j AS $a => $d) { $a = str_replace("_"," ",$a); ?>
								$(".schamottepr [name='<?php echo e($a); ?>']").val("<?php echo e($d); ?>");
								<?php } ?>
							});
							</script>
							<?php echo e(e2("Lieferdatum")); ?>:
							<input type="date" name="Lieferdatum" id="" class="form-control" />
							<?php echo e(e2("Schicht")); ?>:
							<select name="Schicht" id="" class="form-control">
								<option value="<?php echo e(e2("Früh")); ?>"><?php echo e(e2("Früh")); ?></option>
								<option value="<?php echo e(e2("Spät")); ?>"><?php echo e(e2("Spät")); ?></option>
								<option value="<?php echo e(e2("Nacht")); ?>"><?php echo e(e2("Nacht")); ?></option>
							</select>
							<?php echo e(e2("Mass Stock in to")); ?>:
							<input type="number" min="0" step="any" name="Mass Stock in to" id="" class="form-control" />
							<?php echo e(e2("Quality")); ?>:
							<input type="text" name="Quality" id="" class="form-control" />
							<?php echo e(e2("Versatz")); ?>:
							<input type="text" name="Versatz" id="" class="form-control" />
							<?php echo e(e2("Workstation")); ?>:
							<select name="Workstation" id="" class="form-control select2">
								<option value=""><?php echo e(e2("Please Select")); ?></option>
							<?php $ws = contents("schamottepr-workstations"); foreach($ws AS $w) { ?>
								<option value="<?php echo e($w->title); ?>"><?php echo e(e2($w->title)); ?></option>
							<?php } ?>
							</select>
							<?php echo e(e2("Bedarf in to")); ?>:
							<input type="number" name="Bedarf in to" id="" class="form-control" min="0" step="any" />
							<?php echo e(e2("Remark")); ?>:
							<textarea name="Remark" id="" cols="30" rows="10" class="form-control"></textarea>
							
							
							<button type="submit" class="btn btn-primary min-width-125 mt-20">Save</button>
						
						</form>
						<div class="SchamottePR-ajax" ajax2="<?php echo e($path); ?>.list.schamottepr"></div>
						
					</p><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/mass-orders/schamotte.blade.php ENDPATH**/ ?>