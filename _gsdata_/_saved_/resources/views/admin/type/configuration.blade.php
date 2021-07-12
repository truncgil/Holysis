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
					<a class="nav-link @if($k==$active) active @endif" href="#{{$c->slug}}">{{$c->title}}</a>
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
							<?php $alt = contents($c->slug); foreach($alt AS $a) { ?>
								<div class="form-group row" id="t{{$a->id}}">
									<div class="col-12">
										<div class="input-group"> 
											<input type="text" class="form-control form-control-lg edit" placeholder="{{e2("Title")}}"  name="title" id="{{$a->id}}" table="contents"  value="{{$a->title}}">
										@if($c->title=="Vacation Days")
											<input type="date" class="form-control form-control-lg edit" placeholder="{{e2("Date")}}" name="date" id="{{$a->id}}" table="contents"  value="{{$a->date}}">
										@endif

										@if($c->title=="Ofen")
											<input type="number" class="form-control form-control-lg edit" placeholder="{{e2("Min")}}" step="any" name="min"  id="{{$a->id}}" table="contents"  max="{{$a->max}}" value="{{$a->min}}">
											<input type="number" class="form-control form-control-lg edit" placeholder="{{e2("Max")}}" step="any"  name="max" onblur="$(this).next().attr('max',$(this).val()).prop('max',$(this).val());" id="{{$a->id}}" table="contents"  value="{{$a->max}}">
											<input type="date" class="form-control form-control-lg edit" placeholder="{{e2("Date")}}" name="date" id="{{$a->id}}" table="contents"  value="{{$a->date}}">
										@endif
										@if($c->title=="Shift Hours")
											<input type="time" class="form-control form-control-lg edit" placeholder="{{e2("Min Hour")}}" step="any" name="time1"  id="{{$a->id}}" table="contents"  max="{{$a->time1}}" value="{{$a->time1}}">
											<input type="time" class="form-control form-control-lg edit" placeholder="{{e2("Max Hour")}}" step="any"  name="time2" onblur="$(this).next().attr('max',$(this).val()).prop('max',$(this).val());" id="{{$a->id}}" table="contents"  value="{{$a->time2}}">
										
										@endif
										@if($c->title=="Status")
											
											<input type="color" class="form-control form-control-lg edit" placeholder="{{e2('Color')}}"  name="html" id="{{$a->id}}" table="contents"  value="{{$a->html}}">
											<input type="number" class="form-control form-control-lg edit" placeholder="{{e2("Notification Timer")}}" step="any" name="min"  id="{{$a->id}}" table="contents"  max="{{$a->max}}" value="{{$a->min}}">
											
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
								
							</div>
						</div>
					</div>

			   

			<?php } ?>
			<!-- END Security -->
		</div>

</div>
</div>