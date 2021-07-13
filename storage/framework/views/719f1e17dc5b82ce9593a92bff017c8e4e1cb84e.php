
<?php 

$dosya = file_get_contents("storage/app/files/truncgil-teknoloji/sonuclar/fkbtxt.txt");

$dosya = explode("\n",$dosya);

echo substr($dosya[0],55,1);
echo substr($dosya[1],55,1);
echo substr($dosya[2],55,1);
echo substr($dosya[3],55,1);
?><?php /**PATH /home/dijimin2/hacksmarcity/resources/views/test.blade.php ENDPATH**/ ?>