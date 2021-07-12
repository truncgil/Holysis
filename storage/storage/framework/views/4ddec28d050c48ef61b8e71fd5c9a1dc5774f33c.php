<?php use App\Contents; ?>



<?php $__env->startSection("title","Spyhzer"); ?>
 
    

<?php $__env->startSection('content'); ?>
<div data-name="cihaz-bilgisi" class="page">
<div class="block">
<?php 
$hash = md5(get("mac"));

if(getesit("hash",$hash)) {
    $cihaz = db("cihazlar")
        ->where("mac",get("mac"))
        ->first();
    
    if(isset($cihaz->mac)) {
        if($cihaz->uid=="") { //cihazı sahiplen
             ?>
             <?php echo $__env->make("mac-login.taniyalim", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
             <?php 
        } else { //cihaz sahipli giriş yap
          oturumAc();
          $kim = u2($cihaz->uid);
          oturum("uid",$kim->id);
          $_SESSION['user'] = $kim;
          db("users")->where("id",$kim->id)
          ->update([
               "mac" => $cihaz->mac
          ]);
          yonlendir("profile");
        }
        
    } else {
         ?>
         <?php echo e(get("mac")); ?> <br>
         Bu Cihaz Sistemimizde Kayıtlı Değildir.
         <a href="?mac=<?php echo e(get("mac")); ?>&hash=<?php echo e(get("hash")); ?>&cihaz-sec" class="button external button-green">Farklı Bir Cihaz ile</a>

         <?php 
    }
 ?>
 
 <?php 
} else {
     ?>
     <div class="text-center">
        Anahtar erişim doğrulaması başarısız.
     </div>


     <?php 
}

 ?>
</div>
    
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sphyzer/app/resources/views/mac-login.blade.php ENDPATH**/ ?>