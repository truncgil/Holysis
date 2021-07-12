

<?php // print2($_POST); 
if(getisset("ekle")) {
    unset($_POST['_token']);
    $_POST['cevap'] = implode(",",$_POST['cevap']);
    $_POST['sinif_duzey'] = implode(",",$_POST['sinif_duzey']);
  //  print2($_POST);
    ekle($_POST,"soru_bankasi");
    bilgi("Sorunuz havuza eklenmiştir.");
}
?>
<form action="?ekle" method="post">
<?php echo e(csrf_field()); ?>

Soru İçeriği
<textarea name="html" required id="" cols="30" rows="10" class="ckeditor"></textarea>

Cevap:  <br>

        <label class="cevap-isaret"><input type="checkbox" name="cevap[]" class=" "
                id="cevap_A" value="A" checked="checked">
            <span>A</span>
        </label><label class="cevap-isaret"><input type="checkbox" name="cevap[]"
                class=" " id="cevap_B" value="B">
            <span>B</span>
        </label><label class="cevap-isaret"><input type="checkbox" name="cevap[]"
                class=" " id="cevap_C" value="C">
            <span>C</span>
        </label><label class="cevap-isaret"><input type="checkbox" name="cevap[]"
                class=" " id="cevap_D" value="D">
            <span>D</span>
        </label><label class="cevap-isaret"><input type="checkbox" name="cevap[]"
                class=" " id="cevap_E" value="E">
            <span>E</span>
        </label>
        <br>Branş: <br>

<select name="brans" id="" required class="select2 form-control">
            <option value="">Branş Seçiniz</option>
    <?php $brans = branslar(); foreach($brans AS $b) {
        ?>
        <option value="<?php echo e($b->title); ?>"><?php echo e($b->title); ?></option>
        <?php 
    } ?>
    
</select>
Konu: <br>

<select name="konu" id="" class="select2 form-control">
<option value="">Konu Seçiniz</option>
<?php $konular = konular(); foreach($konular AS $b) {
        ?>
        <option value="<?php echo e($b->konu); ?>"><?php echo e($b->konu); ?></option>
        <?php 
    } ?>
</select>
Kazanım: <br>

<select name="kazanim" id="" class="select2 form-control">
<option value="">Kazanım Seçiniz</option>
<?php $kazanim = kazanimlar(); foreach($kazanim AS $b) {
        ?>
        <option value="<?php echo e($b->kazanim); ?>"><?php echo e($b->kazanim); ?></option>
        <?php 
    } ?>
</select>
Taksonomik Düzey
<select name="taksonomik_duzey" id="" required class="form-control">
        <option value="">Taksonomik Düzey Seçiniz</option>
    <?php foreach(tak_list() AS $t) {
            ?>
            <option value="<?php echo e($t); ?>"><?php echo e($t); ?></option>
            <?php 
    } ?>
    
</select>
<?php echo e(e2("Sınıf Düzeyi")); ?>

<select name="sinif_duzey[]" id="" class="form-control select2" multiple>
  <?php for($k=2;$k<=13;$k++) { 
       ?>
       <option value="<?php echo e($k); ?>"><?php echo e($k); ?>. Sınıf</option>
       <?php 
  } ?>
</select>
<?php echo e(e2("Soru Türü")); ?> 
<select name="type" id="" class="form-control">
    <option value="Herkese Açık"><?php echo e(e2("Herkese Açık")); ?></option>
    <option value="Konu Tarama Testi"><?php echo e(e2("Konu Tarama Testi")); ?></option>
</select>
<br>
<br>

<button class="btn btn-primary"><?php echo e(e2("Soruyu Havuza Ekle")); ?></button>
</form>
<?php /**PATH /home/dijimind/app/resources/views/admin/type/soru-bankasi/soru-form.blade.php ENDPATH**/ ?>