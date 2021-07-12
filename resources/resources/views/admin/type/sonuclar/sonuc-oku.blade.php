<?php if(getisset("oku")) {
                  //  print_r($_POST);
                $analiz = file_to_analiz("dosya");
                $eklenen = 0;
                $guncellenen = 0;
                 ?>
                 <h3>Okuma Sonucu Şu Şekilde</h3>

                 <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ÖĞRENCİ ADI</th>
                                <th>TC KİMLİK NO</th>
                                <th>KİTAPÇIK</th>
                                <th>ANALİZ SONUÇLARI</th>
                              
                            </tr>
                        
                        </thead>
                        <tbody>
                        <?php foreach($analiz AS $a) { ?>
                            <tr>
                                <td>{{$a['ogrenci-adi']}}</td>
                                <td>{{$a['tc-kimlik-no']}}</td>
                                <td>{{$a['kitapcik']}}</td>
                                <td>
                                
                                     <table class="table table-striped table-hover table-sm">
                                        <tr>
                                            <th>Ders Adı</th>
                                            <th>Doğru</th>
                                            <th>Yanlış</th>
                                            <th>Boş</th>
                                            <th>Cevaplar</th>
                                       
                                        </tr>
                                        <?php foreach($a['analiz'] AS $alan => $deger) {
                                            $alan = trim($alan);
                                     ?>
                                         <tr>
                                             <td>{{slug_to_title($alan)}}</td>
                                             <td>
                                                <div class="badge badge-success">{{$deger['dogru']}}</div> <br>
                                               
                                                {{implode(", ",$deger['kazanim-dogru'])}} <br>
                                                {{implode(", ",$deger['tak-dogru'])}} <br>
                                             </td>
                                             <td>
                                             <div class="badge badge-danger">{{$deger['yanlis']}}</div> <br>
                                             
                                                {{implode(", ",$deger['kazanim-yanlis'])}} <br>
                                                {{implode(", ",$deger['tak-yanlis'])}} <br>
                                             </td>
                                             <td>
                                             <div class="badge badge-warning">{{$deger['bos']}}</div> <br>
                                            
                                                {{implode(", ",$deger['kazanim-bos'])}} <br>
                                                {{implode(", ",$deger['tak-bos'])}} <br>
                                             </td>
                                            <td>{{$deger['cevaplar']}}</td>
                                         </tr>
                                         <?php 
                                } ?>
                                     </table>
                                     
                                </td>
                            </tr>
                        <?php 
                        $varmi = db("sonuclar")
                        ->where("sinav_id",post("sinav"))
                        ->where("ogrenci_adi",$a['ogrenci-adi'])
                        ->count();
                        $ogrenci_varmi = 0;
                        if(trim($a['tc-kimlik-no'])!="") {
                            $ogrenci_varmi = db("ogrenciler")
                            ->where("id",$a['tc-kimlik-no'])
                            ->orWhere("tc_kimlik_no",$a['tc-kimlik-no'])
                            ->count();
                        } else {
                            $ogrenci_varmi = db("ogrenciler")
                            ->where("title",$a['ogrenci-adi'])
                            ->count();
                            
                        }
                        
                        if($ogrenci_varmi==0) {
                            bilgi("{$a['ogrenci-adi']} eklendi");
                            ekle([
                                "title" => $a['ogrenci-adi'],
                                "tc_kimlik_no" => $a['tc-kimlik-no']
                            ],"ogrenciler");
                        }
                        
                        if($varmi==0) {
                            ekle([
                                "title" => post("title"),
                                "level" => post("level"),
                                "sinav_id" => post("sinav"),
                                "optik_id" => post("optik"),
                                "ogrenci_adi" => $a['ogrenci-adi'],
                                "tc_kimlik_no" => $a['tc-kimlik-no'],
                                "kitapcik" => $a['kitapcik'],
                                "analiz" => json_encode_tr($a['analiz'])
                            ],"sonuclar");
                            $eklenen++;
                        } else {
                            db("sonuclar")
                            ->where("sinav_id",post("sinav"))
                            ->where("ogrenci_adi",$a['ogrenci-adi'])
                            ->update([
                                "sinav_id" => post("sinav"),
                                "optik_id" => post("optik"),
                                "ogrenci_adi" => $a['ogrenci-adi'],
                                "tc_kimlik_no" => $a['tc-kimlik-no'],
                                "kitapcik" => $a['kitapcik'],
                                "analiz" => json_encode_tr($a['analiz'])
                            ]);
                            $guncellenen++;
                        }
                    
                 //   yonlendir()
                      
                    } ?>
                        </tbody>
                    </table>
                 </div>
                
                 <?php 
                   bilgi("$eklenen öğrencinin sonucu eklenmiştir, $guncellenen öğrencinin sonucu güncellenmiştir");
            } ?>