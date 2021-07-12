<?php 
if($level=="Admin") {
    $sorgu = db2("soru_bankasi");
    $sorgu = $sorgu -> orderBy("id","DESC")->get();
} else {
    $sorgu = db("soru_bankasi");
    $sorgu = $sorgu -> where("uid",$u->id);
    $sorgu = $sorgu -> orderBy("id","DESC")->get();
}
?>
<div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><?php echo e(e2("Son Eklenen Sorular")); ?></h3>
            </div>
        </div>


<div class="row">
    <?php foreach($sorgu AS $s) { ?>
        <div class="col-md-3">
            <div class="block block-default" >
                <div class="block-header">
                <?php $cevap = explode(",",$s->cevap); ?>
                
                <div class="float-left">
                <?php  foreach($cevap AS $c) {
                ?>
                    <div class="btn btn-primary"><?php echo e($c); ?></div>
                <?php 
                  }?>
                </div>
                    <div class="float-right">
                        <div class="btn-group">
                            <a href="?soru-duzenle=<?php echo e($s->id); ?>" class="btn btn-warning" title="<?php echo e(e2("Bu soruyu düzenle")); ?>"><i class="fa fa-edit"></i></a>
                            <a href="?soru-sil=<?php echo e($s->id); ?>" teyit="Soruyu silmek istediğinizden emin misiniz?" class="btn btn-danger" title="<?php echo e(e2("Bu soruyu sil")); ?>"><i class="fa fa-times"></i></a>
                            
                        </div>
                    </div>
                </div>
                <div class="html">
                    <?php echo $s->html; ?>

                </div>
                <div class="block-content">
                    <h5 class="card-title"><?php echo e($s->brans); ?> / <?php echo e($s->konu); ?></h5>
                    <?php echo e(e2("Kazanim")); ?>: <p class="card-text"><?php echo e($s->kazanim); ?></p>
                    <?php $sinif_duzey = explode(",",$s->sinif_duzey); ?>
                    <?php echo e(e2("Sınfı Düzeyi")); ?> : <br>
                    <?php  foreach($sinif_duzey AS $c) {
                        if($c!="") {
                ?>
                    <div class="btn btn-info"><?php echo e($c); ?>. Sınıf</div>
                <?php 
                        }
                  }?>
                   
                </div>
            </div>
        </div>
    <?php } ?>
</div>
<style>
    .html {
        overflow:auto;
        width:100%;
        padding:10px;
        height:300px;
    }
    .html img {
        width:100% !important;
        height:revert !important;
    }

</style><?php /**PATH /home/dijimind/app/resources/views/admin/type/soru-bankasi/liste.blade.php ENDPATH**/ ?>