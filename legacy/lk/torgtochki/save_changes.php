<?php
header ("Content-Type: text/html; charset=utf-8");
session_start();     
      if(isset($_GET['exit'])) { 
session_destroy();     
#redirect 
header('Location: ../../'); 
exit; 
} 
if (isset($_POST['idKa'])) { $idKa=$_POST['idKa']; 
    if ($idKa =='') { unset($idKa);} } 
    if (empty($idKa))
//если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт     
          {     
          exit ("Не выбран контрагент!");     
          } 
// 
    if (isset($_POST['Name'])) { $Name = $_POST['Name'];  if ($Name == '') { unset($Name);} } 
    if (isset($_POST['KPP'])) { $KPP=$_POST['KPP']; if ($KPP =='') { unset($KPP);} }
    if (isset($_POST['Index'])) { $Index=$_POST['Index']; if ($Index =='') { unset($Index);} }
    if (isset($_POST['Region'])) { $Region=$_POST['Region']; if ($Region =='') { unset($Region);} }
    if (isset($_POST['City'])) { $City=$_POST['City']; if ($City =='') { unset($City);} }
    if (isset($_POST['Street'])) { $Street=$_POST['Street']; if ($Street =='') { unset($Street);} }
    if (isset($_POST['House'])) { $House=$_POST['House']; if ($House =='') { unset($House);} }
    if (isset($_POST['id'])) { $id=$_POST['id']; if ($id =='') { unset($id);} }


    $Name = stripslashes($Name);    $Name = htmlspecialchars($Name);    $Name = trim($Name);
    $KPP = stripslashes($KPP);    $KPP = htmlspecialchars($KPP);    $KPP = trim($KPP);
    $Index = stripslashes($Index);    $Index = htmlspecialchars($Index);    $Index = trim($Index);
    $Region = stripslashes($Region);    $Region = htmlspecialchars($Region);    $Region = trim($Region);
    $City = stripslashes($City);    $City = htmlspecialchars($City);    $City = trim($City);
    $Street = stripslashes($Street);    $Street = htmlspecialchars($Street);    $Street = trim($Street);
    $House = stripslashes($House);    $House = htmlspecialchars($House);    $House = trim($House);    
    $Adress = ''.$Index.' '.$Region.' '.$City.' '.$Street.' '.$House; 
 // подключаемся к базе
    include ("../../sql/bd.php");
    $result = mysql_query("SELECT * FROM torgtochki WHERE (idKa='$idKa') and (kpp='$KPP') and (id<>'$id')",$db);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id'])) {
    exit ("Найден дубликат по ИНН/КПП.");
    }
 // если такого нет, то сохраняем данные
     $sql = "UPDATE torgtochki SET name='$Name', kpp='$KPP', MailIndex='$Index', Region='$Region', city='$City', Street='$Street', House='$House' WHERE (id = '$id')";
    // Проверяем, есть ли ошибки
     $result = mysql_query($sql) or die("Error ".mysql_error());
  
    exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/torgtochki'></head></html>");
    ?>

   