
<form action="" method="post" class="block ">
    <div class="block-header block-header-default">Yeni Cihaz Kayıt Formu</div>
    <div class="block-content">
        <?php echo e(csrf_field()); ?>

        Cihazın Mac Adresi:
        <input type="text" name="mac" required id="" class="form-control"> 
        <br>
        <button class="btn btn-primary">Ekle</button>
    </div>
</form><?php /**PATH /home/sphyzer/app/resources/views/admin/type/cihazlar/form.blade.php ENDPATH**/ ?>