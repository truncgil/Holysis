<?php 
header("Content-Type: text/plain");
$sorgu = db("sap")->get();
$files = "";
foreach($sorgu AS $s) {
	$file = file_get_contents($s->title);
	$files .=$file;
}
echo $files;
 ?>