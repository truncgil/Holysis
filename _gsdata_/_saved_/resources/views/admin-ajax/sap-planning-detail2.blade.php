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
<input type="search" name="" id="search" placeholder="{{e2("Search...")}}" class="form-control" />
	<ul class="list-group sap-planning" style="position:relative">
	<?php $k=0;foreach($j['row'] AS $r) { ?>
	  <li class="list-group-item" ><div draggable="true" class="job" id="row-{{$k}}" ondragstart="drag(event)">{{@$r[3]}} {{@$r[6]}} {{@$r[18]}}</div></li>
	<?php $k++;} ?>
	</ul>
	
<style type="text/css">
	
</style>