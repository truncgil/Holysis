<?php $veri = db("pulse_data")
    ->where("mac",get("id"))
    ->orderBy("id","DESC")
    ->first();
    //print_R($veri);
    $data = $veri->data;
    $data = explode(",",$data);
    $dizi = array();
    $k=0;
    foreach($data AS $d) {
        $k++;
        if($d!="") {
          if($d<500) {
          //  $d=500;
          }
          if($k>200) break;
            array_push($dizi,"['$k',$d]");
        }
        
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
          title: 'EKG Grafiği',
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
      <div class="col-12" style="overflow:auto;">
            <div id="curve_chart" style="width:100%; height: 500px"></div>
      </div>
    </div>