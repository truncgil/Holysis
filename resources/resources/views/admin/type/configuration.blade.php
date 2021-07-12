<?php use App\Contents;
if(getisset("add")) {
	
	$c = new Contents;
	$c->kid = get("add");
	$c->slug = rand(111111,9999999);
	$c->save();
	
}
$active = 1;
if(getisset("active")) {
	$active = get("active");
}
 ?>

<div class="content">
	<div class="block">
	
		<?php $conf = contents("configrations"); ?>
		<ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">   
		<?php $k=0;  foreach($conf AS $c) {  $k++; ?>
				<li class="nav-item">
					<a class="nav-link @if($k==$active) active @endif" href="#{{$c->slug}}">{{e2($c->title)}}</a>
				</li>
		<?php } ?>
			
				
		</ul>
		<div class="block-content tab-content">
				<?php $k=0;  foreach($conf AS $c) {  $k++;  ?>
			
					<div class="tab-pane @if($k==$active) active @endif" id="{{$c->slug}}" role="tabpanel">
						 <h4 class="content-heading text-black">{{e2($c->title)}}</h4>
						<div class="row items-push">
							<div class="col-lg-3">
								<p class="text-muted">
									{{e2(("All {$c->title} definitions"))}}
								</p>
							</div>
							
							<div class="col-lg-7 offset-lg-1">
							@if($c->slug=="configuration-countries")
							<?php 
							
							$alt = contents($c->slug); 
							$varmi = array();
							foreach($alt AS $a) {
								array_push($varmi,$a->title);
							}
							foreach(countries() AS $co) {
								if(!in_array($co,$varmi)) {
									ekle([
										"title" => $co,
										"title2" => "group1",
										"kid" => "configuration-countries"
									],"contents");
								}
							}
							$alt = contents($c->slug); 
							foreach($alt AS $a) { ?>
								<div class="form-group row" id="t{{$a->id}}">
									<div class="col-12">
										<div class="input-group"> 
											<input type="text" class="form-control form-control-lg edit" placeholder="{{e2("Title")}}"  name="title" id="{{$a->id}}" table="contents"  value="{{$a->title}}">
										@if($c->slug=="configuration-countries")
											<select class="form-control edit" name="title2" id="{{$a->id}}" table="contents">
												<option value="">Select Group</option>
											<?php for($k=1;$k<=3;$k++) { ?>
												<option value="group{{$k}}" <?php if($a->title2=="group".$k) echo "selected"; ?>>Group {{$k}}</option>
											<?php } ?>
											</select>
										@endif
							

										
										
											<div class="input-group-append">
												<a href="{{ url('admin/contents/'. $a->id .'/delete') }}" ajax="#t{{$a->id}}" teyit="{{$a->title}} {{__('are you sure?')}}" title="{{$a->title}} {{__('Silinecek!')}}" class=" btn  btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
													<i class="fa fa-times"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
							@else
							<?php $alt = contents($c->slug); foreach($alt AS $a) { ?>
								<div class="form-group row" id="t{{$a->id}}">
									<div class="col-12">
										<div class="input-group"> 
											<input type="text" class="form-control form-control-lg edit" <?php if($a->html!="") echo "readonly"; ?> placeholder="{{e2("Title")}}"  name="title" id="{{$a->id}}" table="contents"  value="{{$a->title}}">
										@if($c->slug=="configuration-countries")
											<select class="form-control edit" name="title2" id="{{$a->id}}" table="contents">
												<option value="">Select Group</option>
											<?php for($k=1;$k<=3;$k++) { ?>
												<option value="group{{$k}}" <?php if($a->title2=="group".$k) echo "selected"; ?>>Group {{$k}}</option>
											<?php } ?>
											</select>
										@endif
										@if($c->slug=="configuration-mail-template")
											<input type="text" class="form-control form-control-lg edit" placeholder="{{e2("Subject")}}"  name="title2" id="{{$a->id}}" table="contents"  value="{{$a->title2}}">

											<textarea name="html" cols="30" rows="2" id="{{$a->id}}" placeholder="Mail Body" table="contents" class="form-control edit">{{$a->html}}</textarea>
										@endif
										@if($c->slug=="configuration-variables")

											<textarea name="html" cols="30" rows="2" id="{{$a->id}}" placeholder="Value" table="contents" class="form-control edit">{{$a->html}}</textarea>
										@endif
							

										
										
											<div class="input-group-append">
												<a href="{{ url('admin/contents/'. $a->id .'/delete') }}" ajax="#t{{$a->id}}" teyit="{{$a->title}} {{__('are you sure?')}}" title="{{$a->title}} {{__('Silinecek!')}}" class=" btn  btn-secondary js-tooltip-enabled" data-toggle="tooltip" title="" data-original-title="Delete">
													<i class="fa fa-times"></i>
												</a>
											</div>
										</div>
									</div>
								</div>
							<?php } ?>
								<a href="?add={{$c->slug}}&active={{$k}}" class="btn btn-primary"><i class="fa fa-plus"></i></a>
							@endif	
							</div>
						</div>
					</div>

			   

			<?php } ?>
			
			<!-- END Security -->
		</div>

</div>
</div>