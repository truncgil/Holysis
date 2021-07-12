<?php use App\Contents; ?>



<?php $__env->startSection("title","Hoşgeldiniz"); ?>
 
    

<?php $__env->startSection('content'); ?>
<!-- Initial Page, "data-name" contains page name -->

<div data-name="home" class="page">



<!-- Bottom Toolbar -->
<div class="toolbar toolbar-bottom">
  <div class="toolbar-inner">
    <!-- Toolbar links -->
    
    <a href="#" class="link"><i class="f7-icons">phone</i></a>
    <a href="/cihaz-bilgisi"  class="external link"><i class="f7-icons">wifi</i></a>
  </div>
</div>

<!-- Scrollable page content -->
<div class="page-content">
<div class="block text-align-center">
    <img src="<?php echo e(url("assets/logo.svg")); ?>" alt=""> <br>
    <?php echo e(e2("Değerli kullanıcı ilk olarak cihaz eşleştirmesi yapmanız gerekmektedir. 
Lütfen cihazın açık olduğundan emin olunuz, ardından da aşağıdaki buton yardımı ile cihaz eşleştirmesini yapınız")); ?>

</div>

<a href="?cihaz-sec" class="link external button">Cihaz Seçiniz</a>  

</div>
</div>


    
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/sphyzer/app/resources/views/index.blade.php ENDPATH**/ ?>