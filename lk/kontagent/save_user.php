<?php
header ("Content-Type: text/html; charset=utf-8");
session_start();     
      if(isset($_GET['exit'])) { 
session_destroy();     
#redirect 
header('Location: ../../'); 
exit; 
} 
// 
    if (isset($_POST['Name'])) { $Name = $_POST['Name'];  if ($Name == '') { unset($Name);} } 
    if (isset($_POST['INN'])) { $INN=$_POST['INN']; if ($INN =='') { unset($INN);} }
    if (isset($_POST['KPP'])) { $KPP=$_POST['KPP']; if ($KPP =='') { unset($KPP);} }
    if (isset($_POST['Index'])) { $Index=$_POST['Index']; if ($Index =='') { unset($Index);} }
    if (isset($_POST['Region'])) { $Region=$_POST['Region']; if ($Region =='') { unset($Region);} }
    if (isset($_POST['City'])) { $City=$_POST['City']; if ($City =='') { unset($City);} }
    if (isset($_POST['Street'])) { $Street=$_POST['Street']; if ($Street =='') { unset($Street);} }
    if (isset($_POST['House'])) { $House=$_POST['House']; if ($House =='') { unset($House);} }
    if (isset($_POST['DayDZ'])) { $DayDZ=$_POST['DayDZ']; if ($DayDZ =='') { unset($DayDZ);} }
    if (isset($_POST['EmailDirector'])) { $EmailDirector=$_POST['EmailDirector']; if ($EmailDirector =='') { unset($EmailDirector);} }
    if (isset($_POST['EmailOtvet'])) { $EmailOtvet=$_POST['EmailOtvet']; if ($EmailOtvet =='') { unset($EmailOtvet);} }
	if (isset($_POST['EmailDeclaration'])) { $EmailDeclaration=$_POST['EmailDeclaration']; if ($EmailDeclaration =='') { unset($EmailDeclaration);} }
   
     //удаляем лишние пробелы
    $Name = stripslashes($Name);    $Name = htmlspecialchars($Name);    $Name = trim($Name);
    $INN = stripslashes($INN);    $INN = htmlspecialchars($INN);    $INN = trim($INN);
    $KPP = stripslashes($KPP);    $KPP = htmlspecialchars($KPP);    $KPP = trim($KPP);
    $Index = stripslashes($Index);    $Index = htmlspecialchars($Index);    $Index = trim($Index);
    $Region = stripslashes($Region);    $Region = htmlspecialchars($Region);    $Region = trim($Region);
    $City = stripslashes($City);    $City = htmlspecialchars($City);    $City = trim($City);
    $Street = stripslashes($Street);    $Street = htmlspecialchars($Street);    $Street = trim($Street);
    $House = stripslashes($House);    $House = htmlspecialchars($House);    $House = trim($House);    
    $Adress = ''.$Index.' '.$Region.' '.$City.' '.$Street.' '.$House; 
    $EmailDirector = stripslashes($EmailDirector);    $EmailDirector = htmlspecialchars($EmailDirector);    $EmailDirector = trim($EmailDirector);  
    $EmailOtvet = stripslashes($EmailOtvet);    $EmailOtvet = htmlspecialchars($EmailOtvet);    $EmailOtvet = trim($EmailOtvet);  
	$EmailDeclaration = stripslashes($EmailDeclaration);    $EmailDeclaration = htmlspecialchars($EmailDeclaration);    $EmailDeclaration = trim($EmailDeclaration); 

 // подключаемся к базе
    include ("../../sql/bd.php"); 
     $result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db);     
     $myrow = mysql_fetch_array($result);
     $Id1C = $myrow['id1C'];
    $result = mysql_query("SELECT id FROM kontragents WHERE (inn='$INN')",$db);
    $myrow = mysql_fetch_array($result);
   
    $sql = "INSERT INTO kontragents (
	name, 
	inn, 
	kpp, 
	MailIndex, 
	Region, 
	city, 
	Street, 
	House, 
	id1C, 
	DayDZ, 
	EmailDirector,
	EmailOtvet,
	EmailDeclaration
	) VALUES(
	'$Name', 
	'$INN', 
	'$KPP', 
	'$Index', 
	'$Region', 
	'$City', 
	'$Street', 
	'$House', 
	'$Id1C', 
	'$DayDZ', 
	'$EmailDirector', 
	'$EmailOtvet',
	'$EmailDeclaration'
	)";

    $result = mysql_query($sql) or die("Error ".mysql_error());
    // Проверяем, есть ли ошибки    
    exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/kontagent'></head></html>");
   
    ?>