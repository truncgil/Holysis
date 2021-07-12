@extends('admin.master')

@section("title")
	{{e2("Dashboard")}}
@endsection
@section('content')

		<div class="content">
			
			<div class="row">
				
				@include("admin.dashboard.down-setup")
			</div>
			<div class="row">
				<div class="col-12 col-lg-6 worker-chart">
					@include("admin.dashboard.worker")
				</div>
				<div class="col-12 col-lg-6 workstation-chart">
					@include("admin.dashboard.workstation")
				</div>
			</div>
				
				
			
		</div>

@endsection
