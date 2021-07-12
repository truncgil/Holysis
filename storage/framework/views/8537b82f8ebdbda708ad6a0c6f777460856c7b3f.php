

<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-plus"></i> <?php echo e(e2("Yeni Optik")); ?></h3>
            </div>
            <div class="block-content">
            <form action="?optik-ekle" method="post" enctype="multipart/form-data">
                Optik Dosyası (CSV, TXT vs.):
                <div class="input-group">
                <?php echo e(csrf_field()); ?>

                    <input type="file" name="dosya" required id="" class="form-control">
                    <button class="btn btn-primary">Ekle</button>
                </div>
            </form>
            <?php 
            if(getisset("optik-kaydet")) {
                $post = $_POST;
                unset($post['_token']);
                unset($post['file']);
                ekle([
                    'title' => post("title"),
                    "files" => post("file"),
                    "json" => json_encode_tr($post)
                ],"optik"); 
                alert("Optik Başarıyla Kaydedildi");
            }
            if(getisset("optik-guncelle")) {
                $post = $_POST;
                unset($post['_token']);
                unset($post['file']);
                db("optik")
                ->where("id",get("optik-guncelle"))
                ->update([
                    'title' => post("title"),
                    "files" => post("file"),
                    "json" => json_encode_tr($post)
                ]); 
                alert("Optik Başarıyla Kaydedildi");
            }
            if(getisset("optik-ekle")) {
                if(getisset("duzenle")) {
                    $optik = db("optik")->where("id",get("duzenle"))->first();
                    $dosya = $optik->files;
                    $title = $optik->title;
                    $json = j($optik->json);
                    $button = "Değişiklikleri Güncelle";
                    $action = "optik-guncelle={$optik->id}";
                } else {
                    $dosya = upload2("dosya","optik/"); 
                    $title = "";
                    $json = "";
                    $button = "Değişiklikleri Kaydet";
                    $action = "optik-kaydet";
                }
               
               $icerik = file_get_contents($dosya);
           
           //    $icerik = trk($icerik);
               
            //   $icerik = utf8_decode($icerik);
         //   $icerik = correct_encoding($icerik);
       //  $icerik = mb_convert_encoding($icerik, 'UTF-8', mb_detect_encoding($icerik, 'windows-1254', true));
    //   $icerik = mb_convert_encoding($icerik, 'UTF-8', mb_detect_encoding($icerik, 'UTF-8, ISO-8859-1', true));
               $satir = explode("\n",$icerik);
               $toplam = strlen($satir[0]);
              // echo $satir[0]; exit();
            //$icerik = trim($icerik);
        //    $icerik = str_replace("\n","<br>",$icerik);
               
                 ?>
                 <div class="row">
                    <div class="col-6">
                    <style>
                        .optik-onizleme * {
                            font-size:12px !important;
                            padding: 0 3px !important;
                        }
                        </style>
                        <div class="table-responsive" style="height:400px;overflow:auto">
                            <table class="table table-bordered optik-onizleme">
                                <tr>
                                <?php for($k=0;$k<$toplam;$k++) { ?>
                                    <th><?php echo e($k+1); ?></th>
                                <?php } ?>
                                </tr>
                            
                            <?php foreach($satir AS $i) {
                             //   $i = iconv('windows-1254', 'UTF-8', $i);
                               $i = encoder($i);

                                ?>
                                <tr>
                               
                                   <?php for($a=0;$a<$toplam;$a++) { 
                                       ?>
                                    <td><?php echo e(@$i[$a]); ?></td>
                                   <?php } ?>
                                </tr>

                                <?php 
                            } ?>
                            </table>
                        </div>
                    </div>
                  
                    <form action="?<?php echo e($action); ?>" method="post">
                       Dosya şu konuma yüklendi: <a href="<?php echo e(url($dosya)); ?>" target="_blank"><?php echo e($dosya); ?></a>
                    <input type="hidden" name="file" value="<?php echo e($dosya); ?>">
                    <?php echo e(csrf_field()); ?>

                    <div class="col-12">
                   
                            Optik Form Adı
                            <input type="text" name="title" required id="" value="<?php echo e($title); ?>" class="form-control">

                    </div>
                    <div class="col-12"> <br>
                        
                        <table class="table optik-table">
                            <thead>
                            <tr>
                                <td>Adı</td>
                                <td>Başlangıç</td>
                                <td>Bitiş</td>
                                <td>İşlem</td>
                            </tr>
                            </thead>
                           <tbody>
                           <?php 
                           $k = 0;
                           $brans = db("contents")->where("kid","branslar")->get();
                           if(is_array($json)) {
                           foreach($json['alan'] AS $alan) { ?>
                                <tr class="tr_clone">
                                    <td>
                                        <select name="alan[]" id=""   class="form-control alan-sec">
                                            <option  value="">Seçiniz</option>
                                            <option <?php if($alan=="T.C. Kimlik No") echo "selected"; ?> value="T.C. Kimlik No">T.C. Kimlik No</option>
                                            <option <?php if($alan=="Kitapçık") echo "selected"; ?> value="Kitapçık">Kitapçık</option>
                                            <option <?php if($alan=="Öğrenci Adı") echo "selected"; ?> value="Öğrenci Adı">Öğrenci Adı</option>
                                            <?php foreach($brans AS $br) { ?>
                                                <option <?php if($alan==$br->title) echo "selected"; ?> value="<?php echo e($br->title); ?>"><?php echo e($br->title); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><input type="number" min="0"  placeholder="Başlangıç" required max="<?php echo e($toplam); ?>" value="<?php echo e($json['bas'][$k]); ?>" name="bas[]" id="" class="form-control"></td>
                                    <td><input type="number" min="0"  placeholder="Bitiş"  required  max="<?php echo e($toplam); ?>"  value="<?php echo e($json['son'][$k]); ?>" name="son[]" id="" class="form-control"></td>
                                    <td><div class="btn btn-danger satir-sil" onclick='if(confirm("Bu satırı silmek istediğinizden emin misiniz?")) {
            $(this).parent().parent().remove();
        }'><i class="fa fa-trash"></i></div></td>
                                    
                                </tr>
                            <?php $k++; } ?>
                            <?php } else { ?>
                                <tr class="tr_clone">
                                    <td>
                                        <select name="alan[]" id=""  class="form-control alan-sec">
                                            <option  value="">Seçiniz</option>
                                            <option value="T.C. Kimlik No">T.C. Kimlik No</option>
                                            <option value="Kitapçık">Kitapçık</option>
                                            <option value="Öğrenci Adı">Öğrenci Adı</option>
                                            <?php foreach($brans AS $br) { ?>
                                                <option value="<?php echo e($br->title); ?>"><?php echo e($br->title); ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td><input type="number" min="0"  placeholder="Başlangıç" required max="<?php echo e($toplam); ?>" value="" name="bas[]" id="" class="form-control"></td>
                                    <td><input type="number" min="0"  placeholder="Bitiş"  required  max="<?php echo e($toplam); ?>"  value="" name="son[]" id="" class="form-control"></td>
                                    <td><div class="btn btn-danger satir-sil" onclick='if(confirm("Bu satırı silmek istediğinizden emin misiniz?")) {
            $(this).parent().parent().remove();
        }'><i class="fa fa-trash"></i></div></td>
                                    
                                </tr>
                            <?php } ?>
                            </tbody>
                           
                        </table>
                        <div class="btn btn-primary satir-ekle"><i class="fa fa-plus"></i> <?php echo e(e2("Alan Ekle")); ?></div>
                    
                    </div>
                    <br>
                    <div class="col-12">
                            <button class="btn btn-danger btn-block"><i class="fa fa-save"></i>  <?php echo e($button); ?></button>
                    </div>
                   
                 </div>
                 </form>
                 <?php 
            } ?>
            </div>
        </div>

    </div>
</div>


<script>
$(function(){
    $(".satir-ekle").on("click",function(){
        var table = $('.optik-table');
        lastRow = table.find('tbody tr:last');
        console.log(lastRow);
        rowClone = lastRow.clone();
        
        table.find('tbody').append(rowClone);
        table.find('tbody tr:last *').val("");
    });
    $(".alan-sec").on("change",function(){
        

    });
    $(".satir-sil").on("click",function(){
        
        
    });
});
</script><?php /**PATH /home/dijimind/app/resources/views/admin/type/optikler/yeni-optik.blade.php ENDPATH**/ ?>