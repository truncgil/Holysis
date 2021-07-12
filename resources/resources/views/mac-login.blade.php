<?php use App\Contents; ?>

@extends('layouts.app')

@section("title","Spyhzer")
 
    

@section('content')
<div data-name="cihaz-bilgisi" class="page">
<div class="block">
<?php 
$hash = md5(get("mac"));

if(getesit("hash",$hash)) {
    $cihaz = db("cihazlar")
        ->where("mac",get("mac"))
        ->first();
    
    if(isset($cihaz->mac)) {
        if($cihaz->uid=="") { //cihazı sahiplen
             ?>
             @include("mac-login.taniyalim")
             <?php 
        } else { //cihaz sahipli giriş yap
          oturumAc();
          $kim = u2($cihaz->uid);
          oturum("uid",$kim->id);
          $_SESSION['user'] = $kim;
          db("users")->where("id",$kim->id)
          ->update([
               "mac" => $cihaz->mac
          ]);
          yonlendir("profile");
        }
        
    } else {
         ?>
         {{get("mac")}} <br>
         Bu Cihaz Sistemimizde Kayıtlı Değildir.
         <a href="?mac={{get("mac")}}&hash={{get("hash")}}&cihaz-sec" class="button external button-green">Farklı Bir Cihaz ile</a>

         <?php 
    }
 ?>
 
 <?php 
} else {
     ?>
     <div class="text-center">
        Anahtar erişim doğrulaması başarısız.
     </div>


     <?php 
}

 ?>
</div>
    
@endsection

