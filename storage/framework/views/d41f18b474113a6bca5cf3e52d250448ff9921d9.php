<?php 
if(getisset("id")) {
	$sil = db("translate")->where("id",get("id"))->delete();
	echo  $sil;
	
}
 ?><?php /**PATH /home/dijimin2/hacksmarcity/resources/views/admin-ajax/translate-sil.blade.php ENDPATH**/ ?>