<?php
header ("Content-Type: text/html; charset=utf-8");
session_start();     
if(isset($_GET['exit'])) { 
session_destroy();     
#redirect 
header('Location: ../../'); 
exit; 
} 

	include ("../../sql/bd.php");

    if (isset($_POST['Name'])) { $Name = $_POST['Name'];  if ($Name == '') { unset($Name);} } 
    if (isset($_POST['id'])) { $id=$_POST['id']; if ($id =='') { unset($id);} }
    if (isset($_POST['PenniText'])) { $PenniText=$_POST['PenniText']; if ($PenniText =='') { unset($PenniText);} }
    if (isset($_POST['PenniTextSuper'])) { $PenniTextSuper=$_POST['PenniTextSuper']; if ($PenniTextSuper =='') { unset($PenniTextSuper);} }
    if (isset($_POST['PenniDate'])) { $PenniDate=$_POST['PenniDate']; if ($PenniDate =='') { unset($PenniDate);} }
    if (isset($_POST['Kontragent'])) { $Kontragent=$_POST['Kontragent']; if ($Kontragent =='') { unset($Kontragent);} }

    $Name = stripslashes($Name);    $Name = htmlspecialchars($Name);    $Name = trim($Name);
	$PenniText = stripslashes($PenniText);    $PenniText = htmlspecialchars($PenniText);    $PenniText = trim($PenniText);  
    $PenniTextSuper = stripslashes($PenniTextSuper);    $PenniTextSuper = htmlspecialchars($PenniTextSuper);    $PenniTextSuper = trim($PenniTextSuper);
	
    $date_today = date("y.m.d");
    $sql = "UPDATE dolg SET PenniText='$PenniText', PenniTextSuper='$PenniTextSuper' , PenniDate='$PenniDate', PenniLogDate='$date_today' WHERE (id = '$id')";
    $result = mysql_query($sql) or die("Error ".mysql_error());
	
	$result = mysql_query("SELECT * FROM dolg WHERE (id = '$id')"); 
	$myrow = mysql_fetch_array($result);
	$NomDoc = $myrow['NomDoc']; $DocDate = $myrow['DocDate']; $VidDoc = $myrow['VidDoc'];
     
	$proekt = $_SESSION['id1C'];
	$text = $PenniText.$PenniTextSuper;
	$date_time_today = date("Y-m-d H:i:s");
    $sql = "INSERT INTO KommentsPenni (NomDoc,DocDate,VidDoc,Proekt,Text,LogDate) VALUES ('$NomDoc','$DocDate','$VidDoc','$proekt', '$text', '$date_time_today')";
	$result = mysql_query($sql) or die("Error ".mysql_error());
  
    exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/penni'></head></html>");


   