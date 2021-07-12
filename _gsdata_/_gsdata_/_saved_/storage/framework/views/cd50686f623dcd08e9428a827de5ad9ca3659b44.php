<?php $sap = db("sap-planning")->where("id",get("id"))->first();
$j = j($sap->json);
 ?>
 <script>
$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#sap-detail tbody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<input type="search" name="" id="search" placeholder="<?php echo e(e2("Search...")); ?>" class="form-control" />
<div class="table-responsive">
	<table id="sap-detail" class="table table-bordered table-hover table-striped">
		<thead>
		<tr>
		
		<?php foreach($j['col'] AS $c) { ?> 
			<th><?php echo e(($c)); ?></th>
		<?php } ?>
		</tr>
		</thead>
		<tbody>
			<?php 
			$k=0;
			foreach($j['row'] AS $r) { ?>
			<tr>
			<?php foreach($r AS $a => $d) { ?>
				<?php if($a=="Color") { ?>
					<td style="background:<?php echo e($d); ?>">
						
					</td>
				<?php } else { ?>
					<td><?php echo e($d); ?></td>
				<?php } ?>
			<?php } ?>
			</tr>
			<?php if($k>100) break; ?>
			<?php $k++; } ?>
		</tbody>
	</table>
</div><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin-ajax/sap-planning-detail3.blade.php ENDPATH**/ ?>