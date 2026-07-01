<?php    
header ("Content-Type: text/html; charset=utf-8");
include ("../../sql/bd.php");
if (isset($_POST['proekt'])) { $proekt=$_POST['proekt']; 
  if ($proekt =='') { unset($proekt);} } 
    if (empty($proekt)) { exit ("Нет пользователя!");} 

$xmlURL = "../../xml/PGR.xml";

if (!file_exists($xmlURL))
   {     
     exit ("Нет данных для загрузки!");     
   }

$sxml = simplexml_load_file($xmlURL);
foreach($sxml->Doc as $doc) {
    $Name = stripslashes($doc->attributes()['Name']);
    $Date = stripslashes($doc->attributes()['Date']);
    $Time = stripslashes($doc->attributes()['Time']);
    $Rider = stripslashes($doc->attributes()['Rider']);
    $Adress = stripslashes($doc->attributes()['Adress']);

      $query = mysql_query("SELECT COUNT(*) FROM Riders WHERE (Name='$Name')") or die(mysql_error());
      $doc = mysql_fetch_row($query);
      $total = $doc[0];

  if ("$total" == 0) {
    $sql = ("INSERT INTO Riders (Name, date, time, rider, adress) VALUES('$Name','$Date', '$Time', '$Rider', '$Adress')");
    $result = mysql_query($sql) or die("Error ".mysql_error());
  } else {

  }
}

$strSQL = "SELECT * FROM Riders WHERE rider='$proekt'";
 $rs = mysql_query($strSQL) or die("Error ".mysql_error());
 while($row = mysql_fetch_array($rs)) {
  $finder = 0;
  foreach($sxml->Doc as $doc) {
    $Name = stripslashes($doc->attributes()['Name']);
    if ($row['Name']==$Name){$finder=$finder+1;}
  }
  if ($finder==0){
    $NameD = $row['Name'];
    echo $NameD." не найдена в загружаемом файле и подлежит удалению из базы<br>";
    $query = "DELETE FROM Riders WHERE (Name = '$NameD')";
    mysql_query($query) or die(mysql_error());
  }
 }




exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/riders'></head></html>");
