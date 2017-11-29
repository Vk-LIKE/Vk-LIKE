<?

define('LOGINA', 'Admin');
define('PASSA', 'admin');

if ($_GET[act] == 'logout') {
    setcookie('name', '', '0', '/');
    setcookie('pass', '', '0', '/');
    header('Location: login.php');
}

if (($_COOKIE["name"] == LOGINA) && ($_COOKIE["pass"] == PASSA)) {
    header("Location: index.php");
    exit;
}
if (isset($_POST[start])) {
    if ($_POST[login] === '') {
        unset($_POST[login]);
    } else {
        $login = $_POST[login];
    }
    if ($_POST[pass] === '') {
        unset($_POST[pass]);
    } else {
        $pass = $_POST[pass];
    }
    if (isset($login) and isset($pass)) {
        if (($login == LOGINA) && ($pass == PASSA)) {
            setcookie('name', $login, time() + 3600 * 1, '/');
            setcookie('pass', $pass, time() + 3600 * 1, '/');
            header('Location: ./');
        } else {
            $error = '<div class="alert alert-dismissable alert-danger">Не верно введен логин и пароль.
</div>';
        }
    } else {
        $error = '<div class="alert alert-dismissable alert-warning">Вы не заполнили все поля.
</div>';
    }
}
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Авторизация</title>
      <link href="/css/bootstrap.min.css" rel="stylesheet">
      <link href="/font-awesome/css/font-awesome.css" rel="stylesheet">
      <link href="/css/animate.css" rel="stylesheet">
      <link href="/css/style.css" rel="stylesheet">
   </head>
   <body class="gray-bg">
      <div class="middle-box text-center loginscreen" style="width: 600px">
         <div>
            <center><?=$error?></center>
            <form action="" method="post">
               <div class="form-group">
                  <input type="text" class="form-control" name="login" placeholder="Логин администратора" required="">
               </div>
               <div class="form-group">
                  <input type="password" class="form-control" placeholder="Пароль" name="pass" required="">
               </div>
               <button type="submit" name="start" class="btn btn-primary block full-width m-b">Авторизоваться</button>
            </form>
         </div>
      </div>
      <script src="/js/jquery-2.1.1.js"></script>
      <script src="/js/bootstrap.min.js"></script>
   </body>
</html>