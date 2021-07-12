<?php $sap = db("sap-planning")->where("id",get("id"))->first();
$j = j($sap->json);
 ?>
 <script>
$(document).ready(function(){
  $("#search").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".sap-planning .list-group-item").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<input type="search" name="" id="search" placeholder="<?php echo e(e2("Search...")); ?>" class="form-control" />
	<ul class="list-group sap-planning" style="position:relative">
	<?php $k=0;foreach($j['row'] AS $r) { ?>
	  <li class="list-group-item" ><div draggable="true" class="job" id="row-<?php echo e($k); ?>" ondragstart="drag(event)"><?php echo e(@$r[3]); ?> <?php echo e(@$r[6]); ?> <?php echo e(@$r[18]); ?></div></li>
	<?php $k++;} ?>
	</ul>
	
<style type="text/css">
	
</style><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin-ajax/sap-planning-detail2.blade.php ENDPATH**/ ?>