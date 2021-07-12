<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title></title>
</head>
<body>
		<script
  src="https://code.jquery.com/jquery-3.4.1.min.js"
  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
  crossorigin="anonymous"></script>
		<script type="text/javascript" src="<?php echo e(url('assets/flexmonster/flexmonster.js')); ?>"></script>

<div id="pivot-container"></div>
<script type="text/javascript">
var pivot = new Flexmonster({
        container: "pivot-container",
		global: {
			localization: "<?php echo e(url('assets/en.json')); ?>"
		},
		componentFolder: "https://cdn.flexmonster.com/",
		toolbar: true,
        report: {
            dataSource: {
				type : "csv",
                filename: "<?php echo e(get("path")); ?>"
            }
        },
		licenseKey:"Z7CP-XAAB1T-210N1E-1I1961"
    });
</script>
<script type="text/javascript">

$(function(){

	$("*").on("click",function(){
		$("#fm-inp-proxy-url").val("");
	});
});
</script>
</body>
</html><?php /**PATH /home/euro/otto2020.euro.kim/resources/views/admin-ajax/flexmonster.blade.php ENDPATH**/ ?>