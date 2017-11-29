<?
@session_start();
include(dirname(__FILE__) . "/bd.php");
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
$url     = $_POST["url"];
$captcha = $_POST["captcha"];
if ($_SESSION['rand_code'] != $captcha) {
    echo '<div class="alert alert-danger" role="alert" style="margin-bottom: 7px;text-align: initial;padding-left: 15px;">Не верный проверочный код!😈</div>';
} else {
    preg_match("/(wall-?|photo)\d+_\d+/", $url, $post);
    if ($post[0]) {
        $p       = $post[0];
        $getPost = mysql_fetch_assoc(mysql_query("SELECT * FROM posts WHERE post='$p'", $db));
        if ($getPost["post"]) {
        	echo '<div class="alert alert-danger" role="alert" style="margin-bottom: 7px;text-align: initial;padding-left: 15px;">Накрутка уже идёт! Ожидайте от 1 до 5 минут.</div>';
        } else {
            preg_match("/wall|photo/", $p, $type);
            if ($type[0]) {
                if ($type[0] == "photo") {
                    $check = apiadsd("https://api.vk.com/method/photos.getById?photos=" . str_replace("photo", "", $p));
                    if ($check["response"]) {
                        if($_SESSION['num_vk'] <= 6) {
                            $_SESSION['num_vk'] = $_SESSION['num_vk']+1;
                            mysql_query("INSERT INTO posts (post) VALUES ('$p')", $db);
                            $idvkls = $_SESSION['user_id'];
                            mysql_query("UPDATE access_token SET info = info + 1 WHERE owner_id = ".$idvkls."", $db);
                            echo '<div class="alert alert-success" role="alert" style="margin-bottom: 7px;text-align: initial;padding-left: 15px;">Накрутка началась! Ожидайте 1 минуту.⌚</div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert" style="margin-bottom: 7px;text-align: initial;padding-left: 15px;">Вы достигли суточного лимита накрутки. Зайтите через 1 час.</div>';
                        }
                    }
                } else {
                    $check = apiadsd("https://api.vk.com/method/wall.getById?posts=" . str_replace("wall", "", $p));
                    if ($check["response"]["0"]["id"]) {
                        if($_SESSION['num_vk'] <= 6) {
                            $_SESSION['num_vk'] = $_SESSION['num_vk']+1;
                            mysql_query("INSERT INTO posts (post) VALUES ('$p')", $db);
                            $idvkls = $_SESSION['user_id'];
                            mysql_query("UPDATE access_token SET info = info + 1 WHERE owner_id = ".$idvkls."", $db);
                            echo '<div class="alert alert-success" role="alert" style="margin-bottom: 7px;text-align: initial;padding-left: 15px;">Накрутка началась! Ожидайте 1 минуту.</div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert" style="margin-bottom: 7px;text-align: initial;padding-left: 15px;">Вы достигли суточного лимита накрутки. Зайтите через 1 час.</div>';
                        }
                    }
                }
            } else {
                echo '<div class="alert alert-danger" role="alert" style="margin-bottom: 7px;text-align: initial;padding-left: 15px;">Вы ввели неверную ссылку!</div>';

            }
        }
    } else {
        echo '<div class="alert alert-danger" role="alert" style="margin-bottom: 7px;text-align: initial;padding-left: 15px;">Вы ввели неверную ссылку!</div>';
    }
}
?>