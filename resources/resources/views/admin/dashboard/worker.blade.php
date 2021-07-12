<?php if(getisset("w")) {
	$week = get("w");
} else {
	$week = date("W");
} ?>

	<div class="block">
		<ul class="nav nav-tabs nav-tabs-block js-tabs-enabled nav-ajax" path="admin.dashboard.worker">
			  <li class="nav-item">
				<a class="nav-link active" data-toggle="tab" href="#workers">{{e2("Workers")}}</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" data-toggle="tab" href="#workstation">{{e2("Workstation Shift Tonnage Statistics (SAP)")}}</a>
			  </li>
			  <li class="nav-item d-none">
				<a class="nav-link" data-toggle="tab" href="#department">{{e2("Department Filter")}}</a>
			  </li>
			</ul>

			<!-- Tab panes -->
			<div class="block-content tab-content">
			  <div class="tab-pane container active" id="workers"></div>
			  <div class="tab-pane container fade" id="workstation"></div>
			  <div class="tab-pane container fade" id="department"></div>
			</div>
		
	
</div>