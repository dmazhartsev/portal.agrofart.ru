<?php
session_start();
// проверяем наличие переменных $width и $height
if (isset($_GET['lat']) AND isset($_GET['lng'])) {
        // Здесь пишем код, который выполнится, если переменные
        // существуют. Их, например, можно записать в
        // текстовый файл или добавить в базу данных
$file = '../xml/coords.txt';
$current = file_get_contents($file);
$date_today = date("m.d.y");
$currenttime = date("H:i:s");
$current .= "[".$date_today."] [".$currenttime."] Пользователь ".$_SESSION['login']." Широта ".$_GET['lat']." Долгота ".$_GET['lng']." Погрешность ".$_GET['acc']." \n";
file_put_contents($file, $current);


}
elseif (isset($_GET['mes'])) {
$file = '../xml/coords.txt';
$current = file_get_contents($file);
$date_today = date("m.d.y");
$currenttime = date("H:i:s");
$current .= "[".$date_today."] [".$currenttime."] Пользователь: ".$_SESSION['login']." Error: ".$_GET['mes']." Code: ".$_GET['code']." \n";
file_put_contents($file, $current);
 } 

?>

