<?php 

oturumAc();
$tarih = date("Y-m-d H:i:s",strtotime("-1 minute"));

$sorgu = db("pulse_data")
->where("created_at",">=",$tarih) //bir dk öncesine kadarki olan veriyi almalıyız
->where("mac",u()->mac)
->orderBy("id","DESC")
->first();
header('Content-Type: application/json');
if($sorgu) {
    echo json_encode_tr($sorgu);
} else {
    $sonuc = ["error"=> 'Cihaz Bağlı Değil'];
    echo json_encode_tr($sonuc);
}

?>