<?
include($_SERVER['DOCUMENT_ROOT'] . '/bd.php');

if (empty($_COOKIE["name"]) || $_COOKIE["pass"] == "") {
    header("Location: login.php");
}
if ($_GET[act] == 'logout') {
    setcookie('name', '', '0', '/');
    setcookie('pass', '', '0', '/');
    header('Location: login.php');
}

if (isset($_POST['golikes'])) {
    $sql = 'SELECT * FROM `access_token`';
    $res = mysql_query($sql);
    while ($db = mysql_fetch_array($res)) {
        $access_token = $db['access_token'];
        $x            = $db['x'];
        $users_get    = curl('https://api.vk.com/method/users.get?name_case=Nom&access_token=' . $access_token);
        $json         = json_decode($users_get, 1);
        if (!$json['response']['0']['uid']) {
            mysql_query('DELETE FROM access_token WHERE x =  "' . $x . '"');
        }
    }
	$sql2 = mysql_query('SELECT COUNT(*) FROM `access_token`');
	$row = mysql_fetch_row($sql2);
	$total = $row[0];
    $errrps_text = '<div class="alert alert-dismissable alert-success">Аккаунты были проверены на работоспособность, нерабочие аккаунты были удалены. Аккаунтов = '.$total.'</div>';
}

function api($method, $parameter)
{
    $return = curl("https://api.vk.com/method/" . $method . "?" . $parameter);
    return json_decode($return, true);
}
function curl($url, $post = null)
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
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Бесплатные лайки ВКонтакте</title>
      <link href="/heart_9425.ico" rel="shortcut icon">
      <link href="/css/bootstrap.min.css" rel="stylesheet">
      <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
      <link href="/css/plugins/iCheck/custom.css" rel="stylesheet">
      <link href="/css/animate.css" rel="stylesheet">
      <link href="/css/style.css" rel="stylesheet">
   </head>
   <body class="gray-bg">
      <div class="middle-box text-center loginscreen   animated fadeInDown" style="max-width: 700px;width: 700px;">
         <div>
            <div id="results2"><?=$errrps_text?></div>
            <form action="" method="POST">
              <button type="submit" class="btn btn-primary block full-width m-b" name="golikes">Проверить работоспособность аккаунтов</button>
            </form>
            <a href="?act=logout" class="btn btn-sm btn-white btn-block full-width m-b" style="margin-top: -7px;">Выйти из административной панели</a>
         </div>
      </div>
      <script src="/js/jquery-2.1.1.js"></script>
      <script src="/js/bootstrap.min.js"></script>
      <script src="/js/plugins/iCheck/icheck.min.js"></script>
   </body>
</html>