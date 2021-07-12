<form action="?ajax=chart-down-setup" class="seri" ajax=".pie-ajax{{$id}}" method="post">
<input type="hidden" name="id" value="{{$id}}" />
<input type="hidden" name="table" value="{{$table}}" />
<input type="hidden" name="type" value="{{$type}}" />
<input type="hidden" name="module" value="{{$module}}" />
{{csrf_field()}}
	<div class="input-daterange input-group" data-date-format="mm/dd/yyyy" data-week-start="1" data-autoclose="true" data-today-highlight="true">
		<input type="text" class="form-control datetimepicker" id="downTime" name="start" value="{{get("start")}}" placeholder="{{e2("From")}}" data-week-start="1" data-autoclose="true"
			data-today-highlight="true">
	
		<div class="input-group-prepend input-group-append d-none"> 
			<span class="input-group-text font-w600">-to-</span>
		</div>
		<input type="text" class="form-control datetimepicker" id="downTimeTo" name="end" value="{{get("end")}}" placeholder="{{e2("To")}}" data-week-start="1" data-autoclose="true"
			data-today-highlight="true">
		
		<button class="btn btn-primary">{{e2("Filter")}}</button>
	</div> 
</form>