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
<input type="search" name="" id="search" placeholder="{{e2("Search...")}}" class="form-control" />
<div class="table-responsive">
	<table id="sap-detail" class="table table-bordered table-hover table-striped">
		<thead>
		<tr>
			<th></th>
		<?php foreach($j['col'] AS $c) { ?> 
			<th>{{$c}}</th>
		<?php } ?>
		</tr>
		</thead>
		<tbody>
			<?php 
			$k=0;
			foreach($j['row'] AS $r) {  ?>
			<?php if($k>0) {  ?>
			<tr>
				<td ><div draggable="true" ondragstart="drag(event)" label="{{$r[0]}} {{$r[0]}} {{$r[0]}}" id="row-{{$k}}" >{{$r[0]}}</div></td>
			<?php foreach($r AS $a) { ?>
				<td>{{$a}}</td>
			<?php } ?>
			</tr>
			
			<?php } ?>
			<?php $k++;} ?>
		</tbody>
	</table>
</div>