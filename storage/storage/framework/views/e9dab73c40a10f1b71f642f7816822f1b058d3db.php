   
   <div class="input-group">
    <input type="datetime-local" name="d1" id="d1">
    <input type="datetime-local" name="d2" id="d2">
    <button class="btn btn-primary getir">Getir</button>
   </div>
   <div class="ekg-date"></div>
   <script>
     $(function(){
      $(".getir").on("click",function(){
      //    $(".ekg-zone").load("?ajax=ekg&id=<?php echo e($_GET['id']); ?>");
          $.get("?ajax=ekg-date&id=<?php echo e($_GET['id']); ?>",{
            d1 : $("#d1").val(),
            d2 : $("#d2").val()
          },function(d){
            $(".ekg-date").html(d);
          });
      });
     });
   </script>
   <div class="ekg-zone">
    <?php echo $__env->make("admin.inc.ekg", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
   </div>
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
            $d=500;
          }
            array_push($dizi,"['$k',$d]");
        }
        
    }
    $hasta = db("users")
    ->where("mac",get("id"))
    ->first();
  //  print_R($hasta);

    ?>
   <table class="table table-bordered">
      <tr>
          <td>Son Sinyal Zamanı:</td>
          <td><strong><?php echo e(df($veri->created_at,"d.m.Y H:i")); ?> (<?php echo e(zf($veri->created_at)); ?>)</strong></td>
      </tr>
      <tr>
          <td>Lokasyon:</td>
          <td><strong><?php echo e($veri->lat); ?>, <?php echo e($veri->lng); ?></strong></td>
      </tr>
      <tr>
          <td>Pil Durumu:</td>
          <td><strong>%<?php echo e($veri->battery); ?></strong></td>
      </tr>
      <?php if($hasta) { ?>
      <tr>
          <td>Hasta Bilgisi:</td>
          <td><strong><?php echo e($hasta->name); ?> <?php echo e($hasta->surname); ?></strong></td>
      </tr>
      <?php } ?>
    </table>
    <div class="row">
        <div class="col-12">
        <iframe src="https://maps.google.com/maps?q=<?php echo e($veri->lat); ?>, <?php echo e($veri->lng); ?>&z=18&output=embed"  width="100%" height="270" frameborder="0" style="border:0;width:100%;"></iframe>
        </div>
      
    </div>
    
    
    
    <?php /**PATH /home/sphyzer/app/resources/views/admin-ajax/info.blade.php ENDPATH**/ ?>