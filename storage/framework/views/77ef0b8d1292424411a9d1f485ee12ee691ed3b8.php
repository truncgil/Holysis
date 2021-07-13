<?php 
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Contents;
use Illuminate\Support\Facades\DB;
$data = ( json_decode($_POST['data']));

foreach($data AS $d) {
	DB::table("contents")
	->where('id', $d[1])
	->update(["s" => $d[0]]);
}
$return = back();
echo $return;
 ?>
 <?php /**PATH /home/dijimin2/hacksmarcity/resources/views/admin-ajax/content-sort.blade.php ENDPATH**/ ?>