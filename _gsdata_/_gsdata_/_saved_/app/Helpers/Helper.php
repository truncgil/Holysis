<?php 
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Contents;
use App\Fields;
use App\User;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
function number($str) {
	$str = str_replace(",",".",$str);
	$str = floatval($str);
	return $str;
}

function is_json($string) {
 json_decode($string);
 return (json_last_error() == JSON_ERROR_NONE);
}
function whereJ($db,$col,$isaret,$val,$fonk="") {
	$db = $db->whereRaw("$fonk(JSON_UNQUOTE(json_extract(json, '$.\"$col\"'))) $isaret $val");
	return $db;
}
function orWhereJ($db,$col,$isaret,$val,$fonk="") {
	$db = $db->orWhereRaw("$fonk(JSON_UNQUOTE(json_extract(json, '$.\"$col\"'))) $isaret $val");
	return $db;
}
function chart($type,$col,$val) {
	$id = rand(111,999);
	?>
	
					<canvas id="chart-area<?php echo $id ?>"></canvas>
			
					<script>
					

						var config<?php echo $id ?> = {
							type: '<?php echo $type ?>',
							data: {
								datasets: [{
									data: [
										<?php echo $val; ?>
									],
									backgroundColor: [
										window.chartColors.red,
										window.chartColors.orange,
										window.chartColors.yellow,
										window.chartColors.green,
										window.chartColors.blue,
									],
									label: 'Dataset <?php echo $id ?>'
								}],
								labels: [
									<?php echo $col; ?>
								]
							},
							options: {
								responsive: false
							}
						};

						window.onload = function() {
							var ctx<?php echo $id ?> = document.getElementById('chart-area<?php echo $id ?>').getContext('2d');
							window.test<?php echo $id ?> = new Chart(ctx<?php echo $id ?>, config<?php echo $id ?>);
						};

					
					</script>
	
	<?php
}
function upload($file,$folder="") {
	$request = \Request::all();
	
	$ext = $request[$file]->getClientOriginalExtension();
	$name = $request[$file]->getClientOriginalName();
	$path = $request[$file]->storeAs("files/$folder",$name);
	return "storage/app/$path";
}
function varmi($dizi) {
	if(count($dizi)>0) {
		return true;
	} else {
		return false;
	}
}
function slugtotitle($slug) {
	$slug = str_replace("-"," ",$slug);
	$slug = ucwords($slug);
	return $slug;
}

function seri() {
	?>
	<script type="text/javascript">
	$(function(){
	
			$(".seri").on("submit",function(e){ 
			var buton = $(".seri button");
			var ajax_alan = $(this).attr("ajax");
			if(ajax_alan==undefined) {
				ajax_alan = ".seri_ajax";
			}
			var yazi = buton.html();
			var data = $(this).serialize();
			buton.prop("disabled","disabled");
			e.preventDefault();
			var formData = new FormData($(this)[0]);
			$.ajax({
				url: $(this).attr("action"),
				type: "POST",
				cache : false,
				processData: false,  // tell jQuery not to process the data
				contentType: false,  // tell jQuery not to set contentType
				data: formData,
				success: function(d){
					buton.removeAttr("disabled");
					$(ajax_alan).html(d);
					
					
				}
			});
			return false;
		});
	});
	</script>
	<?php
}
 
