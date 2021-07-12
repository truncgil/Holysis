<?php use App\Contents; 
$title = "Cihaz Bilgisi";
$description = "";
$keywords = "";

?>



<?php $__env->startSection("title",$title); ?>
<?php $__env->startSection("description",$description); ?>
<?php $__env->startSection("keywords",$keywords); ?>


<?php $__env->startSection('content'); ?>
<div data-name="cihaz-bilgisi" class="page">
<?php navbar($title) ?>

          <!-- Bottom Toolbar -->
          <div class="toolbar toolbar-bottom">
            <div class="toolbar-inner">
              <!-- Toolbar links -->
              <a href="profile" class="external link"><i class="f7-icons">person_crop_circle_fill</i></a>
              <a href="<?php echo e(url("cihaz-bilgisi")); ?>" class="external link"><i class="f7-icons">info_circle_fill</i></a>
            </div>
          </div>

          <!-- Scrollable page content -->
          <div class="page-content">
            <div class="block text-align-center">
              <?php center_logo(); ?>
              <?php $cihaz = db("cihazlar")->where("uid",oturum("uid"))->first();
               
                ?>
          
            </div>
          
      <div class="list">
        <ul>
          <li>
            <a href="#" class="item-link item-content">
              <div class="item-media"><i class="f7-icons">wifi</i></div>
              <div class="item-inner">
                <div class="item-title">
                  <div class="item-header">Cihaz Kimliği</div>
                  <?php echo e($cihaz->mac); ?>

                  <div class="item-footer">Cihazın aynı zamanda fiziksel makine adresidir</div>
                </div>
             
              </div>
            </a>
          </li>
          <li>
            <a href="#" class="item-link item-content">
              <div class="item-media"><i class="f7-icons">globe</i></div>
              <div class="item-inner">
                <div class="item-title">
                  <div class="item-header">IP Adresi</div>
                  <?php echo e($cihaz->ip); ?>

                  <div class="item-footer">Veri gönderilen mobil aygıtın bağlı olduğu internet adresidir.</div>

                </div>
                
              </div>
            </a>
          </li>
          
<?php $son = db("pulse_data")->where("mac",$cihaz->mac)->orderBy("id","DESC")->first() ?>
          <li>
            <a href="#" class="item-link item-content">
              <div class="item-media"><i class="f7-icons">location</i></div>
              <div class="item-inner">
                <div class="item-title">
                  <div class="item-header">Son Lokasyon Bilgisi</div>
                 <?php echo e($son->lat); ?>, <?php echo e($son->lng); ?>

                  <div class="item-footer">Cihazın sinyal gönderdiği GPS bilgisidir</div>
                </div>
               
              </div>
            </a>
          </li>
          <li>
            <a href="#" class="item-link item-content">
              <div class="item-media"><i class="f7-icons">battery_100</i></div>
              <div class="item-inner">
                <div class="item-title">
                  <div class="item-header">Kalan Güç</div>
                 %<?php echo e($son->battery); ?> 
                  <div class="item-footer">Cihazın pilinin ne kadar kaldığını gösterir</div>
                </div>
               
              </div>
            </a>
          </li>
          <li>
            <a href="#" class="item-link item-content">
              <div class="item-media"><i class="f7-icons">calendar</i></div>
              <div class="item-inner">
                <div class="item-title">
                  <div class="item-header">Son Veri Gönderme Tarihi</div>
           
                 <?php echo e(df($son->date,"d.m.Y H:i")); ?>

                  <div class="item-footer">Cihazın sisteme son veri gönderme tarihidir</div>
                </div>
               
              </div>
            </a>
          </li>
        </ul>
      </div>


               
      </div>
 
          </div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sphyzer/app/resources/views/cihaz-bilgisi.blade.php ENDPATH**/ ?>