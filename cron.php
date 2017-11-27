<?
include(dirname(__FILE__)."/bd.php");

$getPost = mysql_fetch_assoc(mysql_query("SELECT * FROM posts ORDER BY x ASC",$db));
$getToken = mysql_query("SELECT * FROM access_token ORDER BY x DESC",$db);
$x = $getPost["x"];
if($getPost["post"]){
	
	preg_match("/wall|photo/", $getPost["post"],$type);
	list($owner_id,$item_id) = explode("_",str_replace($type[0],"",$getPost["post"]));
	
	if($type[0] == "wall") $type[0] = "post";
	
	while($r = mysql_fetch_assoc($getToken)){
		$token[] = $r["access_token"];
	}
	if(count($token) > 10) $a = 50;
	else $a = count($token);
	
	for($i=0;$i<$a;$i++){
		$g = api("https://api.vk.com/method/likes.add?type=".$type[0]."&owner_id=".$owner_id."&item_id=".$item_id."&access_token=".$token[$i]);
		print_r($g);
		usleep(900);
	}
	
	mysql_query("UPDATE info SET likes=likes+$i WHERE 1",$db);
	mysql_query("DELETE FROM posts WHERE x='$x'",$db);
}else echo "постов нет";
function api($url, $post = null){
   return json_decode(curl($url,$post),1);
}
function curl($url, $post = null){
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
	if($post){             
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	$response = curl_exec( $ch );
	curl_close( $ch );
	return $response;
}
?>