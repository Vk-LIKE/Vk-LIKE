<?
@session_start();
include(dirname(__FILE__) . "/bd.php");

$url = $_POST["url"];
preg_match("/(wall-?|photo)\d+_\d+/", $url, $post);
if ($post[0]) {
	$p = $post[0];
	preg_match("/wall|photo/", $p, $type);
	if ($type[0]) {
		if ($type[0] == "photo") {
			$check = apiadsd("https://api.vk.com/method/photos.getById?photos=" . str_replace("photo", "", $p));
			if ($check["response"]) {
				$src = $check["response"]["0"]["src"];
				if($check["response"]["0"]["src_big"]) $src = $check["response"]["0"]["src_big"];
				elseif($check["response"]["0"]["src_xbig"]) $src = $check["response"]["0"]["src_xbig"];
				elseif($check["response"]["0"]["src_xxbig"]) $src = $check["response"]["0"]["src_xxbig"];
?>
<div style="background-color: #FFFFFF;background-image: none;border: 1px solid #e5e6e7;border-radius: 1px;padding: 10px;">
	<img src="<?=$src;?>" style="width: 30%;border-radius: 1px;">
</div>
<?
			}
		} else {
			$check = apiadsd("https://api.vk.com/method/wall.getById?posts=" . str_replace("wall", "", $p));
			if ($check["response"]["0"]["id"]) {
				
?>
<div style="background-color: #FFFFFF;background-image: none;border: 1px solid #e5e6e7;border-radius: 1px;padding: 10px;">
<?
				if($check["response"]["0"]["text"]){
?>
<span><?=$check["response"]["0"]["text"];?></span>
<?
				}
				if($check["response"]["0"]["text"] && $check["response"]["0"]["attachments"]["0"]["type"] == "photo") echo "<hr>";
				if($check["response"]["0"]["attachments"]["0"]["type"] == "photo"){
					$src = $check["response"]["0"]["attachments"]["0"]["photo"]["src"];
					if($check["response"]["0"]["attachments"]["0"]["photo"]["src_big"]) $src = $check["response"]["0"]["attachments"]["0"]["photo"]["src_big"];
					elseif($check["response"]["0"]["attachments"]["0"]["photo"]["src_xbig"]) $src = $check["response"]["0"]["attachments"]["0"]["photo"]["src_xbig"];
					elseif($check["response"]["0"]["attachments"]["0"]["photo"]["src_xxbig"]) $src = $check["response"]["0"]["attachments"]["0"]["photo"]["src_xxbig"];
?>
<img src="<?=$src;?>" style="width: 30%;border-radius: 1px;">
<?
				}
?>
</div>
<?
			}
		}
	} else {
		echo '<div class="alert alert-danger" role="alert" style="margin-bottom: 7px;text-align: initial;padding-left: 15px;">Вы ввели неверную ссылку!</div>';
	}
} else {
	echo '<div class="alert alert-danger" role="alert" style="margin-bottom: 7px;text-align: initial;padding-left: 15px;">Вы ввели неверную ссылку!</div>';
}
function apiadsd($url, $post = null)
{
    return json_decode(curladsd($url, $post), 1);
}
function curladsd($url, $post = null)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.0.3) Gecko/2008092417
	Firefox/3.0.3');
    if ($post) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    }
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}
?>