<form action="?mass-mortel-add" class="seri" ajax=".mass-mortel-ajax" method="post">
	{{csrf_field()}}
	<div class="">
			{{e2("Month Number:")}}
			<input type="number" name="Month Number" min="1" max="12" id="" class="form-control" />
			{{e2("Tonnage:")}}
			<input type="number" step="any" name="Tonnage" min="1" id="" class="form-control" />
	</div>
	<br />
	<button class="btn btn-primary">{{e2("Save")}}</button>
</form>
<div class="mass-mortel-ajax" ajax2="{{$path}}.mass-mortel"></div>