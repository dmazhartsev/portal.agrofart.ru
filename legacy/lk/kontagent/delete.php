<?php
header ("Content-Type: text/html; charset=utf-8");
    if (isset($_POST['id'])) { $id=$_POST['id']; 
    if ($id =='') { unset($id);} } 
    if (empty($id))
//если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт     
          {     
          exit ("Не выбран!");     
          } 
    $id = trim($id);
 // подключаемся к базе
    include ("../../sql/bd.php"); // файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
    $query = "DELETE FROM kontragents WHERE (id = '$id')";
    mysql_query($query) or die(mysql_error());
    $query = "DELETE FROM torgtochki WHERE (idKa = '$id')";
    mysql_query($query) or die(mysql_error());
    exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/kontagent'></head></html>");
    ?>