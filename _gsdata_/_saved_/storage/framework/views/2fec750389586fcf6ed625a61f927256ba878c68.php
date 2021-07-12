<?php use App\Contents; ?>
<?php 
$path = "admin.type.key-figures.list";
$tabs = explode(",","workers,silikapr,schamottepr,mass-mortel,endbearbeitung");
foreach($tabs AS $t) {
	if(getisset("$t-add")) {
		ekle(array(
			"json" => json_encode_tr($_POST)
		),"$t");
		?>
		<?php echo $__env->make("$path.$t", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
		<?php
		exit();
	} 	
}

?>
<?php
$active = 1;
if(getisset("active")) {
	$active = get("active");
}
?>
<div class="content">
	<div class="block">
		<ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
			<li class="nav-item">
				<a class="nav-link <?php if(1==$active): ?> active <?php endif; ?>" href="#nav-workers">Workers (Mitarbeiter)</a>
			</li>
			<li class="nav-item d-none">
				<a class="nav-link <?php if(2==$active): ?> active <?php endif; ?>" href="#nav-mass">Mass & Mortar</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if(3==$active): ?> active <?php endif; ?>" href="#nav-setup">
					Setup - Down
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link <?php if(4==$active): ?> active <?php endif; ?>" href="#nav-sap">
					SAP
				</a>
			</li>
		</ul>
		<?php $path = "admin.type.key-figures"; ?>
		<div class="block-content tab-content">
			<div class="tab-pane <?php if(1==$active): ?> active <?php endif; ?>" id="nav-workers" role="tabpanel">
				<?php echo $__env->make("$path.workers", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				
			</div>
			<div class="tab-pane <?php if(2==$active): ?> active <?php endif; ?>" id="nav-mass" role="tabpanel">
				
			</div>
			<div class="tab-pane <?php if(3==$active): ?> active <?php endif; ?>" id="nav-setup" role="tabpanel">
				<?php echo $__env->make("$path.setupdown", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
			<div class="tab-pane <?php if(4==$active): ?> active <?php endif; ?>" id="nav-sap" role="tabpanel">
				<?php echo $__env->make("$path.sap", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
			</div>
		</div>
		
		
	
    
</div></div>

<!--
<div class="form-group row">
    <label class="col-12" for="example-daterange1">Down-Time</label>
    <div class="col-lg-8">
        <div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
            <input type="datetime-local" class="form-control" id="example-daterange1" name="example-daterange1" placeholder="From" data-week-start="1" data-autoclose="true"
                data-today-highlight="true">
            <div class="input-group-prepend input-group-append">
                <span class="input-group-text font-w600">to</span>
            </div>
            <input type="datetime-local" class="form-control" id="example-daterange2" name="example-daterange2" placeholder="To" data-week-start="1" data-autoclose="true"
                data-today-highlight="true">
        </div>
    </div>
</div>

--><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin/type/key-figures.blade.php ENDPATH**/ ?>