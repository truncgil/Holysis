<?php $u = u();
//print2($u);
$level = $u->level;

if(getisset("soru-sil")) {
    db("soru_bankasi")
    ->where("id",get("soru-sil"))
    ->where("uid",$u->id)
    ->delete();
    bilgi("Soru silinmiştir.");
}

?>
<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-plus"></i> Yeni Soru Ekle</h3>
            </div>
            <div class="block-content">
               
               <?php echo $__env->make("admin.type.soru-bankasi.soru-form", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>

            

        </div>

    </div>
</div>
<div class="content">
    <?php echo $__env->make("admin.type.soru-bankasi.liste", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div><?php /**PATH /home/dijimind/app/resources/views/admin/type/soru-bankasi.blade.php ENDPATH**/ ?>