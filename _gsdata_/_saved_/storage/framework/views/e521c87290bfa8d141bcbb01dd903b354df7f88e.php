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

<script type="text/javascript">
$(function(){
		var data = [];
        <?php 
		$k=0;
		foreach($j['row'] AS $r) { ?>
		<?php if($k>0) { ?>
		<?php 
		$data = array();
		foreach($r AS $a) {
			$a = trim($a);
			array_push($data,$a);
		} ?>
            data.push(  <?php echo json_encode_tr($data);	?>  );
		<?php } ?>
        <?php $k++; } ?>
		$.fn.dataTable.ext.errMode = 'none';
	$('#sap-detail').on( 'processing.dt', function ( e, settings, processing ) {
        $('.loading').css( 'display', processing ? 'block' : 'none' );
    } );
    $('#sap-detail').DataTable({
		data : data,
		deferRender:    true
	});
});
</script>
<input type="search" name="" id="search" placeholder="<?php echo e(e2("Search...")); ?>" class="form-control d-none" />
<div class="table-responsive">
	<table id="sap-detail" class="table table-bordered table-hover table-striped" >
		<thead>
		<tr>
		<?php foreach($j['col'] AS $c) { ?>
			<th><?php echo e($c); ?></th>
		<?php } ?>
		</tr>
		</thead>
		<tbody>
	
			
		</tbody>
	</table>
</div>
<div class="loading"><i class="fa fa-spin fa-spinner"></i></div>
<?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin-ajax/sap-planning-drag2.blade.php ENDPATH**/ ?>