function sf($id,$ajax=".ajax",$html="") {
$ajax = "$id $ajax";
?>
<script type="text/javascript">
$(function(){
	$("<?php echo $id ?>").on("submit",function(){
		var form = $("<?php echo $id ?>");
		var data = form.serialize(); 
		$(this).children("button").html("<?php e2("İşlem başarılı") ?>");
		$.ajax({
			type: "POST",
			url: form.attr("action"),
			data: data,
			dataType: "json",
			success: function(data) {
				<?php if($html=="") { ?>
					$("<?php echo $ajax ?>").html(d);
				<?php } else { ?>
					$("<?php echo $ajax ?>").html("<?php echo($html) ?>");
				<?php } ?>
				$("<?php echo $id ?> button").html("<?php e2("İşlem başarılı") ?>");
			}
		});
		return false;
	});
});
</script>
<?php
}
function c($slug) {
	$c = Contents::where("slug",$slug)->orWhere("id",$slug)->first();
	return $c;
}
function contents($type) {
	return Contents::where("kid",$type)
		->orWhere("type",$type)
//		->orWhere("title",$type)
		->get();
}
function kd() {
	return 0;
}
function users($level) {
	return User::where("level",$level)->get();
} 
function ksorgu() {
	return 0;
}
function e2($text) {
	echo __($text);
}
function set($text) {
	echo __($text);
}
function set_return($text) {
	return __($text);
}
function u() {
	return Auth::user();
}
function ekle($dizi,$tablo="contents") {
	oturumAc();
	
	
	$dizi['created_at'] = date("Y-m-d H:i:s");
	$dizi['uid'] = u()->id;
//	print_r($dizi);
	DB::table($tablo)->insert($dizi);
}
function dbFirst($tablo,$id) {
	return $s = DB::table($tablo)->where("id",$id)->first();
}
function db($tablo) {
	
	$s = DB::table($tablo);
	return $s;
}
function sorgu($tablo,$where="",$order="") {
	$s = DB::table($tablo);
	if(strpos("%",$where)!==false) {
		$s = $s->where("json","like","$where");
	} else {
		if($where!="") {
			$where = explode(",",$where);
			foreach($where AS $w) {
				$w2 = explode("=",$w);
				if(count($w2)>1) {
					$s = $s->whereJsonContains("json->".$w2[0],$w2[1]);
				}
				$w2 = explode("%",$w);
				if(count($w2)>1) {
					$s = $s->where("json","like",$w2[1]);
				}
				
			}
		}
	}
	if($order!="") $s = $s->orderByRaw($order);
	$cache = array();
	$sorgu = $s->simplePaginate(15);
	$col = array();
	$row = array();
	$cache['col'] = array();
	$cache['row'] =array();
	$cache['links'] ="";
	if(count($sorgu)>0) {
	
		foreach($sorgu AS $s) {
			$j = json_decode($s->json);
			$j->id = $s->id;
			$j->Create_Date = $s->created_at;
			unset($j->_token);
			array_push($cache,$j);
		}
		foreach($cache AS $a => $d) {
			array_push($row,$d);
		}
		foreach($cache[0] AS $a => $d) {
			array_push($col,str_replace("_"," ",$a));
		}
		$cache['col'] = $col;
		$cache['row'] = $row;
		$cache['row'] = array_filter($cache['row']);
		$cache['links'] = $sorgu->links();
		$cache['table'] = $tablo;
	}
	
	return  $cache;
}
function dbJson($db,$tablo="") { //db oluşturulmuş bir sorguyu json cache çıktısını verir. 
	
	$cache = array();
	$sorgu = $db;
	$col = array();
	$row = array();
	$cache['col'] = array();
	$cache['row'] =array();
	$cache['links'] ="";
	if(count($sorgu)>0) {
	
		foreach($sorgu AS $s) {
			$j = json_decode($s->json);
			$j->id = $s->id;
			$j->Create_Date = $s->created_at;
			unset($j->_token);
			array_push($cache,$j);
		}
		foreach($cache AS $a => $d) {
			array_push($row,$d);
		}
		foreach($cache[0] AS $a => $d) {
			array_push($col,str_replace("_"," ",$a));
		}
		$cache['col'] = $col;
		$cache['row'] = $row;
		$cache['row'] = array_filter($cache['row']);
		$cache['links'] = $sorgu->links();
		$cache['table'] = $tablo;
	}
	
	return  $cache;
}
function bilgi($text) {
	?>
	<div class="alert alert-success"><?php echo __($text); ?></div>
	<?php
}
function json_encode_tr($string)
{
    return json_encode($string, JSON_UNESCAPED_UNICODE);
}
function j($json,$true=true) {
	return json_decode($json,$true);
}
function get($isim) {
	if (isset($_GET[$isim])) { 
		return $_GET[$isim];
	} else {
		return "";
	}
}
function yonlendir($url) {
	header("Location: $url");
	exit();
}

