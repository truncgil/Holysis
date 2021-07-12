<?php $sorgu = db("planning-board")->orderBy("id","DESC")->first(); 
$sorgu = json_decode($sorgu->json,true);
//print_r($sorgu);
?>