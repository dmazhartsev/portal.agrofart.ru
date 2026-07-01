<?php    
header ("Content-Type: text/html; charset=utf-8");
session_start();  
include ("../../sql/bd.php");
if (isset($_POST['proekt'])) { $proekt=$_POST['proekt']; 
	if ($proekt =='') { unset($proekt);} } 
    if (empty($proekt)) { exit ("Нет пользователя!");} 

function removeslashes($string)
{
    $string=implode("",explode("\\",$string));
    $string=implode("",explode("'",$string));
    return stripslashes(trim($string));
}

$xmlURL = "../../xml/Zayavki.xml";

if (!file_exists($xmlURL))
   {     
     exit ("Нет данных для загрузки!");     
   }



$sxml = simplexml_load_file($xmlURL);
  $query = mysql_query("DELETE FROM Zayavki") or die(mysql_error());
  $query = mysql_query("ALTER TABLE Zayavki AUTO_INCREMENT=1") or die(mysql_error());


foreach($sxml->Doc as $doc) {

  $id1c = removeslashes($doc->attributes()['ProektKod']);
  $Name = removeslashes($doc->attributes()['Name']);
  $Kontragent = removeslashes($doc->attributes()['Kontragent']);
  $Sum = removeslashes($doc->attributes()['Sum']);
  $Koment = removeslashes($doc->attributes()['Koment']);
  $Status = removeslashes($doc->attributes()['Status']);
  $DocDate = removeslashes($doc->attributes()['DocDate']);
   $DeliveryDate = removeslashes($doc->attributes()['DeliveryDate']);
  $Voditel = removeslashes($doc->attributes()['Voditel']);
  $Telefon = removeslashes($doc->attributes()['Telefon']);
  $SuperProekt = stripslashes($doc->attributes()['SuperProektKod']);
  $SuperPuperProekt	 = stripslashes($doc->attributes()['SuperPuperProektKod']);
  $ProektName = stripslashes($doc->attributes()['Proekt']);
  $StatusDostavki = removeslashes($doc->attributes()['StatusDostavki']);

    $sql = ("INSERT INTO Zayavki (Name, Proekt, Kontragent,  Sum,  Koment, Status, DocDate, Voditel, Telefon, SuperProekt, SuperPuperProekt, ProektName, StatusDostavki, DeliveryDate) VALUES('$Name','$id1c','$Kontragent','$Sum', '$Koment', '$Status', '$DocDate', '$Voditel', '$Telefon','$SuperProekt','$SuperPuperProekt','$ProektName','$StatusDostavki','$DeliveryDate')");
    $result = mysql_query($sql) or die("Error ".mysql_error()."<br>".$sql);

}

exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/request'></head></html>");
