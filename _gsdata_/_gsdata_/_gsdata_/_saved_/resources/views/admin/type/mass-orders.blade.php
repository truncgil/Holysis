<?php $tab = explode(",","schamottepr,silikapr,handformerei");
$path = "admin.type.mass-orders.list";
foreach($tab AS $t) {
	if(getisset("$t-add")) {
		ekle(array(
			"json" => json_encode_tr($_POST)
		),$t."-mo");
		?>
		@include("$path.$t")
		<?php
		exit();
	}
}
 ?>
<?php $path = "admin.type.mass-orders"; ?>
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
					<a class="nav-link @if(1==$active) active @endif"  onclick="$('.SilicaPR-ajax').load('?ajax2={{$path}}.list.silikapr');" href="#silica">SilikaPR</a>
				</li>
				<li class="nav-item">
					<a class="nav-link @if(2==$active) active @endif"  onclick="$('.SchamottePR-ajax').load('?ajax2={{$path}}.list.schamottepr');"  href="#chamotte">SchamottePR</a>
				</li>
				<li class="nav-item">
					<a class="nav-link @if(2==$active) active @endif"  onclick="$('.handformerei-ajax').load('?ajax2={{$path}}.list.handformerei');"  href="#handformerei">Handformerei</a>
				</li>
				

			</ul>
			
			<div class="block-content tab-content">
				<div class="tab-pane active" id="silica" role="tabpanel">
					@include("$path.silica")
				</div>
				<div class="tab-pane" id="chamotte" role="tabpanel">
					@include("$path.schamotte")
				</div>
				<div class="tab-pane" id="handformerei" role="tabpanel">
					@include("$path.handformerei")
				</div>
				

			</div>
		</div>

</div>