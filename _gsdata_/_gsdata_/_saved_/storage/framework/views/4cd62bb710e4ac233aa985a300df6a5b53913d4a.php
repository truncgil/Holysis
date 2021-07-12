
<h4 class="font-w400">Workers (Mitarbeiter)</h4>
				
					<!-- Workers -->
					
					<select name="" id="" onchange="location.href='?id='+$(this).val()" class="form-control">
						<option value=""><?php echo e(e2("Select History")); ?></option>
					<?php $sorgu = db("workers")->take(5)->orderBy("id","DESC")->get(); foreach($sorgu AS $s) { 
						$j = j($s->json,false);
					?>
						<option value="<?php echo e($s->id); ?>" <?php if(getesit("id",$s->id)) echo "selected"; ?>><?php echo e($s->created_at); ?></option>
					<?php } ?>
					</select>
					<?php if(getisset("id") && !getesit("id","")) {
						$sorgu =  db("workers")->where("id",get("id"))->orderBy("id","DESC")->get();
					} ?>
					<?php $j = j($sorgu[0]->json); unset($j['_token']); //print_r($j);  ?>
					<script type="text/javascript">
					$(function(){
						<?php foreach($j AS $a => $d) { $a = str_replace("_"," ",$a); ?>
						$("[name='<?php echo e($a); ?>']").val("<?php echo e($d); ?>");
						<?php } ?>
					});
					</script>
					<form action="?workers-add&tab=1" class="seri" ajax=".workers-result" method="POST">
						<?php echo e(csrf_field()); ?>

						<?php echo e(e2("KW")); ?> :
						<input type="number" required min="1" max="52" name="KW" value="<?php echo e(date('W')); ?>" class="form-control">

						<?php echo e(e2("Department")); ?> :
						<select name="Department" required id="" class="form-control select2">
							<option value=""><?php echo e(e2("Select Department")); ?></option>
							<?php $department = contents("departments");  foreach($department AS $d) { ?>

							<option value="<?php echo e($d->title); ?>"><?php echo e($d->title); ?></option>
							<?php } ?>
						</select>

						<?php echo e(e2("Head of Department")); ?> :
						<select name="Head of Department" required id="" class="form-control select2">
							<option value=""><?php echo e(e2("Select User")); ?></option>
							<?php $user = users("Head of Department");  foreach($user AS $d) { ?>

							<option value="<?php echo e($d->name); ?> <?php echo e($d->surname); ?>"><?php echo e($d->name); ?> <?php echo e($d->surname); ?></option>
							<?php } ?>
						</select>

						<?php echo e(e2("Employees")); ?> : 
						<select name="Employees" required id="" class="form-control select2">
						<option value=""><?php echo e(e2("Select User")); ?></option>
							<?php $user = users("Worker");  foreach($user AS $d) { ?>
							
							<option value="<?php echo e($d->name); ?> <?php echo e($d->surname); ?>"><?php echo e($d->name); ?> <?php echo e($d->surname); ?></option>
							<?php } ?>
						</select>

						<?php echo e(e2("Function")); ?> :
						<input type="text" required name="Function" class="form-control">

						<?php echo e(e2("Temporary Workers ")); ?> :
						<select required name="Temporary Workers" id="" class="form-control">
							<option value=""><?php echo e(e2("Select")); ?></option>
							<option value="Leiharbeiter"><?php echo e(e2("Leiharbeiter")); ?></option>
							<option value="Stammmitarbeiter"><?php echo e(e2("Stammmitarbeiter")); ?></option>
							<!--<option value="Dauerkrank"><?php echo e(e2("Dauerkrank")); ?></option>
							<option value="Schulung / Seminar"><?php echo e(e2("Schulung / Seminar")); ?></option>-->
						</select>

						<?php echo e(e2("Presence")); ?> :
						<select required name="Presence" id="" class="form-control">
							<option value=""><?php echo e(e2("Select")); ?></option>
							<option value="Anwesend"><?php echo e(e2("Anwesend")); ?></option>
							<option value="Urlaub"><?php echo e(e2("Urlaub")); ?></option>
							<option value="Krank"><?php echo e(e2("Krank")); ?></option>
							<option value="Dauerkrank"><?php echo e(e2("Dauerkrank")); ?></option>
							<option value="Schulung / Seminar"><?php echo e(e2("Schulung / Seminar")); ?></option>
						</select>
						<?php echo e(e2("Remark")); ?> :
						<textarea name="Remark" required id="" cols="30" rows="10" class="form-control"></textarea>
						
						<button type="submit" class="btn btn-primary min-width-125 mt-20">Save</button>
					</form>
					<!-- /Workers -->
					<div class="workers-result" ajax2="admin.type.key-figures.list.workers">
						<?php echo $__env->make("admin.type.key-figures.list.workers", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>

					
				<?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/key-figures/workers.blade.php ENDPATH**/ ?>