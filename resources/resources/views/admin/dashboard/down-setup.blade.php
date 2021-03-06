
	<div class="col-12">
						<div class="block ">
							<div class="block-header">
								{{e2("List by date range")}}
							</div>
							<div class="block-content">
								<form action="" method="get">
									<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
										<input type="text" class="form-control datetimepicker" id="downTime" name="start" value="{{get("start")}}" placeholder="{{e2("From")}}" data-week-start="1" data-autoclose="true"
											data-today-highlight="true">
										<div class="input-group-append">
											<label for="downTime"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
										</div>
										<div class="input-group-prepend input-group-append">
											<span class="input-group-text font-w600">-{{e2("to")}}-</span>
										</div>
										<input type="text" class="form-control datetimepicker" id="downTimeTo" name="end" value="{{get("end")}}" placeholder="{{e2("To")}}" data-week-start="1" data-autoclose="true"
											data-today-highlight="true">
										<div class="input-group-append">
											<label for="downTimeTo"><span class="input-group-text"><i class="fas fa-calendar-alt"></i></span></label>
										</div>
										<button class="btn btn-primary">{{e2("Filter")}}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					<?php $dizi = explode(",","SilikaPR,SchamottePR,mass-mortel,Endbearbeitung");
					foreach($dizi AS $d) {
						$db = str_slug($d);
						$id = str_slug($d);
						$module = $d;
						if($d=="mass-mortel") {
							$d = "mass-mortar";
						}
						
						
					?>
						<?php $sorgu = db($db);
						if(getisset("start")) {
							$sorgu = whereJ($sorgu,"setupTime",">=","DATE('{$_GET['start']}')","DATE");
							$sorgu = whereJ($sorgu,"setupTime","<=","DATE('{$_GET['end']}')","DATE");
						} else {
							$sorgu = whereJ($sorgu,"setupTime","=","MONTH(NOW())","MONTH");
							$sorgu = orwhereJ($sorgu,"downTime","=","MONTH(NOW())","MONTH");
						//	$sorgu = whereJ($sorgu,"setupTime",">=","MONTH(NOW())","MONTH");
						}
						$sorgu = $sorgu->get();
						//echo $sorgu; exit();
							$setup = 0;
							$down = 0;
							$divide = 360;
							$work = array();
							foreach($sorgu AS $s) {
						//		print_r($s);
								$j = j($s->json);
								
								$col = $d."-Workstation";
							//	echo($col);
								if(isset($j["$col"])) {
									$col = $j["$col"];
									$setup1 = strtotime($j['setupTime']);
									$setup2 = strtotime($j['setupTimeTo']);
									$down1 = strtotime($j['downTime']);
									$down2 = strtotime($j['downTimeTo']);
									$setup += @round(($setup2 - $setup1)/$divide,0);
									if($setup=="") $setup=0;
									$down += @round(($down2 - $down1)/$divide,0);
									if($down=="") $down=0;
									$work[$col]['down'] = $down;
									$work[$col]['setup'] = $setup;	
								}
								
							}
						//	echo "$setup $down";
					
						 ?>
						 <div class="col-12  col-sm-6  col-md-6 col-lg-6 col-xl-3">
					<div class="block">
						<div class="block-header">{{e2("$d Down Time - Setup Time (%)")}}</div>
						
						<div class="block-content">	 
						<div class="text-center">
							<div class="row">
							<?php 
							$labels = array();
							$downs = array();
							$setups = array();
							foreach($work AS $w => $d) { 
                                if($d['down']==0) $d['down']=1;
                                if($d['setup']==0) $d['setup']=1;
								$tam = $d['down'] + $d['setup'];
								$yuzde = @round((100*$d['down'])/$tam,2);
								if($yuzde=="") $yuzde = 0;
								array_push($labels,"'$w'");
								array_push($downs,$d['down']);
								array_push($setups,$d['setup']);
							} 
							$yuzde_downs = array_sum($downs);
							$yuzde_setups = array_sum($setups);
							//echo "$yuzde_downs $yuzde_setups";
							$downs2 = array();
							$setups2 = array();
							foreach($downs AS $xx) {
								array_push($downs2,@round($xx*100/$yuzde_downs,2));
							}
							foreach($setups AS $xx) {
								array_push($setups2,@round($xx*100/$yuzde_setups,2));
							}
							$downs = $downs2;
							$setups = $setups2;
							
							
							?>
								<div class="col-12 col-lg-12">
									<?php $title = "Setup Time"; $type="Setup";  $values = $setups; $id = "$id-setup"; $table="$db"; ?>
									@include("admin.chart.picker")
									<div class="pie-ajax{{$id}}">
									@include("admin.chart.pie")
									</div>
								</div>
								<div class="col-12 col-lg-12">
								<hr />
									<?php $title = "Down Time"; $type="Down";  $values = $downs; $id = "$id-down"; $table="$db";  ?>
									@include("admin.chart.picker")
									<div class="pie-ajax{{$id}}">
									@include("admin.chart.pie")
									</div>	
								</div>
								
							
							</div>
							
						</div>
						</div>
				</div>
				</div>
					<?php } ?>