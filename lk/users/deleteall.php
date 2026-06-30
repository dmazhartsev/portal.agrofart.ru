<?php    
header ("Content-Type: text/html; charset=utf-8");
include ("../../sql/bd.php");

  $Name = 'Admin';

  $query = mysql_query("DELETE FROM users WHERE login<>'$Name'") or die(mysql_error());
  $query = mysql_query("ALTER TABLE users AUTO_INCREMENT=11") or die(mysql_error());

  
 
   exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/users'></head></html>");
