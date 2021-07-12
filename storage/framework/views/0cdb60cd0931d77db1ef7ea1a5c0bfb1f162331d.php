
<div class="content">
    <div class="block">
            <div class="block-header block-header-default" >
                <h3 class="block-title"><i class="fa fa-plus"></i> <?php echo e(e2("Sınav Oku")); ?></h3>
            </div>
            <div class="block-content">
           
                <form action="?oku" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="btn btn-default">Okunacak Veri</div>
                            <input type="file" class="form-control" name="dosya" id="">
                        </div>
                        
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="btn btn-default">Uygulama Adı</div>
                            <input type="text" class="form-control" name="title" required id="">
                        </div>
                    </div>
                    <div class="col-md-6 d-none">
                        <div class="input-group">
                            <div class="btn btn-default">Sınıf Seviyesi</div>
                            <select name="level" id=""  class="form-control">
                                <option value="">Sınıf Seviyesi Seçiniz</option>
                            <?php for($k=2;$k<=13;$k++) { ?>
                                <option value="<?php echo e($k); ?>"><?php echo e($k); ?>. Sınıf</option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="btn btn-default">Sınav Şablonu</div>
                            <select name="sinav" id="" required class="form-control">
                                <option value="">Seçiniz</option>
                            <?php $sinav = db("sinavlar")->get(); foreach($sinav AS $s) {  ?>
                                <option value="<?php echo e($s->id); ?>"><?php echo e($s->title); ?></option>
                                <?php } ?>
                            </select>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="btn btn-default">Optik Şablonu</div>
                            <select name="optik" id="" required class="form-control">
                                <option value="">Seçiniz</option>
                            <?php $sinav = db("optik")->get(); foreach($sinav AS $s) {  ?>
                                <option value="<?php echo e($s->id); ?>"><?php echo e($s->title); ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 text-center"> <br>
                        <button class="btn btn-primary"><i class="fa fa-cog"></i> Oku</button>
                    </div>
                </div>
                    
                </form>
                <?php echo $__env->make("admin.type.sonuclar.sonuc-oku", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
    </div>
</div><?php /**PATH /home/dijimind/app/resources/views/admin/type/sonuclar/yeni-sonuc.blade.php ENDPATH**/ ?>