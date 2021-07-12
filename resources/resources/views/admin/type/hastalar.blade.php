<div class="content">
 

            <?php 
            $level = u()->level;
            if($level=="Admin") {
 ?>
 @include("admin.type.hastalar.admin")
 <?php 
            } else {
 ?>
  @include("admin.type.hastalar.doktor")
 <?php 
            }
            ?>

  
</div>