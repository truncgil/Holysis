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
                <h3 class="block-title">{{e2("Son Eklenen Sorular")}}</h3>
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
                    <div class="btn btn-primary">{{$c}}</div>
                <?php 
                  }?>
                </div>
                    <div class="float-right">
                        <div class="btn-group">
                            <a href="?soru-duzenle={{$s->id}}" class="btn btn-warning" title="{{e2("Bu soruyu düzenle")}}"><i class="fa fa-edit"></i></a>
                            <a href="?soru-sil={{$s->id}}" teyit="Soruyu silmek istediğinizden emin misiniz?" class="btn btn-danger" title="{{e2("Bu soruyu sil")}}"><i class="fa fa-times"></i></a>
                            
                        </div>
                    </div>
                </div>
                <div class="html">
                    <?php echo $s->html; ?>

                </div>
                <div class="block-content">
                    <h5 class="card-title">{{$s->brans}} / {{$s->konu}}</h5>
                    {{e2("Kazanim")}}: <p class="card-text">{{$s->kazanim}}</p>
                    <?php $sinif_duzey = explode(",",$s->sinif_duzey); ?>
                    {{e2("Sınfı Düzeyi")}} : <br>
                    <?php  foreach($sinif_duzey AS $c) {
                        if($c!="") {
                ?>
                    <div class="btn btn-info">{{$c}}. Sınıf</div>
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

</style>