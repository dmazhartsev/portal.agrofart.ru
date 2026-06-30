<?php    
header ("Content-Type: text/html; charset=utf-8");
include ("../../sql/bd.php");

  $Name = 999999;

  $query = mysql_query("DELETE FROM dolg WHERE proekt<>'$Name'") or die(mysql_error());
  $query = mysql_query("ALTER TABLE dolg AUTO_INCREMENT=0") or die(mysql_error());

  
 
   exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/work'></head></html>");
