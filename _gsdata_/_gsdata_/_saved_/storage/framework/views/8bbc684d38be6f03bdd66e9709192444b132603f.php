<?php $path = "admin.type.key-figures.list"; ?>
<h4 class="font-w400"><?php echo e(e2("Setuptime - Downtime")); ?></h4>
				<p>
					<!-- Setup Times -->
					<!-- Block Tabs Alternative Style -->
					<div class="block">
						<ul class="nav nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" onclick="$('.silikapr-ajax').load('?ajax2=<?php echo e($path); ?>.silikapr');" href="#setup-SilikaPR">SilikaPR</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" onclick="$('.schamottepr-ajax').load('?ajax2=<?php echo e($path); ?>.schamottepr');" href="#setup-chamotte">SchamottePR</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" onclick="$('.schamottepr-ajax').load('?ajax2=<?php echo e($path); ?>.mass-mortel');" href="#mass-mortel">Mass & Mörtel</a>
							</li>
							<li class="nav-item">
								<a class="nav-link"  onclick="$('.endbearbeitung-ajax').load('?ajax2=<?php echo e($path); ?>.endbearbeitung');" href="#endbearbeitung">Endbearbeitung</a>
							</li>
						</ul>
						<div class="block-content tab-content">
							<div class="tab-pane active" id="setup-SilikaPR" role="tabpanel">
							<form action="?silikapr-add" class="seri" ajax=".silikapr-ajax" method="post">
							<?php echo e(csrf_field()); ?>

								<h4 class="font-w400">SilikaPR <?php echo e(e2("Setuptime - Downtime")); ?></h4>
								<p>
									<!-- SilikaPR -->
							
							
									<div class="form-group row">
										<label class="col-12" for="department"><?php echo e(e2("Workstation")); ?></label>
										<div class="col-md-9">
											<select name="SilikaPR-Workstation" id="SilikaPR-Workstation" required class="select2 form-control">
												<option value=""><?php echo e(e2("Please Select")); ?></option>
												<?php $department = contents("silikapr-workstations");  foreach($department AS $d) { ?>

												<option value="<?php echo e($d->title); ?>"><?php echo e($d->title); ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									
									<div class="form-group row mt-20">
										<div class="col-lg-8">
										<div class="row">
											<div class="col-6"><label class="col-12" for="example-daterange1">Setup Time</label></div>
										</div>
											
											<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
												<input type="text" class="form-control datetimepicker" id="setupTime" name="setupTime" placeholder="From" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="setupTime"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
												<div class="input-group-prepend input-group-append">
													<span class="input-group-text font-w600">-to-</span>
												</div>
												<input type="text" class="form-control datetimepicker" id="setupTimeTo" name="setupTimeTo" placeholder="To" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="setupTimeTo"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group row mt-20">
										<div class="col-lg-8">
										<div class="row">
											<div class="col-6"><label class="col-12" for="example-daterange1">Downtime</label></div>
										</div>
											<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
												<input type="text" class="form-control datetimepicker" id="downTime" name="downTime" placeholder="From" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="downTime"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
												<div class="input-group-prepend input-group-append">
													<span class="input-group-text font-w600">-to-</span>
												</div>
												<input type="text" class="form-control datetimepicker" id="downTimeTo" name="downTimeTo" placeholder="To" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="downTimeTo"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
											</div>
										</div>
									</div>
									
									<button type="submit" class="btn btn-primary min-width-125 mt-20"><?php echo e(e2("Save")); ?></button>
									
									<!-- /SilikaPR -->
								</p>
								</form>
								<div class="silikapr-ajax" ajax2="<?php echo e($path); ?>.silikapr"></div>
							</div>
							<div class="tab-pane" id="setup-chamotte" role="tabpanel">
							<form action="?schamottepr-add" class="seri" ajax=".schamottepr-ajax" method="post">
							<?php echo e(csrf_field()); ?>

								<h4 class="font-w400">SchamottePR <?php echo e(e2("Setuptime - Downtime")); ?></h4>
								<p>
									<!-- SchamottePR -->
							
							
									<div class="form-group row">
										<label class="col-12" for="department"><?php echo e(e2("Workstation")); ?></label>
										<div class="col-md-9">
											<select name="SchamottePR-Workstation" id="SchamottePR-Workstation" required class="select2 form-control">
												<option value=""><?php echo e(e2("Please Select")); ?></option>
												<?php $department = contents("schamottepr-workstations");  foreach($department AS $d) { ?>

												<option value="<?php echo e($d->title); ?>"><?php echo e($d->title); ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									
									<div class="form-group row mt-20">
										<div class="col-lg-8">
										<div class="row">
											<div class="col-6"><label class="col-12" for="example-daterange1">Setup Time</label></div>
										</div>
											
											<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
												<input type="text" class="form-control datetimepicker" id="setupTime" name="setupTime" placeholder="From" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="setupTime"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
												<div class="input-group-prepend input-group-append">
													<span class="input-group-text font-w600">-to-</span>
												</div>
												<input type="text" class="form-control datetimepicker" id="setupTimeTo" name="setupTimeTo" placeholder="To" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="setupTimeTo"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group row mt-20">
										<div class="col-lg-8">
										<div class="row">
											<div class="col-6"><label class="col-12" for="example-daterange1">Downtime</label></div>
										</div>
											<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
												<input type="text" class="form-control datetimepicker" id="downTime" name="downTime" placeholder="From" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="downTime"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
												<div class="input-group-prepend input-group-append">
													<span class="input-group-text font-w600">-to-</span>
												</div>
												<input type="text" class="form-control datetimepicker" id="downTimeTo" name="downTimeTo" placeholder="To" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="downTimeTo"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
											</div>
										</div>
									</div>
									
									<button type="submit" class="btn btn-primary min-width-125 mt-20"><?php echo e(e2("Save")); ?></button>
									
									<!-- /SchamottePR -->
								</p>
							</form>
							<div class="schamottepr-ajax" ajax2="<?php echo e($path); ?>.schamottepr"></div>
							
							</div>
							<div class="tab-pane" id="mass-mortel" role="tabpanel">
							<form action="?mass-mortel-add" class="seri" ajax=".mass-mortel-ajax" method="post">
							<?php echo e(csrf_field()); ?>

								<h4 class="font-w400"><?php echo e(e2("Mass & Mortar")); ?> <?php echo e(e2("Setuptime - Downtime")); ?></h4>
								<p>
									<!-- SchamottePR -->
							
							
									<div class="form-group row">
										<label class="col-12" for="department"><?php echo e(e2("Workstation")); ?></label>
										<div class="col-md-9">
											<select name="mass-mortar-Workstation" id="mass-mortar-Workstation" required  class="select2 form-control">
												<option value=""><?php echo e(e2("Please Select")); ?></option>
												<?php $department = contents("mass-mortar-workstations");  foreach($department AS $d) { ?>

												<option value="<?php echo e($d->title); ?>"><?php echo e($d->title); ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									
									<div class="form-group row mt-20">
										<div class="col-lg-8">
										<div class="row">
											<div class="col-6"><label class="col-12" for="example-daterange1">Setup Time</label></div>
										</div>
											
											<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
												<input type="text" class="form-control datetimepicker" id="setupTime" name="setupTime" placeholder="From" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="setupTime"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
												<div class="input-group-prepend input-group-append">
													<span class="input-group-text font-w600">-to-</span>
												</div>
												<input type="text" class="form-control datetimepicker" id="setupTimeTo" name="setupTimeTo" placeholder="To" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="setupTimeTo"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group row mt-20">
										<div class="col-lg-8">
										<div class="row">
											<div class="col-6"><label class="col-12" for="example-daterange1">Downtime</label></div>
										</div>
											<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
												<input type="text" class="form-control datetimepicker" id="downTime" name="downTime" placeholder="From" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="downTime"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
												<div class="input-group-prepend input-group-append">
													<span class="input-group-text font-w600">-to-</span>
												</div>
												<input type="text" class="form-control datetimepicker" id="downTimeTo" name="downTimeTo" placeholder="To" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="downTimeTo"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
											</div>
										</div>
									</div>
									
									<button type="submit" class="btn btn-primary min-width-125 mt-20"><?php echo e(e2("Save")); ?></button>
									
									<!-- /SchamottePR -->
								</p>
							</form>
								<div class="mass-mortel-ajax" ajax2="<?php echo e($path); ?>.mass-mortel"></div>
							</div>
							<div class="tab-pane" id="endbearbeitung" role="tabpanel">
							<form action="?endbearbeitung-add" class="seri" ajax=".endbearbeitung-ajax"  method="post">
							<?php echo e(csrf_field()); ?>

								<h4 class="font-w400"><?php echo e(e2("Endbearbeitung")); ?> <?php echo e(e2("Setuptime - Downtime")); ?></h4>
								<p>
									<!-- SchamottePR -->
							
							
									<div class="form-group row">
										<label class="col-12" for="department"><?php echo e(e2("Workstation")); ?></label>
										<div class="col-md-9">
											<select name="Endbearbeitung-Workstation" id="endbearbeitung-Workstation" required class="select2 form-control">
												<option value=""><?php echo e(e2("Please Select")); ?></option>
												<?php $department = contents("configration-endbearbeitung");  foreach($department AS $d) { ?>

												<option value="<?php echo e($d->title); ?>"><?php echo e($d->title); ?></option>
												<?php } ?>
											</select>
										</div>
									</div>
									
									<div class="form-group row mt-20">
										<div class="col-lg-8">
										<div class="row">
											<div class="col-6"><label class="col-12" for="example-daterange1">Setup Time</label></div>
										</div>
											
											<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
												<input type="text" class="form-control datetimepicker" id="setupTime" name="setupTime" placeholder="From" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="setupTime"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
												<div class="input-group-prepend input-group-append">
													<span class="input-group-text font-w600">-to-</span>
												</div>
												<input type="text" class="form-control datetimepicker" id="setupTimeTo" name="setupTimeTo" placeholder="To" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="setupTimeTo"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group row mt-20">
										<div class="col-lg-8">
										<div class="row">
											<div class="col-6"><label class="col-12" for="example-daterange1">Downtime</label></div>
										</div>
											<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
												<input type="text" class="form-control datetimepicker" id="downTime" name="downTime" placeholder="From" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="downTime"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
												<div class="input-group-prepend input-group-append">
													<span class="input-group-text font-w600">-to-</span>
												</div>
												<input type="text" class="form-control datetimepicker" id="downTimeTo" name="downTimeTo" placeholder="To" data-week-start="1" data-autoclose="true"
													data-today-highlight="true">
												<div class="input-group-append">
													<label for="downTimeTo"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
												</div>
											</div>
										</div>
									</div>
									
									<button type="submit" class="btn btn-primary min-width-125 mt-20"><?php echo e(e2("Save")); ?></button>
									
									<!-- /SchamottePR -->
								</p>
							</form>
							<div class="endbearbeitung-ajax" ajax2="<?php echo e($path); ?>.endbearbeitung"></div>
									
							</div>
						</div>
					</div>
					<!-- END Block Tabs Alternative Style -->
					
					
					
					<!-- /Setup Times -->
				</p><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/key-figures/setupdown.blade.php ENDPATH**/ ?>