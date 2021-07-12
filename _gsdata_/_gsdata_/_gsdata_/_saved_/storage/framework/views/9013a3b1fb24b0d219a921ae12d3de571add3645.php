<div class="custom-script">

<?php echo $__env->make("admin.type.planning.inc.style", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make("admin.type.planning.inc.script", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make("admin.type.planning.inc.customScript", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php 
$ay = 1;
$miktar = 30*$ay;

 ?>
<?php if(getisset("w")) { ?>
<script type="text/javascript">
$(function(){
	$(".vardiya").not(".tatil").empty();
	$(".popover").hide();
	
});
</script>
<?php } ?>
<div class="row">
<div class="col-12 navigation">
<?php 
$week = date("W");
if(getisset("week")) { 

	$week = get("week");
	
} 
$week2 = date("W")-(date("W")-($week-1));
$start = date("Y-m-d");//date('Y-m-d', strtotime("sunday $week2 week"));

if(getisset("start")) {
	$start = get("start");
}
if(getisset("miktar")) {
	$miktar = get("miktar");
}
$tatil = contents("configration-vacation-days");

$tatil2 = array();
foreach($tatil AS $t) {
	$tatil2[$t->date] = $t->title;
}
$tatil = $tatil2;

 ?>
 
 <?php 
 
 ?>
		<?php if(getisset("w")) { ?>
		<?php 
$workstation = str_replace("-workstations","",get("w"));
$workstation = str_replace("configration-","",$workstation);
$workstation = str_replace("handformerei","mass-mortel",$workstation);
$setupdown = db($workstation)
	->where("json->setupTime",">=",date("Y-m-d"))
	->orWhere("json->downTime",">=",date("Y-m-d"))
	->get();
$setupdown2=array();
foreach($setupdown AS $s) {
	$j = j($s->json);
	if($j['setupTime']!="") {
		$date = strtotime($j['setupTime']);
		$date = date("Y-m-d",$date);
		$setupdown2[@array_values($j)[1]][$date] = "<div class='setup'>{$j['setupTime']} - {$j['setupTimeTo']} Setup Time</div>";
		
	} elseif($j['downTime']!="") {
		$date = strtotime($j['downTime']);
		$date = date("Y-m-d",$date);
		$setupdown2[@array_values($j)[1]][$date] = "<div class='setup'>{$j['downTime']} - {$j['downTimeTo']} Down Time</div>";
		
	}
}
$setupdown = $setupdown2;
//print_r($setupdown);

?>
		<div class="navbar" style="margin-bottom: 10px;
    height: 35px;">
		<div class="float-left d-none">
				<input type="number" title="<?php echo e(e2("Week Number")); ?>" onchange="$('#nav-board').load('?ajax2=admin.type.planning.board&w=<?php echo e(get("w")); ?>&week='+$(this).val())" name="" min="1" max="52" value="<?php echo e($week); ?>" class="form-control week-number" id="" />
			</div>
		<div class="float-right gizle">
			
			
			<div class="input-group ">
			<select name="" id="" onchange="loader($(this).val())" style="width: 225px;
    margin-right: 10px;"  class="form-control">
				<option value=""><?php echo e(e2("Select History")); ?></option>
				<?php $planning = db("planning-board")->where("type",get("w"))->orderBy("id","DESC")->take(50)->get(); ?>
				<?php foreach($planning AS $p) { ?>
				<option value="<?php echo e($p->id); ?>"><?php echo e($p->title); ?> - <?php echo e($p->type); ?></option>
				<?php } ?>
			</select>
				<div class="btn btn-primary save"><i class="fa fa-save"></i> <?php echo e(e2("Save")); ?></div>
				<a href="#" class="btn btn-info new d-none" ><i class="fa fa-plus"></i> <?php echo e(e2("New Blank Board")); ?></a>
			</div>
		
		</div>
		<script type="text/javascript">
		$(function(){
			$(".new").on("click",function(){
				if(confirm('<?php echo e(e2('A new blank planning board will be created. Any data will not be deleted. You can access old data from History')); ?>')) {
					$.get('?new-board=<?php echo(get("w")); ?>',function(){
						$(".btn[value='<?php echo(get("w")); ?>']").trigger('click');
					});
				}
			});
		});
		</script>

		<?php } ?>
		
		<div class="float-left">
		<script type="text/javascript">
		$(function(){
			$("#workstation-select").unbind();
			$("#workstation-select").on("change",function(){
				$('#nav-board')
				//.slideUp("slow")
				.load('?ajax2=admin.type.planning.board&w='+$(this).val(),function(){
					//$('#nav-board').slideDown("slow");
				});
			});
			$(".workstation-btn .btn").unbind();
			$(".workstation-btn .btn").on("click",function(e){
				e.preventDefault();
				$(".workstation-btn .btn").removeClass("btn-danger").addClass("btn-primary");
				$(this).removeClass("btn-primary").addClass("btn-danger");
				
                
                $('#nav-board')
				.css("opacity","0")
				//.html('<div class="loading"><i class="fa fa-spin fa-spinner"></i></div>')
				.load('?ajax2=admin.type.planning.board&w='+$(this).attr("value"),function(){
					//$('#nav-board').fadeIn("slow");
					
        
                        $('#nav-board').css("opacity","1");
						
      
				});
                
                // ++ drag&drop eventListener'ları buraya gelecek
                
                /*
                $('.vardiya').on('dragstart',function(){ 
                    doOnDrag();
                });
				*/
			});
			$("[value='<?php echo e(get("w")); ?>']").removeClass("btn-primary").addClass("btn-danger");
		});
		</script>
		<div class="btn-group workstation-btn">
			<div value="silikapr-workstations" class="btn btn-primary"><?php echo e(e2("SilikaPR")); ?></div>
			<div value="schamottepr-workstations" class="btn btn-primary"><?php echo e(e2("SchamottePR")); ?></div>
			<div value="configration-handformerei" class="btn btn-primary"><?php echo e(e2("Handformerei")); ?></div>
			<div value="configration-endbearbeitung" class="btn btn-primary"><?php echo e(e2("Endbearbeitung")); ?></div>
		</div>
		<select name="" id="workstation-select"  class="form-control d-none">
			<option value=""><?php echo e(e2("Select Machine")); ?></option>
			<option value="silikapr-workstations"><?php echo e(e2("SilikaPR")); ?></option>
			<option value="schamottepr-workstations"><?php echo e(e2("SchamottePR")); ?></option>
			<option value="configration-handformerei"><?php echo e(e2("Handformerei")); ?></option>
			<option value="configration-endbearbeitung"><?php echo e(e2("Endbearbeitung")); ?></option>
		</select>
		</div>
		<div class="float-left gizle">
			<div class="input-group">
				<input type="date" name="" value="<?php echo e($start); ?>" class="form-control start" title=<?php echo e(e2('Start Date')); ?>" id="" />
				
				<input type="number" placeholder="<?php echo e(e2("Number of Days")); ?>" value="<?php echo e($miktar); ?>" class="form-control miktar" min="10" max="365" name="" id="" />
				<button class="btn btn-primary filter"><?php echo e(e2("Filter")); ?></button>
				<script type="text/javascript">
				$(function(){
					$(".filter").unbind().on("click",function(){
						$(this).html("<?php echo e(e2("Filtering...")); ?>").attr("disabled","disabled");
						$.get('?ajax2=admin.type.planning.board',{
							w : "<?php echo e(get("w")); ?>",
							start : $(".start").val(),
							miktar : $(".miktar").val()
						},function(d){
							$("#nav-board").html(d);
                            
						});
						
					});
				});
				</script>
			</div>
		</div>
		</div>
		<div class="navbar" style="width: 100%; padding-left: 15px;">
			<div class="form-check pull-left">
				<input type="checkbox" id="fixedDrag" name="fixedDrag" class="form-check-input" style="width: 20px; height: 20px;" />
				<label style="margin-left: 5px; padding-top: 3px;" for="fixedDrag"><?php echo e(e2('Fixed Drag')); ?></label>
			</div>
			<div class="form-check pull-left" style="margin-left: 10px;">
				<input type="checkbox" id="dragAll" name="dragAll" class="form-check-input" style="width: 20px; height: 20px;" />
				<label style="margin-left: 5px; padding-top: 3px;" for="dragAll"><?php echo e(e2('Drag All')); ?></label>
			</div>
            <div class="form-check pull-left" style="margin-left: 10px;">
				<input type="checkbox" id="resizableSelector" name="resizableSelector" class="form-check-input" style="width: 20px; height: 20px;" />
				<label style="margin-left: 5px; padding-top: 3px;" for="resizableSelector"><?php echo e(e2('Resizable Selector')); ?></label>
			</div>
			<div class="form-check pull-right" style="">
				<input type="checkbox" id="skipIntersections" name="skipIntersections" class="form-check-input" style="width: 20px; height: 20px;" checked />
				<label style="margin-left: 5px; padding-top: 3px;" for="skipIntersections"><?php echo e(e2('Skip Intersections')); ?></label>
			</div>
            <div class="form-check pull-right" style="margin-right: 10px;">
				<input type="checkbox" id="scrollNavigation" name="scrollNavigation" class="form-check-input" style="width: 20px; height: 20px;" checked />
				<label style="margin-left: 5px; padding-top: 3px;" for="scrollNavigation"><?php echo e(e2('Scroll Navigation')); ?></label>
			</div>
		</div>
		<?php if(getisset("w") && !getesit("w","")) {
			$w = get("w"); 
			?>
							
		<div class="table-responsive">
		
		<table border="1" cellpadding="1" cellspacing="0" style="width: initial !important" class="table table-bordered planning-board">
		<colgroup>
		<col span="2" style="width:300px" />
		
		</colgroup>
		 <tbody>
			

			 <tr height="20" style="height:15.0pt">
			  <td class="" colspan="2"  style="    width: 20% !important;
		"></td>
			  <?php for($k=0;$k<=$miktar+1;$k++) { ?>
			   <?php 
				$date = strtotime($start);
				$date2 = date('Y-m-d', strtotime("+$k day", $date));
				$date = date('d.m.Y', strtotime("+$k day", $date));
				
				 ?>
			 
			  <td colspan="6" class="tarih" style=""><?php echo e($date); ?> <?php if(isset($tatil[$date2])) echo "<div class='small'>({$tatil[$date2]})</div>"; ?></td>
			  <?php } ?>
			 </tr>
			 <tr height="20" style="height:15.0pt">
				 <td height="20"  colspan="2"></td>
			 <?php for($k=1;$k<=$miktar;$k++) { ?>
			   <?php 
				$date = strtotime($start);
				$a = $k-1;
				$date = date('D', strtotime("+$a day", $date)); 
				 ?>
			 
			  <td colspan="6" class="" ><div class="tarih"><?php echo e($date); ?></div></td>
			 <?php } ?> 
			 </tr>
			 <tr height="20" style="height:15.0pt">
				 <td height="20" colspan="2" class="" ></td>
			  <?php for($k=1;$k<=$miktar;$k++) { ?>
				<td colspan="6">
					<div class="vardiya-name">F</div>
					<div class="vardiya-name">S</div>
					<div class="vardiya-name">N</div>
				</td>
			  
			  
			  <?php } ?>
			 </tr>
		<?php 
		
		
		$slugs = explode(",",$w);
			$sorgu = db("contents")->whereIn("slug",$slugs)->orderBy("s","ASC")->get();
		foreach($sorgu AS $s) {  ?>
		<?php $alt = db("contents")->where("kid",$s->slug)->get(); ?>
		 <tr height="20" style="height:15.0pt">
		  <td rowspan="<?php echo e($alt->count()); ?>" class="machine td-title-ust" align="right" >
		  <div class="td-title d-none"><?php echo e($s->title); ?></div></td>
		 <?php foreach($alt AS $a) { ?>
		  <td height="20" class="workstation td-title-ust"><div class="td-title"><?php echo e($a->title); ?></div></td>
          <?php 
          $eq = 0;
          ?>
		  <?php for($k=1;$k<=$miktar;$k++) { ?>
		  <?php 
				$date = strtotime($start);
				$b = $k - 1;
				$date = date('Y-m-d', strtotime("+$b day", $date));
                $id = str_slug("{$a->title}-$date");
                $jid = 'asdasd';
                
		  ?>
		  <td colspan="6">
		  <?php 
		  $block = "";
		  $class = "";
		  if(isset($tatil[$date])){
			 $block = '<div class="block-zone tatil"></div>'; 
			 $class = "tatil";
		  }   ?>

          <?php 
            $unique_id = $id;
			//var_dump($s);
          ?>
		
			<div class="f-vardiya vardiya <?php echo e($class); ?>" data-jid="<?php echo e($jid); ?>"  data-unique="<?php echo e($unique_id); ?>" data-unique-eq="<?php echo e($eq); ?>"   ondrop="drop(event, $(this))" ondragover="allowDrop(event)" id="<?php echo e($id); ?>-f" vardiya="F" machine="<?php echo e($s->title); ?>" workstation="<?php echo e($a->title); ?>" date="<?php echo e($date); ?>"><?php echo $block ?></div>
			<div class="f-vardiya vardiya <?php echo e($class); ?>" data-jid="<?php echo e($jid); ?>"  data-unique="<?php echo e($unique_id); ?>" data-unique-eq="<?php echo e($eq+1); ?>" ondrop="drop(event, $(this))" ondragover="allowDrop(event)" id="<?php echo e($id); ?>-f2" vardiya="F" machine="<?php echo e($s->title); ?>" workstation="<?php echo e($a->title); ?>" date="<?php echo e($date); ?>"><?php echo $block ?></div>
			<div class="m-vardiya vardiya <?php echo e($class); ?>" data-jid="<?php echo e($jid); ?>"  data-unique="<?php echo e($unique_id); ?>" data-unique-eq="<?php echo e($eq+2); ?>" ondrop="drop(event, $(this))" ondragover="allowDrop(event)" id="<?php echo e($id); ?>-m" vardiya="S" machine="<?php echo e($s->title); ?>" workstation="<?php echo e($a->title); ?>" date="<?php echo e($date); ?>"><?php echo $block ?></div>
			<div class="m-vardiya vardiya <?php echo e($class); ?>" data-jid="<?php echo e($jid); ?>"  data-unique="<?php echo e($unique_id); ?>" data-unique-eq="<?php echo e($eq+3); ?>" ondrop="drop(event, $(this))" ondragover="allowDrop(event)" id="<?php echo e($id); ?>-m2" vardiya="S" machine="<?php echo e($s->title); ?>" workstation="<?php echo e($a->title); ?>" date="<?php echo e($date); ?>"><?php echo $block ?></div>
			<div class="n-vardiya vardiya <?php echo e($class); ?>" data-jid="<?php echo e($jid); ?>"  data-unique="<?php echo e($unique_id); ?>" data-unique-eq="<?php echo e($eq+4); ?>" ondrop="drop(event, $(this))" ondragover="allowDrop(event)" id="<?php echo e($id); ?>-n" vardiya="N" machine="<?php echo e($s->title); ?>" workstation="<?php echo e($a->title); ?>" date="<?php echo e($date); ?>"><?php echo $block ?></div>
			<div class="n-vardiya vardiya <?php echo e($class); ?>" data-jid="<?php echo e($jid); ?>"  data-unique="<?php echo e($unique_id); ?>" data-unique-eq="<?php echo e($eq+5); ?>" ondrop="drop(event, $(this))" ondragover="allowDrop(event)" id="<?php echo e($id); ?>-n2" vardiya="N" machine="<?php echo e($s->title); ?>" workstation="<?php echo e($a->title); ?>" date="<?php echo e($date); ?>"><?php echo $block ?></div>
		  </td>
          <?php 
            $eq += 6;
          ?>
		  <?php } ?>
		 </tr>

		 <?php } ?>

		<?php } ?>
		 
		</tbody></table>
		
		</div>
		
</div>
	<div class="col-12  gizle">
	<script type="text/javascript">
	$(function(){
		
		//mevcut pencerede process listin sürüklenebilir kılar
		 $("#process-modal .modal-content").draggable({ 
			 handle : ".block-header"
		 }).resizable();
		 var win;
		 $(".process-external").on("click",function(){
			  win = window.open('?process&w=<?php echo e(get("w")); ?>', "external_window", "toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=780,height=500,top="+(0)+",left="+(screen.width-840));
			  
		 });
		 
		 $(".process-list-button").on("click",function(){
			jobEvent(); 
		 });
		 function windowReload() {
			 win.location.reload();
		 }
	});
	</script>

	 <div class="modal fade" id="process-modal" tabindex="-1">
            <div class="modal-dialog modal-lg" >
                <div class="modal-content">
                    <div class="block block-themed block-transparent mb-0">
                        <div class="block-header bg-primary-dark">
                            <h3 class="block-title"><?php echo e(e2("Process List")); ?></h3>
                            <div class="block-options">
                                <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                    <i class="si si-close"></i>
                                </button>
                                <button type="button" class="btn-block-option">
                                   <i class="fa fa-resize"></i>
                                </button>
                            </div>
                        </div>
                        <div class="block-content">
							<div class="plan-ajax" style="background:#fff;">
					
							</div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
<button href="#process-modal" class="btn btn-primary process-list-button" data-backdrop="false" data-toggle="modal"><?php echo e(e2("Process List")); ?></button>
<button class="btn btn-primary process-external" ><?php echo e(e2("Process List with New Window")); ?></button>
	
	
		<div class="row d-none">
				<p><?php echo e(e2("Widgets")); ?></p>
			<div class="col-md-12">
				
			</div>
			<div class="col-md-3 d-none">
				<div class="widgets">
					<div class="blocked" draggable="true" id="blocked-1" ondragstart="drag(event)"><textarea name="" id="" cols="30" rows="10"><?php echo e(e2("Blocked Zone")); ?></textarea></div>
				</div>
			</div>
		</div>
	</div>
	<?php } ?>
</div>

<!-- The Modal -->
<div class="modal" id="job-detail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title"><span class="title"></span> Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <div class="detail">
			<table class="table table-bordered table-hover table-striped"></table>
		</div>
		<?php echo e(e2("Select Shift")); ?>

		<div class="row text-center">

			<div class="col-lg-4">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" name="Schicht[]" class="css-control-input" value="F" checked="">
					<span class="css-control-indicator"></span> <?php echo e(e2("Früh")); ?>

				</label>
			</div>
			<div class="col-lg-4">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" name="Schicht[]" class="css-control-input" value="S" checked="">
					<span class="css-control-indicator"></span> <?php echo e(e2("Spät")); ?>

				</label>
			</div>
			<div class="col-lg-4">
				<label class="css-control css-control-primary css-checkbox">
					<input type="checkbox" name="Schicht[]" class="css-control-input" value="N" checked="">
					<span class="css-control-indicator"></span> <?php echo e(e2("Nacht")); ?>

				</label>
			</div>
		</div>
		<div class="select-workstation d-none">
		<?php echo e(e2("Select Workstation")); ?>

		<select name="" id="" class="form-control">
		<?php if(isset($alt)) { ?>
		<?php foreach($alt AS $a) { ?>
				<option value="<?php echo e($a->title); ?>"><?php echo e($a->title); ?></option>
		<?php } ?>
		<?php } ?>
			</select></div>
		<?php echo e(e2("Total")); ?>

		<input type="number" step="any" name="Bedarfsmenge SD" value="" class="form-control" readonly disabled required id="BedarfsmengeSD" />
		<?php echo e(e2("How many of this product can be produced in one shift?")); ?>

		<input type="number" step="any" name="qty"  value="" class="form-control" required id="qty" />
		<br />
		<div class="btn btn-primary" onclick="calculate()"><?php echo e(e2("Calculate")); ?></div>
		<div class="btn-group">
			<div class="btn btn-warning one_shift"></div>
			<div class="btn btn-warning">+</div>
			<div class="btn btn-warning one_shift_kalan"></div>
		</div>
      </div>
	  <script type="text/javascript">
	  
	  </script>

      <!-- Modal footer -->
      <div class="modal-footer">
		<div class="finish">
			<label class="css-control css-control-success css-checkbox">
				<input type="checkbox" class="css-control-input">
				<span class="css-control-indicator"></span> <?php echo e(e2("Finished")); ?>

			</label>

		</div>
		<div class="finish2 d-none">
			<label class="css-control css-control-success css-checkbox">
				<input type="checkbox" class="css-control-input">
				<span class="css-control-indicator"></span> <?php echo e(e2("Preliminary Stage is finished?")); ?>

			</label>
			
		</div>
        <button type="button" class="btn btn-danger delete d-none" ><?php echo e(e2("Delete from Planning Board")); ?></button>
        <button type="button" class="btn btn-success schedule d-none" data-dismiss="modal"><?php echo e(e2("Schedule")); ?></button>
        <button type="button" class="btn btn-info" data-dismiss="modal"><?php echo e(e2("Close")); ?></button>
      </div>

    </div>
  </div>
</div>
<div class="scroll-to-left scroll-to">
    <i class="fas fa-chevron-left"></i>
</div>
<div class="scroll-to-right scroll-to">
    <i class="fas fa-chevron-right"></i>
</div>
<?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/planning/board.blade.php ENDPATH**/ ?>