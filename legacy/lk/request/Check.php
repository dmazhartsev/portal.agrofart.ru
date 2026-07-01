<?php  
header ("Content-Type: text/html; charset=utf-8");
session_start();  
include ("../../sql/bd.php");
if (isset($_POST['proekt'])) { $proekt=$_POST['proekt']; 
	if ($proekt =='') { unset($proekt);} } 
    if (empty($proekt)) { exit ("Нет пользователя!");} 

$xmlURL = "../../xml/".$proekt.".xml";

	
$currenttime = date("H:i:s");
    $date_today = date("m.d.y");
  $file = '../../xml/logcheck.txt';
  // Открываем файл для получения существующего содержимого
  $current = file_get_contents($file);
  // Добавляем нового человека в файл
  $current .= "[".$date_today."] [".$currenttime."] Проект:". $_SESSION['login']." Реестр проверен\n";
  // Пишем содержимое обратно в файл
  file_put_contents($file, $current);
exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/work'></head></html>");