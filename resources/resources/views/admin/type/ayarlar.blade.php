<?php $path = "admin.type.ayarlar"; ?>
<div class="content">
    <div class="block">
        <ul class="nav nav-tabs nav-tabs-block" data-toggle="tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" href="#rapor-sablonlari">Rapor Şablonları</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#uygulama-ayarlari">Uygulama Ayarları</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#bildirim-ayarlari">Bildirim Ayarları</a>
            </li>
            <li class="nav-item ml-auto d-none">
                <a class="nav-link" href="#btabs-static-settings">
                    <i class="si si-settings"></i>
                </a>
            </li>
        </ul>
        <div class="block-content tab-content">
            <div class="tab-pane active" id="rapor-sablonlari" role="tabpanel">
               @include("$path.rapor-sablonlari")
            </div>
            <div class="tab-pane" id="uygulama-ayarlari" role="tabpanel">
            @include("$path.uygulama-ayarlari")
            </div>
            <div class="tab-pane" id="bildirim-ayarlari" role="tabpanel">
            @include("$path.bildirim-ayarlari")
            </div>
        </div>
    </div>
</div>