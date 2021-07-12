<?php $sinav = table_to_array("sinavlar","id");
$user = table_to_array2("users","id");
?>
<div class="content">
    <div class="block">
            <div class="block-header block-header-default" >
                <h3 class="block-title"><i class="fa fa-plus"></i> {{e2("Son Okunan Sınavlar")}}</h3>
            </div>
            <div class="block-content">
                <div class="table-responsive">
                <?php $sorgu = db2("sonuclar")
                ->select("*",'title', DB::raw('count(*) as total'))
                ->wherein("uid",u()->alias_ids)
                ->groupBy('title')
                ->orderBy("id","DESC")
                ->get();
               // print2($sorgu); exit();
                ?>
                    <table class="table">
                        <tr>
                            <th>Sınav Adı</th>
                            <th>Uygulama Adı</th>
                            <th>Tamamlayan</th>
                            <th>Uygulama Zamanı</th>
                            <th>Başlangıç Zamanı</th>
                            <th>Bitiş Zamanı</th>
                        
                            <th>Uygulayan Personel</th>
                            <th>İşlem</th>
                        </tr>
                        <?php foreach($sorgu AS $s) { 
                            $this_sinav = $sinav[$s->sinav_id];
                            $this_sinav_json = j($this_sinav->json);
                            $this_user = $user[$s->uid]; 
                            ?>
                        <tr>
                            <td>{{$this_sinav->title}}</td>
                            <td>{{$s->title}}</td>
                            <td>
                                <div class="progress">
                                    <div class="progress-bar" style="width:{{$s->total}}%">{{$s->total}}</div>
                                </div>
                            </td>
                            <td>{{df($s->created_at)}}</td>
                            <td>{{df($this_sinav_json['date'])}}</td>
                            <td>{{df($this_sinav_json['date'])}}</td>
                          
                            <td>{{$this_user->name}} {{$this_user->surname}}</td>
                            <td>
                                <a href="" class="btn btn-primary">Sonuç Listesi</a>
                                <a href="" class="btn btn-danger">Raporlar</a>
                            </td>
                        </tr>
                        <?php } ?>

                    </table>
                </div>
            </div>
    </div>
</div>