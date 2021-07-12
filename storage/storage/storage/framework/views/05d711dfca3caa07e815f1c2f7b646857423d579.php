


<div class="content">
<?php if(postisset("mac")) {
    $varmi = db("cihazlar")->where("mac",post("mac"))->first();
    if(!$varmi) {
        ekle2([
            "mac" => post("mac")
        ],"cihazlar");
    } else {

        bilgi("{$_POST['mac']} kimliğine sahip  cihaz sisteme zaten kayıtlıdır","danger");
    }
    
} ?>
<?php if(getisset("mac-sil")) {
    db("cihazlar")->where("id",get("mac-sil"))->delete();
} ?>
    <?php echo $__env->make("admin.type.cihazlar.form", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-<?php echo e($c->icon); ?>"></i>Cihazlar</h3>
            </div>
            <div class="block-content">
                <table class="table">
                    <tr>
                        <td>ID</td>
                        <td>Mac Adresi</td>
                        <td>Hasta Adı</td>
                        <td>IP</td>
                        <td>Koordinat</td>
                        <td>Son Güncelleme</td>
                        <td>Durum</td>
                        <td>İşlem</td>
                    </tr>
                    <?php $cihazlar = db("cihazlar")
                    ->join('users', 'users.id', '=', 'cihazlar.uid')
                  //  ->select("cihazlar.id AS cid","*")
                    ->orderBy("cid","DESC")->get(); ?>
                    <?php foreach($cihazlar AS $c) { ?>
                    <tr id="t<?php echo e($c->cid); ?>">
                        <td><?php echo e($c->cid); ?></td>
                        <td><?php echo e($c->mac); ?></td>
                        <td><?php echo e($c->name); ?> <?php echo e($c->surname); ?></td>
                        <td><?php echo e($c->ip); ?></td>
                        <td><?php echo e($c->lat); ?>,<?php echo e($c->lng); ?></td>
                        <td><?php echo e(df("d.m.Y H:i",$c->date)); ?></td>
                        <td><?php echo e($c->status); ?></td>
                        <td>
                            <a href="?mac-sil=<?php echo e($c->cid); ?>" title="<?php echo e($c->mac); ?> Cihazını Sistemden Kaldır" ajax="t<?php echo e($c->id); ?>" class="teyit btn btn-danger"><i class="fa fa-times"></i></a>
                            <a href="?ajax=info&id=<?php echo e($c->mac); ?>" title="<?php echo e($c->mac); ?> EKG Bilgisi" class="btn btn-primary ajax_modal"><i class="fa fa-chart-line"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
                
            </div>

            

        </div>

    </div>
</div><?php /**PATH /home/sphyzer/app/resources/views/admin/type/cihazlar.blade.php ENDPATH**/ ?>