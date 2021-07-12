<?php $ogrenci = db2("ogrenciler")->where("id",get("id"))->first();
$hash = $ogrenci->tc_kimlik_no;
if($hash=="") {
    $hash = $ogrenci->title;
}

$sonuclar = db2("sonuclar")
->where("ogrenci_adi",$ogrenci->title)
->orWhere("tc_kimlik_no",$ogrenci->tc_kimlik_no)
->orderBy("id","DESC")
->get();

$sinav = table_to_array2("sinavlar");
?>
<div class="float-right">
        <strong><?php echo e(e2("T.C. Kimlik No")); ?>: </strong><?php echo e($ogrenci->tc_kimlik_no); ?>

        <br>
        <strong><?php echo e(e2("ID")); ?>:</strong> <?php echo e($ogrenci->id); ?>

        <br>
        <a href="?ajax=taksonomik-duzey-rapor&ogrenci=<?php echo e($hash); ?>" target="_blank" class="btn btn-success"><?php echo e(e2("Genel Taksonomik Analizi")); ?></a>
</div>
<h1><?php echo e($ogrenci->title); ?></h1>

<div class="row">
    <div class="col-12">
    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th><?php echo e(e2("SINAV ADI")); ?></th>
                                <th><?php echo e(e2("TARİH")); ?></th>
                                <th><?php echo e(e2("KİTAPÇIK")); ?></th>
                                <th><?php echo e(e2("ANALİZ SONUÇLARI")); ?></th>
                            </tr>
                        
                        </thead>
                        <tbody>
                        <?php foreach($sonuclar AS $s) { 
                            $analiz = json_decode($s->analiz,true);
                            $this_sinav = $sinav[$s->sinav_id];
                            ?>
                            <tr>
                              
                                <td><?php echo e($this_sinav->title); ?></td>
                                <td><?php echo e(df($this_sinav->date)); ?></td>
                                <td><?php echo e($s->kitapcik); ?></td>
                                <td>
                                    <button data-toggle="collapse" class="btn btn-primary" data-target="#sonuc<?php echo e($s->id); ?>"><?php echo e(e2("Sonuçları Göster/Gizle")); ?></button>
                                    <a href="<?php echo e(url("admin-ajax/sinav-sonuc-belgesi?id=".$s->id)); ?>" target="_blank" class="btn btn-secondary"><?php echo e(e2("Kazanımlı Sınav Sonuç Belgesi")); ?></a>
                                    <a href="<?php echo e(url("admin-ajax/taksonomik-duzey-rapor?id=".$s->id)); ?>" target="_blank" class="btn btn-success"><?php echo e(e2("Taksonomik Analiz Raporu")); ?></a>
                                    <div id="sonuc<?php echo e($s->id); ?>" class="collapse">
                                    
                                    
                                        <table class="table table-striped table-hover table-sm">
                                            <tr>
                                                <th><?php echo e(e2("Ders Adı")); ?></th>
                                                <th><?php echo e(e2("Doğru")); ?></th>
                                                <th><?php echo e(e2("Yanlış")); ?></th>
                                                <th><?php echo e(e2("Boş")); ?></th>
                                                <th><?php echo e(e2("Cevaplar")); ?></th>
                                        
                                            </tr>
                                            <?php foreach($analiz AS $alan => $deger) {
                                        ?>
                                            <tr>
                                                <td><?php echo e(slug_to_title($alan)); ?></td>
                                                <td>
                                                    <div class="badge badge-success"><?php echo e($deger['dogru']); ?></div> <br>
                                                
                                                    <?php echo e(implode(", ",$deger['kazanim-dogru'])); ?> <br>
                                                    <?php echo e(implode(", ",$deger['tak-dogru'])); ?> <br>
                                                </td>
                                                <td>
                                                <div class="badge badge-danger"><?php echo e($deger['yanlis']); ?></div> <br>
                                                
                                                    <?php echo e(implode(", ",$deger['kazanim-yanlis'])); ?> <br>
                                                    <?php echo e(implode(", ",$deger['tak-yanlis'])); ?> <br>
                                                </td>
                                                <td>
                                                <div class="badge badge-warning"><?php echo e($deger['bos']); ?></div> <br>
                                                
                                                    <?php echo e(implode(", ",$deger['kazanim-bos'])); ?> <br>
                                                    <?php echo e(implode(", ",$deger['tak-bos'])); ?> <br>
                                                </td>
                                                <td><?php echo e($deger['cevaplar']); ?></td>
                                            </tr>
                                            <?php 
                                    } ?>
                                        </table>
                                     </div>
                                     
                                </td>
                            </tr>
                            <?php } ?>
                     
                </tbody>
            </table>
    </div>
</div><?php /**PATH /home/dijimind/app/resources/views/admin-ajax/ogrenci-sinavlari.blade.php ENDPATH**/ ?>