function getisset($isim) {
	if (isset($_GET[$isim])) { 
		return 1;
	} else {
		return 0;
	}
}

function postEsit($post,$deger) {
	$post = post($post);
	if($post==$deger) {
		return 1;
	} else {
		return 0;
	}
}
function oturumEsit($oturum,$deger) {
	$oturum = oturum($oturum);
	if($oturum==$deger) {
		return 1;
	} else {
		return 0;
	}
}
function getEsit($get,$deger) {
	$get = get($get);
	if($get==$deger) {
		return 1;
	} else {
		return 0;
	}
}

function post($isim,$deger="") {
	if($deger!="") {
		$_POST[$isim] = $deger;
	} else {
		if (isset($_POST[$isim])) { 
			return @trim($_POST[$isim]);
		} else {
			return "";
		}
	}
}
function postisset($isim) {
	if (isset($_POST[$isim])) { 
		return 1;
	} else {
		return 0;
	}
}
function oturum($isim,$deger="") {
	oturumAc();
	if (isset($_SESSION[$isim])) {
		if ($deger=="") {
			return $_SESSION[$isim];
		} else {
			$_SESSION[$isim] = $deger;
			return $_SESSION[$isim];
		}
	} elseif ($deger!="") {
		$_SESSION[$isim] = $deger;
		return $_SESSION[$isim];

	}
}
function oturumisset($isim) {
	oturumAc();
	if (isset($_SESSION[$isim])) {
		return 1;
	} else {
		return 0;
	}
}
function oturumAc($sonuc="") { 
	if (!isset($_SESSION)) {
	  @session_start();
	  echo $sonuc;
	}
	}

function diger_ayarlar() {
	return explode(",","users,languages,contents,new,fields,search,ALL PRIVILEGES");
	
} 
function fields() {
	$fields = Fields::get();
	$fields = json_decode($fields,true);
	$fields2 = array();
	foreach(@$fields AS $r) {
		if(in_array($r['title'],$content_type)) {
			$fields2[$r['title']] = array(
				"values" => explode(",",$r['values']),
				"type" => $r['input_type'] 
			);
		}
		
	}
	$fields = $fields2;
/*
	if(isset($ct->fields)) {
		$content_fields = explode(",",$ct->fields); // içerik alanları
	}
*/
	return $fields;
}
	function json_field($json,$field) { //bir json içinde girilmiş alanı bulur bu aslında post ederken boşluk içeren alanlarda otomatik oluşan _ karakteri sorunundan dolayı üretildi
		return @$json[str_replace(" ","_",$field)];
		
	}
	function validBase64($string)
{
    $decoded = base64_decode($string, true);

    // Check if there is no invalid character in string
    if (!preg_match('/^[a-zA-Z0-9\/\r\n+]*={0,2}$/', $string)) return false;

    // Decode the string in strict mode and send the response
    if (!base64_decode($string, true)) return false;

    // Encode and compare it to original one
    if (base64_encode($decoded) != $string) return false;

    return true;
}
function isJSON($string){
   return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
}
function getLangFile($lang) {
	$path = "resources/lang/$lang".".json";
	if(file_exists($path)) {
		return file_get_contents($path);
	} else {
		$json = json_encode(array());
		file_put_contents($path,$json);
		return file_get_contents($path);
	}		
}
function putLangFile($lang,$json) {
	if(isJSON($json)) {
		return file_put_contents("resources/lang/$lang".".json",$json);	
	} else {
		return null;
	}
}
function is_html($string)
{
  return preg_match("/<[^<]+>/",$string,$m) != 0;
}