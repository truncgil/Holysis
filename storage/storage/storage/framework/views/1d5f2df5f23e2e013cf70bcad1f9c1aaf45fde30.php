<?php $veri = db("pulse_data")
    ->where("mac",get("id"));
    
    if(getisset("data")) {
        $veri = $veri->where("id",get("data"));
    }
    $veri = $veri
    ->orderBy("id","DESC")
    ->first();
    //print_R($veri);
    $data = $veri->data;
    $data = explode(",",$data);
    $dizi = array();
    $k=0;
    foreach($data AS $d) {
        $k++;
        if($d=="") {
          $d=2000;
        }
          if($d<300) {
         //   $d=500;
          }
          if($k>200){
         //   echo "ok";
            break;
          }
            array_push($dizi,"['$k',$d]");
        
        
    }
    $hasta = db("users")
    ->where("mac",get("id"))
    ->first();
  //  print_R($hasta);

    ?>
    <script type="text/javascript">

      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Sıra', 'Sinyal'],
          <?php echo implode(",",$dizi) ?>
         
        ]);

        var options = {
          title: '<?php echo e(df($veri->created_at,"d.m.Y H:i")); ?> EKG Grafiği (<?php echo e(zf($veri->created_at)); ?>)',
          hAxis: {title: 'Sinyal',  titleTextStyle: {color: '#333'},
                   slantedText:true, slantedTextAngle:80}, 
          vAxis: {minValue: 0},
          explorer: { 
            actions: ['dragToZoom', 'rightClickToReset'],  
            axis: 'horizontal',
            keepInBounds: true,
            maxZoomIn: 4.0},
          colors: ['#D44E41'],
        }; 

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
    <div class="row">
      <div class="col-9">
            <div id="curve_chart" style="width:100%; height: 500px"></div>
      </div>
      <div class="col-3">
          <?php $data = implode(",",$data); ?>
            <?php echo $__env->make("admin.inc.ekg-live", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
      </div>
    </div><?php /**PATH /home/sphyzer/app/resources/views/admin-ajax/ekg.blade.php ENDPATH**/ ?>