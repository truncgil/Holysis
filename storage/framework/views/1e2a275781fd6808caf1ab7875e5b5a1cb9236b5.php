<?php if(getisset("sil")) {
    db("optik")->where("id",get("sil"))->delete();
    alert("Optik silinmiştir");
} ?>
<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-<?php echo e($c->icon); ?>"></i> <?php echo e(e2("Optik Listesi")); ?></h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <td>Optik Form Adı</td>
                            <td>Optik Alanları</td>
                            <td>Optik Dosyası</td>
                            <td>İşlem</td>
                            
                        </tr>
                        <?php $optik = db("optik")->orderBy("id","desc")->get(); foreach($optik AS $o) { 
                            $j = j($o->json); 
                            $alan = $j['alan'];
                            $bas = $j['bas'];
                            $son = $j['son'];
                            ?>
                        <tr>
                            <td><?php echo e($o->title); ?></td>
                            <td>
                                <table class="table table-bordered">
                                    <tr>
                                        <td>Adı</td>
                                        <td>Baş</td>
                                        <td>Son</td>
                                    </tr>
                                    <?php 
                                    $k = 0;
                                    foreach($alan AS $a) { ?>
                                    <tr>
                                        <td><?php echo e($a); ?></td>
                                        <td><?php echo e($bas[$k]); ?></td>
                                        <td><?php echo e($son[$k]); ?></td>
                                    </tr>
                                    <?php $k++; } ?>
                                </table>
                            </td>
                            <td>
                                <a href="<?php echo e(url($o->files)); ?>" target="_blank"><?php echo e($o->files); ?></a>
                            </td>
                            <td>
                                <a href="?sil=<?php echo e($o->id); ?>" class="btn btn-primary" teyit="<?php echo e(e2("Bu optik tanımını silmek istediğinizden emin misiniz")); ?>"><i class="fa fa-times"></i></a>
                                <a href="?optik-ekle&duzenle=<?php echo e($o->id); ?>" class="btn btn-warning" ><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div><?php /**PATH /home/dijimind/app/resources/views/admin/type/optikler/optik-listesi.blade.php ENDPATH**/ ?>