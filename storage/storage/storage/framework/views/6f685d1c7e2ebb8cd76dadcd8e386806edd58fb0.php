<?php 


$doktor = db("users")
->where("level","Doktor")
->get();
$users = db("users")
->get();
$users = dbArray($users,"id");

?>

<div class="block">
    <div class="block-header block-header-default">
        <h3 class="block-title"><i class="fa fa-<?php echo e($c->icon); ?>"></i> Hasta Doktor Listesi</h3>
    </div>
    <div class="block-content">
        <div class="table-responsive">
            <table class="table">
                <tr>
                    <th>Hasta Adı</th>
                    <th>Doktor Adı</th>
                    <th>Hasta Son Sinyal Zamanı</th>
                    <th>Doktor Son Görünme Zamanı</th>
                </tr>
                <?php $sorgu = db("cihazlar")
                ->whereNotNull("uid")
         //       ->whereNotNull("doktor")
                ->get();
                    foreach($sorgu AS $s) {
                        $hb = $users[$s->uid];
                        
                    ?>
                <tr>
                    <td><?php echo e($hb->name); ?> <?php echo e($hb->surname); ?></td>
                    <td>
                    <select name="doktor" class="edit" table="cihazlar" key="cid" id="<?php echo e($s->cid); ?>" >
                            <option value="">Doktor Ataması Yok</option>
                         <?php foreach($doktor AS $d) { ?>
                             <option value="<?php echo e($d->id); ?>" <?php if($d->id==$s->doktor) echo "selected"; ?>><?php echo e($d->name); ?> <?php echo e($d->surname); ?></option>
                             <?php } ?>
                         </select>
                    
                    </td>
                    <td>
                    
                    <?php echo e(date("d.m.Y H:i:s",strtotime($s->date))); ?>

                   
                    </td>
                    <td>
                    <?php if($s->doktor!="") { ?>
                    <?php if($s->doktor_date=="") {
                        bilgi("Doktor henüz işlem yapmadı","info");
                    } else {
                         ?>
                         <?php echo e(date("d.m.Y H:i:s",strtotime($s->doktor_date))); ?>

                         <?php 
                    } ?>
                    
                    <?php } else {
                       // bilgi("Doktor Ataması Yapılmamış","warning");
                         ?>
                         

                         <?php 
                    } ?>
                    
                    </td>
                </tr>
                <?php } ?>
            </table>
            
        </div>
    </div>
</div><?php /**PATH /home/sphyzer/app/resources/views/admin/type/hastalar/admin.blade.php ENDPATH**/ ?>