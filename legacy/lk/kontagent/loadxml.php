<?php  
header ("Content-Type: text/html; charset=utf-8");
session_start();  
include ("../../sql/bd.php");

if (isset($_POST['proekt'])) { $proekt=$_POST['proekt']; 
	if ($proekt =='') { unset($proekt);} } 
    if (empty($proekt)) { exit ("Нет пользователя!");} 
    
    $xmlURL = "../../xml/KA.xml";
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


$strSQL = "SELECT * FROM kontragents WHERE xml='".$atime."' ORDER BY id1C LIMIT 1";
               $rs = mysql_query($strSQL) or die('Error, query failed');
                while($row = mysql_fetch_array($rs)) {
                exit ("Файл от ".date ($dateFormat, $atime)." уже загружен");   
               } 


$query = mysql_query("DELETE FROM kontragents") or die(mysql_error());
  $query = mysql_query("ALTER TABLE kontragents AUTO_INCREMENT=1") or die(mysql_error());

//$sxml = new SimpleXMLElement(file_get_contents($xmlURL));
//$fileContents = file_get_contents($xmlURL); # reads the file and returns the string
//$sxml = simplexml_load_string($fileContents); # creates a Simple XML object from a string
$sxml = simplexml_load_file($xmlURL);
foreach($sxml->El as $el) {
    $Sortirovka = stripslashes($el->attributes()['Sortirovka']);
    $id1C = stripslashes($el->attributes()['KodTA']);
    $KodKA = stripslashes($el->attributes()['KodKA']);
    $INN = stripslashes($el->attributes()['INN']);
    $Name = stripslashes($el->attributes()['NameKA']);
    $DayDZ = stripslashes($el->attributes()['DayDZ']);
    //$DayDZ = "";
    $EmailDirector = ltrim(rtrim(stripslashes($el->attributes()['EmailDirector'])));
    $EmailOtvet = ltrim(rtrim(stripslashes($el->attributes()['EmailOtvet'])));
    $PhoneDirector = ltrim(rtrim(stripslashes($el->attributes()['PhoneDirector'])));
    $PhoneOtvet = ltrim(rtrim(stripslashes($el->attributes()['PhoneOtvet'])));

    $sql = ("INSERT INTO kontragents (id1C, Sortirovka, KodKA, INN, Name, DayDZ, EmailDirector, EmailOtvet, PhoneDirector, PhoneOtvet, xml) VALUES('$id1C','$Sortirovka','$KodKA', '$INN', '$Name', '$DayDZ', '$EmailDirector', '$EmailOtvet', '$PhoneDirector', '$PhoneOtvet', '$atime')");
    $result = mysql_query($sql) or die("Error ".mysql_error());
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
  $current .= "[".$date_today."] [".$currenttime."] Проект:". $_SESSION['login']." Загружены контрагенты\n";
  // Пишем содержимое обратно в файл
  file_put_contents($file, $current);
exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/kontagent'></head></html>");