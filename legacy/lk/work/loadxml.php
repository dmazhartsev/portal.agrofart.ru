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

$xmlURL = "../../xml/".$proekt.".xml";

if (!file_exists($xmlURL))
   {     
     exit ("Нет данных для загрузки!");     
   } else {

$sxml = simplexml_load_file($xmlURL);
$mtime = filemtime($xmlURL);
    $dateFormat = "d.m.y"; 
    $date_today = date("d.m.y");
    
foreach($sxml->Doc as $doc) {
    $Name = stripslashes($doc->attributes()['Name']);
    $Sum = stripslashes($doc->attributes()['Sum']);
    $Kontragent = stripslashes($doc->attributes()['Kontragent']);
    $Adress = stripslashes($doc->attributes()['Adress']);
    $Prosrok = stripslashes($doc->attributes()['Prosrok']);
    $ProektName = stripslashes($doc->attributes()['Proekt']);
     $SuperProekt = stripslashes($doc->attributes()['SuperProektKod']);
      $SuperPuperProekt	 = stripslashes($doc->attributes()['SuperPuperProektKod']);
     $PenniText = stripslashes($doc->attributes()['PenniText']);
      $PenniTextSuper	 = stripslashes($doc->attributes()['PenniTextSuper']); 

      $query = mysql_query("SELECT COUNT(*) FROM dolg WHERE (Name='$Name') AND ((Proekt='$proekt') or (SuperProekt='$proekt') or (SuperPuperProekt='$proekt'))") or die(mysql_error());
       $doc = mysql_fetch_row($query);
       $total = $doc[0];

  if ("$total" == 0) {
    $sql = ("INSERT INTO dolg (Name, Sum, Proekt, Exp, Kontragent, Adress,  Prosrok, ProektName, SuperProekt, SuperPuperProekt, PenniText, PenniTextSuper, LoadDate) VALUES('$Name','$Sum', '$proekt', 'Загружено', '$Kontragent', '$Adress', '$Prosrok', '$ProektName', '$SuperProekt', '$SuperPuperProekt', '$PenniText', '$PenniTextSuper', '$date_today')");
    $result = mysql_query($sql) or die("Error ".mysql_error());
  } else {   
    $sql = mysql_query ("UPDATE dolg SET Sum ='$Sum' WHERE Name = '$Name'");
    $sql = mysql_query ("UPDATE dolg SET Exp =0 WHERE (Name = '$Name') and (LoadDate<'$date_today')");
    $sql = mysql_query ("UPDATE dolg SET Adress ='$Adress' WHERE Name = '$Name'");
    $sql = mysql_query ("UPDATE dolg SET Prosrok ='$Prosrok' WHERE Name = '$Name'");
    $sql = mysql_query ("UPDATE dolg SET ProektName ='$ProektName' WHERE (Name='$Name') AND (Proekt='$proekt')");
    $sql = mysql_query ("UPDATE dolg SET SuperProekt ='$SuperProekt' WHERE (Name='$Name') AND (Proekt='$proekt')");
    $sql = mysql_query ("UPDATE dolg SET SuperPuperProekt ='$SuperPuperProekt' WHERE (Name='$Name') AND (Proekt='$proekt')");
    $sql = mysql_query ("UPDATE dolg SET PenniText ='$PenniText' WHERE (Name='$Name') AND (Proekt='$proekt')");
    $sql = mysql_query ("UPDATE dolg SET PenniTextSuper ='$PenniTextSuper' WHERE (Name='$Name') AND (Proekt='$proekt')");
    $sql = mysql_query ("UPDATE dolg SET LoadDate ='$date_today' WHERE (Name = '$Name') and (Proekt='$proekt') ");
    //die('$date_today '.$date_today);
  }
}

$strSQL = "SELECT * FROM dolg WHERE Proekt='$proekt'";
 $rs = mysql_query($strSQL);
 while($row = mysql_fetch_array($rs)) {
  $finder = 0;
  foreach($sxml->Doc as $doc) {
    $Name = stripslashes($doc->attributes()['Name']);
    if ($row['Name']==$Name){$finder=$finder+1;}
  }
  if ($finder==0){
    echo $row['Name']." не найдена в загружаемом файле и подлежит удалению из базы<br>";
    $Name = $row['Name'];
    $query = "DELETE FROM dolg WHERE (Name = '$Name')";
    mysql_query($query) or die(mysql_error());
  }
 }

}

$xmlURL = "../../xml/Zadania.xml";

if (!file_exists($xmlURL))
   {     
     exit ("Нет данных для загрузки!");     
   }



$sxml = simplexml_load_file($xmlURL);
  $query = mysql_query("DELETE FROM Zadania") or die(mysql_error());
  $query = mysql_query("ALTER TABLE Zadania AUTO_INCREMENT=1") or die(mysql_error());


foreach($sxml->Doc as $doc) {

  $id1c = removeslashes($doc->attributes()['ProektKod']);  
  $ProektName = stripslashes($doc->attributes()['Proekt']);
  $Zadanie = removeslashes($doc->attributes()['Zadanie']);
  $Category = removeslashes($doc->attributes()['Category']); 
  $DateA = removeslashes($doc->attributes()['DateA']);
  $DateB = removeslashes($doc->attributes()['DateB']);
  $SuperProekt = stripslashes($doc->attributes()['SuperProektKod']);
  $SuperPuperProekt	 = stripslashes($doc->attributes()['SuperPuperProektKod']);

    $sql = ("INSERT INTO Zadania (Proekt, Zadanie,  Category,  DateA, DateB, ProektName) VALUES('$id1c','$Zadanie', '$Category', '$DateA', '$DateB', '$ProektName')");
    $result = mysql_query($sql) or die("Error ".mysql_error()."<br>".$sql);

}
	
	$currenttime = date("H:i:s");
    $date_today = date("m.d.y");
  $file = '../../xml/logsql.txt';
  // Открываем файл для получения существующего содержимого
  $current = file_get_contents($file);
  // Добавляем нового человека в файл
  $current .= "[".$date_today."] [".$currenttime."] Проект:". $_SESSION['login']." Загружены задолженности, обнулен реестр\n";
  // Пишем содержимое обратно в файл
  file_put_contents($file, $current);
exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/work'></head></html>");