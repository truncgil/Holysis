<style type="text/css">
.drag-data .job {
	max-width:100% !important;
	
}
/*
.dataTable .onboard {
	border:solid 2px #000 !important;
}
*/
.onboardtr td {
	background:#fffedc;
}

.setup {
	border:solid 1px #f6f6f6;
	font-size:10px;
	background:#0f0;
	color:white;
	position:absolute;
	height:100%;
	width:100%;
}
.down {
	border: solid 1px #f6f6f6;
	font-size:10px;
	background:#f00;
	color:white;
	position:absolute;
	height:100%;
	width:100%;
}
.dataTable .checked {
	background:#9ccc65 !important;
}
.drag-data {
	 position:relative;
	 width:100px;
	 height:50px;
}
.planning-board .arrow-left {
	position: absolute;
    top: 0px;
    left: 0px;
    opacity: 0.5;
}
.sap-planning .list-group-item {
		position:relative;
		height:30px;
	}
.planning-board td {
	/*width:64px !important;*/
	text-align:center;
	padding:0px !important;
	margin:0px !important;
}

.job {
	position:absolute !important;
	left:0px;
	top:0px;
	width:100%;
	height:100% !important;
	cursor:move;
	resize: both;
	overflow: hidden;
	z-index:1000;
	font-size:10px;
	border-radius:5px;
	border:solid 1px #7d7878
}

.job:active,.job:hover {
	z-index:1000;
	background:#f6f6f6 !important;
}
.blocked {
	position:absolute !important;
	left:0px;
	top:0px;
	min-height:50px;
	min-width:100%;
	width:100%;
	cursor:move;
	resize: both;
	overflow: hidden;
	z-index:20;
	background:#f6f6f6;
	border-radius:5px;
}
.blocked textarea {
	border:none;
	position:absolute;
	height:80%;
	width:90%;
	left:5%;
	top:5%;
	overflow:hidden;
	background:none;
	resize:none;
}
.tarih {
	width:300px !important
}
table {
	
}
.vardiya {
	position: relative;
    width: 16.6% !important;
    border: solid 1px #f6f6f6;
    display: block;
    height: 30px;
    float: left;
}
.vardiya:hover {
/*	background:#f6f6f6;*/
}
.block-zone {
	background:#f6f6f6;
	position: absolute;
    height: 100%;
    width: 100%;
}
.tarih .small {
	font-size:12px;
}
.block-zone textarea {
	z-index:100;
	position:absolute;
	left:0px;
	top:0px;
	height:100%;
	resize:auto;
	background:transparent;
}
#nav-board {
	transition: all 1s;
}
.planning-board {
	opacity:0;
	transition:all 0.5s;
}
.vardiya-name {
	position: relative;
    width: 33.3% !important;
    border: solid 1px #f6f6f6;
    display: block;
    height: 30px;
    float: left;
}
td.vardiya-name {
	overflow:hidden;
}
/*
.vardiya:hover {
	background:yellow;;
}
*/ 
.widgets {
	position:relative;
	height:200px;
	border:solid 2px;
	margin-bottom:10px;
	border-radius:10px;
} 
.planning-board {
	width:100%;
	min-width:1000px;
}
.workstation {
	width:250px !important;
	position:relative;
}
.machine {
	width:0px !important;
	position:relative;
}
.td-title {
	position:relative;
	width:75px;
}
.td-title-ust {
	width:200px;
}
.drag-data {
	float:left !important;
	width:200px;
}
.sap-planning {
	display:block !important;
}
</style>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">