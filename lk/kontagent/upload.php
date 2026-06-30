<?php
header ("Content-Type: text/html; charset=utf-8");
include ("../../sql/bd.php");
if (isset($_POST['proekt'])) { $proekt=$_POST['proekt']; 
  if ($proekt =='') { unset($proekt);} } 
    if (empty($proekt)) { exit ("Нет пользователя!");} 
$today = date("Ymd"); 
$xmlURL = "../../xml/torgt".$proekt.".xml";
$dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
$root = $dom->createElement("kontragents"); // Создаём корневой элемент
$dom->appendChild($root);
$strSQL = "SELECT * FROM kontragents WHERE id1C='$proekt'";
$rs = mysql_query($strSQL);
while($row = mysql_fetch_array($rs)) {
  $ka = $dom->createElement("Kontragent"); // Создаём узел "ka"
  $ka->setAttribute("Name", $row['name']); // Устанавливаем атрибутs
  $ka->setAttribute("inn", $row['inn']); // Устанавливаем атрибутs
  $ka->setAttribute("kpp", $row['kpp']); // Устанавливаем атрибутs
  $ka->setAttribute("MailIndex", $row['MailIndex']); // Устанавливаем атрибутs
  $ka->setAttribute("Region", $row['Region']); // Устанавливаем атрибутs
  $ka->setAttribute("city", $row['city']); // Устанавливаем атрибутs
  $ka->setAttribute("Street", $row['Street']); // Устанавливаем атрибутs
  $ka->setAttribute("House", $row['House']); // Устанавливаем атрибутs
  $ka->setAttribute("DayDZ", $row['DayDZ']); // Устанавливаем атрибутs
  $ka->setAttribute("EmailDirector", $row['EmailDirector']); // Устанавливаем атрибутs
  $ka->setAttribute("EmailOtvet", $row['EmailOtvet']); // Устанавливаем атрибутs 
  $ka->setAttribute("PhoneDirector", $row['PhoneDirector']); // Устанавливаем атрибутs
  $ka->setAttribute("PhoneOtvet", $row['PhoneOtvet']); // Устанавливаем атрибутs 
  $ka->setAttribute("KodKA", $row['KodKA']); // Устанавливаем атрибутs
  $root->appendChild($ka); // Добавляем в корневой узел
  $strSQL = "SELECT * FROM torgtochki WHERE idKa=".$row['id'];
  $rstt = mysql_query($strSQL);
  while($rowtt = mysql_fetch_array($rstt)) {
  	$tt = $dom->createElement("TorgTochka"); // Создаём узел "tt"
  	$tt->setAttribute("Name", $rowtt['name']); // Устанавливаем атрибутs
  	$tt->setAttribute("kpp", $rowtt['kpp']); // Устанавливаем атрибутs
  	$tt->setAttribute("MailIndex", $rowtt['MailIndex']); // Устанавливаем атрибутs
  	$tt->setAttribute("Region", $rowtt['Region']); // Устанавливаем атрибутs
  	$tt->setAttribute("city", $rowtt['city']); // Устанавливаем атрибутs
  	$tt->setAttribute("Street", $rowtt['Street']); // Устанавливаем атрибутs
  	$tt->setAttribute("House", $rowtt['House']); // Устанавливаем атрибутs
  	$ka->appendChild($tt); // Добавляем в ka узел
  }
}
$dom->save($xmlURL); // Сохраняем полученный XML-документ в файл
//phpinfo(); 
//include("MailPKO.php");
  echo "<script>alert(\"Успешно выгружено.\");</script>"; 
exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/kontagent'></head></html>");
?>

