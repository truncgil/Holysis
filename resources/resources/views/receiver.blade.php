<?php 
$hash = get("hash");
$hash2 = md5(get("mac").get("lat").get("lng"));
//echo " <br>$hash <br> $hash2";
//print_r($_GET);
//exit();
if($hash==$hash2) {
    
    $varmi = db("cihazlar")->where("mac",get("mac"))->get();
    if($varmi) { //eğer cihaz sistemde kayıtlıysa mevcut ip adresini alalım
        db("cihazlar")
        ->where("mac",get("mac"))
        ->update([
            "ip" => $_SERVER['REMOTE_ADDR'],
            "status" => "Aktif",
            "lat" => get("lat"),
            "lng" => get("lng"),
            "date" => simdi()
        ]);
    }
    
    ekle(array(
        "mac" => get("mac"),
        "data" => get("data"),
        "lat" => get("lat"),
        "lng" => get("lng"),
        "battery" => get("battery"),
        "date" => simdi()
    ),"pulse_data");
    echo "ok";

} else {
    echo "hash false";
}

?> 