<?php 
@session_start();
include("bd.php");
if (empty($_COOKIE["auth_vk"])) {
    header("Location: adds.php");
}

class USER
{
    public static function numlikes($number)
    {
        
        $i10  = fmod($number, 10);
        $i100 = fmod($number, 100);
        
        // если делится на 10 и в остатке 1 и при этом делится на 100 и в остатке не 11
        // 1, 21, 31, 41, 51, 61
        if ($i10 == 1 && $i100 != 11) {
            return $number . ' объект';
        }
        
        // делится на 10 и остаток 2..4 и делится на 100 и остаток не 12..14;
        // 2-4, 22-24, 32-34
        if (($i10 >= 2 && $i10 <= 4 && fmod($i10, 1) == 0) && ($i100 < 12 || $i100 > 14)) {
            return $number . ' объекта';
        }
        
        // делится на 10 и остаток 0 или делится на 10 и остаток 5..9 или делится 100 и остаток 11..14;
        // 0, 5-20, 25-30, 35-40
        if ($i10 == 0 || ($i10 >= 5 && $i10 <= 9 && fmod($i10, 1) == 0) || ($i100 >= 11 && $i100 <= 14 && fmod($i100, 1) == 0)) {
            return $number . ' объектов';
        }
        
        // другие случаи
        return $number . ' объекта';
    }

    public static function numlikes2($number)
    {
        
        $i10  = fmod($number, 10);
        $i100 = fmod($number, 100);
        
        // если делится на 10 и в остатке 1 и при этом делится на 100 и в остатке не 11
        // 1, 21, 31, 41, 51, 61
        if ($i10 == 1 && $i100 != 11) {
            return $number . ' лайк';
        }
        
        // делится на 10 и остаток 2..4 и делится на 100 и остаток не 12..14;
        // 2-4, 22-24, 32-34
        if (($i10 >= 2 && $i10 <= 4 && fmod($i10, 1) == 0) && ($i100 < 12 || $i100 > 14)) {
            return $number . ' лайка';
        }
        
        // делится на 10 и остаток 0 или делится на 10 и остаток 5..9 или делится 100 и остаток 11..14;
        // 0, 5-20, 25-30, 35-40
        if ($i10 == 0 || ($i10 >= 5 && $i10 <= 9 && fmod($i10, 1) == 0) || ($i100 >= 11 && $i100 <= 14 && fmod($i100, 1) == 0)) {
            return $number . ' лайков';
        }
        
        // другие случаи
        return $number . ' лайка';
    }
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
      <div class="middle-box text-center loginscreen   animated fadeInDown" style="    width: 580px;">
         <div>
         	<div>
               <h1 class="logo-name" style="font-size: 73px;color:#5e81a8"> VK LIKE</h1><br>
            </div>
            <div id="wait2" style="display: none;margin-bottom: 7px;">
               <center><img src="images/upload_inv.gif" alt=""></center>
            </div>
            <div id="results5"></div>
            <div id="results2"></div>
            <?php
				$ret = mysql_query("SELECT * FROM access_token");
				if (mysql_num_rows($ret) > 0) {
				    if (!isset($_GET[edit])) {
				    		$ostalos = 6-$_SESSION['num_vk'];
				    		if($_SESSION['num_vk'] != 6) {
				    			echo '<div class="form-group">
				               <input type="text" name="url" id="url" class="form-control" onchange="preload()" placeholder="Ссылка на фотографию / публикацию" required="">
				            </div>
				            <div class="form-group">
				               <img src="/captcha.php" id="captcha222" style="cursor:pointer;" title="Нажмите чтобы обновить изображение" onclick="gcaptch()">
				            </div>
				            <div class="form-group">
				               <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Код с картинки" required="">
				            </div>
				            <button type="submit" class="btn btn-primary block full-width m-b" name="golikes" id="golikes" onclick="nakrutka()">      Получить лайки      </button>';
				    		} else {
				    			echo "Достигнут лимит накрутки. Зайдите через 1 час.";
				    		}
				    }
				} else {
				    echo 'Приносим свои извинения, накрутка временно недоступна!<br><br>';
				}
            $idvkls = $_SESSION['user_id'];
            $arq1           = mysql_query("SELECT * FROM access_token WHERE owner_id='$idvkls'");
            $arq            = mysql_fetch_array($arq1);
            if($arq['info'] == 0) {
               echo "";
            } else {
               echo 'Вы уже накрутили лайков на: '.USER::numlikes($arq['info']).'.<br>';
            }
            $arq2           = mysql_query("SELECT * FROM info");
            $ar2            = mysql_fetch_array($arq2);
            echo 'С помощью нашего сервиса уже накручено:💗 '.USER::numlikes2($ar2['likes']).'.';
			?>
         </div>
      </div>
      <script src="js/jquery-2.1.1.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/mys.js"></script>
      <script src="js/plugins/iCheck/icheck.min.js"></script>
  <body>
<html>
<br>
<center>
<button type="submit" style="width:400px;height:35px;" class="btn btn-primary block m-b" name="golikes" id="golikes" onclick="nakrutka();window.open('http://wlikes.ru/comment.php','_blank')">Комментарии/Отзывы</button>
</center>
<center>
<button type="submit" style="width:400px;height:35px;" class="btn btn-primary block m-b" name="golikes" id="golikes" onclick="nakrutka();window.open('http://gmy.su/:yv4j','_blank')"> Инструкция по накрутке лайков </button>
</center>
<center>
<button type="submit" style="width:400px;height:35px;" class="btn btn-primary block m-b" name="golikes" id="golikes" onclick="nakrutka();window.open('https://qiwi.me/wlikes','_blank')"> Пожертвовать на развитие сервиса </button>
</center>
<br>
<center>
<iframe frameborder="0" src="/frame.php" width="400" height="300" scrolling="no" style="overflow: hidden;"></iframe>
</center>
</body>
</html>
<center>
<script>var _uox = _uox || {};(function() {var s=document.createElement("script");
s.src="http://static.usuarios-online.com/uo2.min.js";document.getElementsByTagName("head")[0].appendChild(s);})();</script>
<a href="http://www.usuarios-online.com/es/" data-id="c2ecbcb9199735edabcdb2ff5b265581" data-type="color" data-c1="#5e81a7" data-c2="#ffffff" data-c3="#ffffff" target="_blank" id="uox_link">online</a>
</center>
<br>

   </body>
</html>