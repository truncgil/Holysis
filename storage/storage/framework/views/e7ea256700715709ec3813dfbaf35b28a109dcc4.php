<?php $pulse = db("pulse_data")
->where("created_at",">=",get("d1")) 
->where("created_at","<=",get("d2")) 
->where("mac",get("id"))
->get();
 ?>
 <div class="row">
 <?php 
foreach($pulse AS $p) {
     ?>
     <div class="zaman" data-id="<?php echo e($p->id); ?>">
        <?php echo e(df($p->created_at,"d/m H:i")); ?> 
     </div>
     <?php 
}
?>  
 </div>
<script>
    $(function(){
        $(".zaman").on("click",function(){
            $(".zaman").removeClass("active");
            $(this).addClass("active");
            $.get("?ajax=ekg&id=<?php echo e($_GET['id']); ?>",{
                data : $(this).attr("data-id")
            },function(d){
                $(".ekg-zone").html(d);
            });
        });
    //    $(".ekg-zone").load("?ajax=ekg&id=<?php echo e($_GET['id']); ?>&")
    });
</script>
 <style>
    .zaman {
        float:left;
        padding:5px;
        margin:5px;
    } 
    .zaman:hover,.zaman.active {
       
        cursor:pointer;
        background:#f4ba1f
    }
 </style><?php /**PATH /home/sphyzer/app/resources/views/admin-ajax/ekg-date.blade.php ENDPATH**/ ?>