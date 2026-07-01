<?php  
header ("Content-Type: text/html; charset=utf-8");
session_start();  
include ("../../sql/bd.php");


    
    $xmlURL = "../../xml/Marshrut.xml";
//---
 //$file = '../../xml/KA.xml';
//fclose($file);
//$output = shell_exec('sudo chown -R www-data /var/www/portal.agrofart.ru/xml/KA.xml');
//chown($file, 33);
//rename($file, $file."old");
//unlink(realpath($file));
//exit("realpath: ".realpath($file)." OWner: ".fileowner($file)."output: ".$output);
//exit("realpath: ".realpath($file));
//exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/kontagent'></head></html>");
//---
if (!file_exists($xmlURL))
   {     
     exit ("Нет данных для загрузки!");     
   } else {
       //unlink($xmlURL);
       $dateFormat = "D d M Y g:i A";
$atime = filemtime($xmlURL);


$strSQL = "SELECT * FROM Marshrut WHERE xml='".$atime."' ORDER BY Proekt LIMIT 1";
               $rs = mysql_query($strSQL) or die('Error, query failed');
                while($row = mysql_fetch_array($rs)) {
                exit ("Файл от ".date ($dateFormat, $atime)." уже загружен");   
               } 


$query = mysql_query("DELETE FROM Marshrut") or die(mysql_error());
  $query = mysql_query("ALTER TABLE Marshrut AUTO_INCREMENT=1") or die(mysql_error());

//$sxml = new SimpleXMLElement(file_get_contents($xmlURL));
//$fileContents = file_get_contents($xmlURL); # reads the file and returns the string
//$sxml = simplexml_load_string($fileContents); # creates a Simple XML object from a string
$sxml = simplexml_load_file($xmlURL);
foreach($sxml->El as $el) {
    $Proekt = stripslashes($el->attributes()['ProektKod']);
    $ProektName = stripslashes($el->attributes()['Proekt']);
    $SuperProekt = stripslashes($el->attributes()['SuperProektKod']);
    $SuperPuperProekt = stripslashes($el->attributes()['SuperPuperProektKod']);
    $Kontragent = stripslashes($el->attributes()['Kontragent']);
    $Adress = ltrim(rtrim(stripslashes($el->attributes()['Adress'])));
    $VisitDay = ltrim(rtrim(stripslashes($el->attributes()['VisitDay'])));
	$NomVisitDay = ltrim(rtrim(stripslashes($el->attributes()['NomVisitDay'])));
    $VisitPeriod = ltrim(rtrim(stripslashes($el->attributes()['VisitPeriod'])));
    $SummKredit = stripslashes($el->attributes()['SummKredit']);
    $SrokKredit = stripslashes($el->attributes()['SrokKredit']);
    $TipCen = stripslashes($el->attributes()['TipCen']);
	$Dolg = stripslashes($el->attributes()['Dolg']);

    $sql = ("INSERT INTO Marshrut (Proekt, Kontragent, Adress, VisitDay, VisitPeriod, SuperProekt, SuperPuperProekt, ProektName, SummKredit, SrokKredit, TipCen, NomVisitDay, Dolg, xml) VALUES('$Proekt','$Kontragent','$Adress', '$VisitDay', '$VisitPeriod', '$SuperProekt', '$SuperPuperProekt',  '$ProektName', '$SummKredit', '$SrokKredit', '$TipCen', '$NomVisitDay', '$Dolg', '$atime')");
    $result = mysql_query($sql) or die("Error ".$sql);
}
$sxml = '';

}
	$currenttime = date("H:i:s");
    $date_today = date("m.d.y");
    //setcookie("LoadKADate", $date_today);
  $file = '../../xml/logsql.txt';
  // Открываем файл для получения существующего содержимого
  $current = file_get_contents($file);
  // Добавляем нового человека в файл
  $current .= "[".$date_today."] [".$currenttime."] Проект:". $_SESSION['login']." Загружены маршруты\n";
  // Пишем содержимое обратно в файл
  file_put_contents($file, $current);
exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/marshrut'></head></html>");