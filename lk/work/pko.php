<?php
header ("Content-Type: text/html; charset=utf-8");
include ("../../sql/bd.php");
if (isset($_POST['proekt'])) { $proekt=$_POST['proekt']; 
  if ($proekt =='') { unset($proekt);} } 
    if (empty($proekt)) { exit ("Нет пользователя!");} 
$today = date("Ymd"); 
$xmlURL = "../../xml/".$today."pko".$proekt.".xml";
$dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
$root = $dom->createElement("docs"); // Создаём корневой элемент
$dom->appendChild($root);
$strSQL = "SELECT * FROM dolg WHERE (Proekt='$proekt') or (SuperProekt='$proekt') or (SuperPuperProekt='$proekt')";
$rs = mysql_query($strSQL);
while($row = mysql_fetch_array($rs)) {
  if ($row['Exp']>0){ 
  $doc = $dom->createElement("doc"); // Создаём узел "doc"
  $doc->setAttribute("Name", $row['Name']); // Устанавливаем атрибутs
  /*if (strlen($row['Kontragent'])>35){
  	$doc->setAttribute("Kontragent", substr($row['Kontragent'], 0, 35)); // Устанавливаем атрибутs
  }else{*/
  	$doc->setAttribute("Kontragent", ""); // Устанавливаем атрибутs
  //}
  $doc->setAttribute("Sum", $row['Exp']); // Устанавливаем атрибутs
  $root->appendChild($doc); // Добавляем в корневой узел
}
}
$dom->save($xmlURL); // Сохраняем полученный XML-документ в файл
//phpinfo(); 
include("MailPKO.php");
  echo "<script>alert(\"Успешно выгружено.\");</script>"; 

$currenttime = date("H:i:s");
$date_today = date("m.d.y");
$file = '../../xml/logsql.txt';
// Открываем файл для получения существующего содержимого
$current = file_get_contents($file);
// Добавляем нового человека в файл
$current .= "[".$date_today."] [".$currenttime."] Выгружен XML файл ПКО для проекта ".$proekt." \n";
// Пишем содержимое обратно в файл
file_put_contents($file, $current);
exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/work'></head></html>");
?>

