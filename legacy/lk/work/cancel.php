<?php
header ("Content-Type: text/html; charset=utf-8");
session_start();  
    if (isset($_POST['id'])) { $id=$_POST['id']; 
    if ($id =='') { unset($id);} } 
    if (empty($id))
//если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт     
          {     
          exit ("Не выбран!");     
          } 
    $id = trim($id);
 // подключаемся к базе
    include ("../../sql/bd.php"); 
    $result = mysql_query ("UPDATE dolg SET Exp=0 WHERE (id = '$id')");

    $currenttime = date("H:i:s");
    $date_today = date("m.d.y"); 

    $file = '../../xml/logsql.txt';
    // Открываем файл для получения существующего содержимого
    $current = file_get_contents($file);
    // Добавляем нового человека в файл
    $current .= "[".$date_today."] [".$currenttime."] Проект:". $_SESSION['login']." Задолженность ".$id." обнулена задолженность ".$Exp."\n";
    // Пишем содержимое обратно в файл
    file_put_contents($file, $current);

    exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/work'></head></html>");
    ?>