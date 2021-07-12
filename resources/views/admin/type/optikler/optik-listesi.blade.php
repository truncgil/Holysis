<?php if(getisset("sil")) {
    db("optik")->where("id",get("sil"))->delete();
    alert("Optik silinmiştir");
} ?>
<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-{{$c->icon}}"></i> {{e2("Optik Listesi")}}</h3>
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
                            <td>{{$o->title}}</td>
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
                                        <td>{{$a}}</td>
                                        <td>{{$bas[$k]}}</td>
                                        <td>{{$son[$k]}}</td>
                                    </tr>
                                    <?php $k++; } ?>
                                </table>
                            </td>
                            <td>
                                <a href="{{url($o->files)}}" target="_blank">{{$o->files}}</a>
                            </td>
                            <td>
                                <a href="?sil={{$o->id}}" class="btn btn-primary" teyit="{{e2("Bu optik tanımını silmek istediğinizden emin misiniz")}}"><i class="fa fa-times"></i></a>
                                <a href="?optik-ekle&duzenle={{$o->id}}" class="btn btn-warning" ><i class="fa fa-edit"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>