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
               <?php echo $__env->make("$path.rapor-sablonlari", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane" id="uygulama-ayarlari" role="tabpanel">
            <?php echo $__env->make("$path.uygulama-ayarlari", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="tab-pane" id="bildirim-ayarlari" role="tabpanel">
            <?php echo $__env->make("$path.bildirim-ayarlari", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
        </div>
    </div>
</div><?php /**PATH /home/dijimind/app/resources/views/admin/type/ayarlar.blade.php ENDPATH**/ ?>