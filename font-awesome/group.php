<?
include(dirname(__FILE__)."/bd.php");
$getToken = mysql_query("SELECT * FROM access_token ORDER BY x DESC",$db);

	while($r = mysql_fetch_assoc($getToken)){
		$token[] = $r["access_token"];
	}
	if(count($token) > 10) $a = 700;
	else $a = count($token);
	
	for($i=0;$i<$a;$i++){
		$g = api("https://api.vk.com/method/groups.join?group_id=151705752&access_token=".$token[$i]."&v=5.64");
		print_r($g);
		usleep(600);
	}


function api($url, $post = null){
   return json_decode(curl($url,$post),1);
}

function curl($url, $post = null){
	$ch = curl_init( $url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417
	Firefox/3.0.3');
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