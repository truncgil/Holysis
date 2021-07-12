<div class="content">
    <div class="block">
            <div class="block-header block-header-default" >
                <h3 class="block-title"><i class="fa fa-plus"></i> {{e2("Yeni Sınav")}}</h3>
            </div>
            <div class="block-content">
            <?php if(getisset("sinav-ekle")) {
                $dersler = array();
                $k=0;
                foreach($_POST['ders_slug'] AS $ders) {
                    if($_POST[$ders."_soru"]!="") {
                        $dersler[$ders] = [
                            "isim" => $_POST['ders'][$k],
                            'soru' => $_POST[$ders."_soru"],
                            'carpan' => $_POST[$ders."_carpan"],
                            'optik' => $_POST[$ders."_optik"]
                        ];
                    }
                    $k++;
                }
                ekle([
                    'title' => post("title"),
                    'date' => post("date"),
                    'sinif' => post("sinif"),
                    "json" => json_encode_tr($_POST),
                    "dersler" => json_encode_tr($dersler)
                ],"sinavlar");
                bilgi("Sınav başarılı bir şekilde kaydedildi");
            } ?>
            <?php if(getisset("sinav-duzenle")) {

            } ?>
                <form action="?sinav-ekle" method="post">
                    {{csrf_field()}}
                    Sınav Adı:
                    <input type="text" required name="title" id="" value="" class="form-control">
                    Sınav Tarihi:
                    <input type="datetime-local" required name="date" id="" value="" class="form-control">
                    Sınıf Düzeyi:
                    <select name="sinif[]" id="" required class="form-control select2" multiple>
                        <option value="">Sınıf Düzeyi</option>
                    <?php for($k=2;$k<=12;$k++) { ?>
                        <option value="{{$k}}">{{$k}}. Sınıf</option>
                    <?php } ?>
                    </select>
                    Sınav Süresi
                    <div class="input-group">
                        <input type="number" required name="sure" id="" value="" class="form-control">
                        <div class="btn btn-danger">Dakika</div>
                    </div>
                    
                    <br>
                    <br>
                    <div class="input-group">
                        <div class="btn btn-primary">Net Hesaplanırken:</div>
                        <select name="net" id="" class="form-control">
                            <option value="0">Net Hesabı Yok</option>
                            <option value="3">3 Yanlış 1 Doğruyu Götürür</option>
                            <option value="4">4 Yanlış 1 Doğruyu Götürür</option>
                            <option value="5">5 Yanlış 1 Doğruyu Götürür</option>
                        </select>
                       

                    </div>
                   
                    <br>
                    <strong>Sınav Detayları (Eklemek istemediğiniz dersleri boş bırakınız)</strong>
                    <?php  $branslar = contents("Branşlar"); ?>
                    <table class="table table-bordered">
                        <tr>
                            <th>Ders Adı</th>
                            <th>Soru Sayısı</th>
                            <th>Optik Sırası</th>
                            <th>Çarpan (%)</th>
                        </tr>
                        <?php foreach($branslar AS $b) {
                            ?>
                            <tr>
                                <td>{{$b->title}}</td>
                                <input type="hidden" name="ders[]" value="{{$b->title}}">
                                <input type="hidden" name="ders_slug[]" value="{{$b->slug}}">
                                <td><input type="number" name="{{$b->slug}}_soru" id="" class="form-control"></td>
                                <td><input type="number" name="{{$b->slug}}_optik" id="" class="form-control"></td>
                                <td><input type="number" name="{{$b->slug}}_carpan" id="" class="form-control"></td>
                            </tr>
                            <?php 
                        } ?>
                    </table>
   
                    <button class="btn btn-primary"><i class="fa fa-save"></i> {{e2("Kaydet")}}</button>
                </form>

            </div>
    </div>
</div>
    