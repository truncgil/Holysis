<?php $u = u();
//print2($u);
$level = $u->level;

if(getisset("soru-sil")) {
    db("soru_bankasi")
    ->where("id",get("soru-sil"))
    ->where("uid",$u->id)
    ->delete();
    bilgi("Soru silinmiştir.");
}

?>
<div class="content">
    <div class="block">
            <div class="block-header block-header-default">
                <h3 class="block-title"><i class="fa fa-plus"></i> Yeni Soru Ekle</h3>
            </div>
            <div class="block-content">
               
               @include("admin.type.soru-bankasi.soru-form")
            </div>

            

        </div>

    </div>
</div>
<div class="content">
    @include("admin.type.soru-bankasi.liste")
</div>