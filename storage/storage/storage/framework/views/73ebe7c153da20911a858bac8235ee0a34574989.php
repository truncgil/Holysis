<?php $u = u(); 
$users = usersArray();
?>
<script>
$(document).ready(function(){
  $("#hasta-ara").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $(".hasta-card").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>
<div class="row">
    <div class="col-12">
        <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-<?php echo e($c->icon); ?>"></i> Hastalarınızın Listesi</h3>
            </div>
            <div class="block-content">
                <input type="text" name="" placeholder="Ara..." id="hasta-ara" class="form-control">
            </div>
        </div>
    </div>
<?php $hastalar = db("cihazlar")->where("doktor",$u->id)->get(); foreach($hastalar AS $h) { 
            $hasta = $users[$h->uid];
            ?>
    <div class="col-md-3 col-lg-2 col-xl-2 hasta-card">
       
            <a class="block text-center ajax_modal" title="<?php echo e($hasta->name); ?> <?php echo e($hasta->surname); ?> İsimli Hastanın Bilgisi (<?php echo e($hasta->mac); ?>)" href="?ajax=info&id=<?php echo e($h->mac); ?>">
                <div class="block-content block-content-full bg-gd-emerald">
                    <img class="img-avatar img-avatar-thumb" src="<?php echo e(url("assets/img/user.jpg")); ?>" alt="">
                </div>
                <div class="block-content block-content-full">
                <div class="d-none"><?php echo e(str_slug($hasta->name)); ?></div>
                <div class="d-none"><?php echo e(str_slug($hasta->surname)); ?></div>
                    <div class="font-w600 mb-5"><?php echo e($hasta->name); ?> <?php echo e($hasta->surname); ?></div>
                    <div class="font-size-sm text-muted"><?php echo e($hasta->phone); ?></div>
                    <div class="font-size-sm text-muted"><?php echo e(zf($h->date)); ?></div>

                </div>
                <div class="block-content block-content-full block-content-sm bg-body-light">
                    <div class="font-w600 font-size-sm text-corporate"><?php echo e($hasta->email); ?></div>
                    <div class="font-w600 font-size-sm text-success"><i class="fa fa-wifi"></i> <?php echo e($hasta->mac); ?></div>

                </div>
            </a>
       
    </div>
    <?php } ?>
</div><?php /**PATH /home/sphyzer/app/resources/views/admin/type/hastalar/doktor.blade.php ENDPATH**/ ?>