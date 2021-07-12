<?php 
namespace App\Imports;
use Maatwebsite\Excel\Facades\Excel;

if(getisset("kazanimlar")) { 
    
    $s = db("sinavlar")->where("id",get("kazanimlar"))->first();
    $ders = j($s->dersler);
    $kazanim = j($s->kazanimlar); 
  //  print_r($kazanim);
    ?>
<div class="content">
    <div class="block">
            <div class="block-header block-header-default" >
                <h3 class="block-title"><?php echo e($s->title); ?> Sınavı İçin Cevap Anahtarı ve Kazanım Tablosu</h3>
            </div>
            <div class="block-content">
                <?php if(getisset("excel")) {
                   // print_r($_FILES);
                    try {
                        $dosya = upload2("excel","kazanim-excel-import/");
 
                        Excel::import(new kazanimImport, $dosya);
                        bilgi("Excel dosyasından kazanım ve cevaplar başarılı bir şekilde aktarılmıştır");
                    } catch (\Throwable $th) {
                       bilgi("Yüklemeye çalıştığınız dosya sistem tarafından izin verilen bir türe sahip değil. Lütfen Excel üzerinde farklı kaydet işlemi yaparak tekrar yüklemeyi deneyiniz","danger");
                    }
                   
                   
                 
                     ?>
                   
                     <?php
                   
                       
                         ?>
                     
                        
                     <?php 
                  
                } ?>
    <?php   $s = db("sinavlar")->where("id",get("kazanimlar"))->first();
    $ders = j($s->dersler);
    $kazanim = j($s->kazanimlar); ?>
                <form action="?kazanimlar=<?php echo e(get("kazanimlar")); ?>&excel" enctype="multipart/form-data" method="post">
                    <?php echo e(csrf_field()); ?>

                    <div class="float-right">
                        <a href="<?php echo e(url("admin-ajax/kazanim-excel-export?id=".get("kazanimlar"))); ?>" accept="xlsx" class="btn btn-success"><i class="fa fa-file-excel"></i> Örnek Excel Dosyası İndir</a>
                    </div>
                    <div class="input-group">
                        <input type="file" required name="excel" id="">
                        <button class="btn btn-primary">Aktar</button>
                    </div>
                </form>
                <?php if(getisset("kazanim-kaydet")) {
                    unset($_POST['_token']);
                    db("sinavlar")
                    ->where("id",get("kazanimlar"))
                    ->update([
                        "kazanimlar" => json_encode_tr($_POST)
                    ]);
                    bilgi("Kazanım ve cevap anahtarı bilgileri kaydedilmiştir");

                } ?>
                <script>
                $(function(){
                    $("#kazanimForm").on("submit",function(){
                        $("#kazanimForm button").html("Kaydediliyor...");
                        var datastring = $("#kazanimForm").serialize();
                            $.ajax({
                            type: "POST",
                            url: "?kazanimlar=<?php echo e(get("kazanimlar")); ?>&kazanim-kaydet",
                            data: datastring,
                            dataType: "json",
                            error: function(e) {
                                console.log(e);
                              //  alert(e);
                              $("#kazanimForm button").html("Kaydedildi");
                            }
                        });
                        return false;
                    });
                    window.setInterval(function(){
                        $("#kazanimForm button").trigger("click");
                    },10000);
                    <?php 
                    if(is_array($kazanim)) {

                    
                        foreach($kazanim AS $k => $d) {
                            if(is_array($d)) {
                                foreach($d AS $sd) {
                                     ?>
                                     $("#<?php echo e($k); ?>_<?php echo e($sd); ?>").prop("checked",true);
                                     $("#<?php echo e($k); ?>_<?php echo e($sd); ?>").attr("checked",true);
                                     <?php 
                                }
                                ?>
                                // console.log("<?php echo implode(",",$d); ?>");
                                <?php 
                            } else {
                                ?>
                                $("#<?php echo e($k); ?>").val("<?php echo e($d); ?>");
                                <?php 
                            }
                       
                        } 
                    }
                    ?>
                });
                </script>
                <form action="" id="kazanimForm" method="post">
                <?php echo e(csrf_field()); ?>

                <?php foreach($ders AS $d) {
                     ?>
                     <h3><?php echo e($d['isim']); ?></h3>
                     <?php $soru_sayi = $d['soru']; 
                     $sik = explode(",","A,B,C,D,E,X");
                     $tak_list = tak_list();
                     $slug = str_slug($d['isim']);
                     ?>
                     
                     <table class="table">
                         <tr>
                             <th>A Soru No</th>
                             <th>B Soru No</th>
                             <th>Doğru Cevap</th>
                             <th>Kazanım Kodu veya Kazanım Metni</th>
                             <th>Taksonomik Düzey</th>
                             <th>C Soru No</th>
                             <th>D Soru No</th>
                         
                         </tr>
                         <?php for($k=1;$k<=$soru_sayi;$k++) {
                          ?>
                          <tr>
                              <td><?php echo e($k); ?></td>
                              <td>
                                <select name="<?php echo e($slug); ?>_b_soru_no_<?php echo e($k); ?>" id="<?php echo e($slug); ?>_b_soru_no_<?php echo e($k); ?>" class="form-control">
                                <option value="">Seçiniz</option>
                                    <?php for($a=1;$a<=$soru_sayi;$a++) { ?>
                                        <option value="<?php echo e($a); ?>"><?php echo e($a); ?></option>
                                    <?php } ?>
                                </select>
                              </td>
                              <td>
                               
                                <?php foreach($sik AS $si) {
 ?><label  class="cevap-isaret"><input type="checkbox" name="<?php echo e($slug); ?>_cevap_<?php echo e($k); ?>[]" class=" <?php if($si=="X") echo "iptal"; ?>" id="<?php echo e($slug); ?>_cevap_<?php echo e($k); ?>_<?php echo e($si); ?>" value="<?php echo e($si); ?>"> 
 <span><?php echo e($si); ?></span>
 </label><?php 

                                } ?>
                              </td>
                              <td>
                                    <input type="text" name="<?php echo e($slug); ?>_kazanim_<?php echo e($k); ?>" id="<?php echo e($slug); ?>_kazanim_<?php echo e($k); ?>" class="form-control">
                              </td>
                              <td>
                                    <select name="<?php echo e($slug); ?>_tak_<?php echo e($k); ?>" id="<?php echo e($slug); ?>_tak_<?php echo e($k); ?>" class="form-control">
                                        <option value="">Seçiniz</option>
                                        <?php foreach($tak_list AS $t) { ?>
                                            <option value="<?php echo e($t); ?>"><?php echo e($t); ?></option>
                                        <?php } ?>
                                    </select>   
                              </td>
                              <td>
                                <select name="<?php echo e($slug); ?>_c_soru_no_<?php echo e($k); ?>" id="<?php echo e($slug); ?>_c_soru_no_<?php echo e($k); ?>" class="form-control">
                                <option value="">Seçiniz</option>
                                    <?php for($a=1;$a<=$soru_sayi;$a++) { ?>
                                        <option value="<?php echo e($a); ?>"><?php echo e($a); ?></option>
                                    <?php } ?>
                                </select>
                              </td>
                              <td>
                                <select name="<?php echo e($slug); ?>_d_soru_no_<?php echo e($k); ?>" id="<?php echo e($slug); ?>_d_soru_no_<?php echo e($k); ?>" class="form-control">
                                <option value="">Seçiniz</option>
                                    <?php for($a=1;$a<=$soru_sayi;$a++) { ?>
                                        <option value="<?php echo e($a); ?>"><?php echo e($a); ?></option>
                                    <?php } ?>
                                </select>
                              </td>
                     
                          </tr>
                          <?php 

                        } ?>
                     </table>
                     
                     <?php 
                } ?>
                    <button class="btn btn-primary btn-fix btn-lg" style="position: fixed;
    bottom: 10px;
    z-index: 1000;
    right: 10px;"><i class="fa fa-save"></i> Değişiklikleri Kaydet</button>
                </form>
            </div>
    </div>
</div>
<?php } ?><?php /**PATH /home/dijimind/app/resources/views/admin/type/sinavlar/kazanimlar.blade.php ENDPATH**/ ?>