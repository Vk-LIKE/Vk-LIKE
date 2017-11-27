<?php
session_start();
$string = "";
for ($i = 0; $i < 5; $i++)
    $string .= chr(rand(97, 122));

$_SESSION['rand_code'] = $string;

$dir = "fonts/";

$image = imagecreatetruecolor(170, 50);
$black = imagecolorallocate($image, 0, 0, 0);
$color = imagecolorallocate($image, 94, 129, 168);
$white = imagecolorallocate($image, 243,243,244);

imagefilledrectangle($image, 0, 0, 399, 99, $white);
imagettftext($image, 30, 0, 10, 37, $color, $dir . "verdana.ttf", $_SESSION['rand_code']);

header("Content-type: image/png");
imagepng($image);
?>