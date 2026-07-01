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
    $result = mysql_query ("UPDATE Riders SET Exp=0 WHERE (id = '$id')");

    exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/riders'></head></html>");
    ?>