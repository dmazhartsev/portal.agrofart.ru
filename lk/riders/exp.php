<?php
header ("Content-Type: text/html; charset=utf-8");
session_start();  
    if (isset($_POST['id'])) { $id=$_POST['id']; 
    if ($id =='') { unset($id);} } 
    if (empty($id))
//если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт     
          {     
          exit ("Не выбран!");     
          } 

    $id = trim($id);
    $Exp = $_POST['expsel'];
    $Coords = $_POST['coords'];
    $currenttime = date("H:i:s");
 // подключаемся к базе
    include ("../../sql/bd.php"); 
    
    $result = mysql_query ("UPDATE Riders SET exp='$Exp' WHERE (id = '$id')");
    $result = mysql_query ("UPDATE Riders SET coords='$Coords' WHERE (id = '$id')");

    if (isset($_POST['proekt'])) { $proekt=$_POST['proekt']; 
    if ($proekt =='') { unset($proekt);} } 
    if (empty($proekt)) { exit ("Нет пользователя!");} 
    $currenttime = date("H:i:s");
    $today = date("Ymd"); 
    $xmlURL = "../../xml/".$today."ride.xml"; 
    $dom = new domDocument("1.0", "utf-8"); // Создаём XML-документ версии 1.0 с кодировкой utf-8
$root = $dom->createElement("docs"); // Создаём корневой элемент
$dom->appendChild($root);
$strSQL = "SELECT * FROM Riders WHERE exp<>0";
$rs = mysql_query($strSQL);
while($row = mysql_fetch_array($rs)) {
 
  $doc = $dom->createElement("doc"); // Создаём узел "doc"
  $doc->setAttribute("Rider", $row['rider']); // Устанавливаем атрибутs
  $doc->setAttribute("Date", $row['date']); // Устанавливаем атрибутs
  $doc->setAttribute("TimeNeed", $row['time']); // Устанавливаем атрибутs
  $doc->setAttribute("TimeReal", $currenttime); // Устанавливаем атрибутs
  $doc->setAttribute("Adress", $row['adress']); // Устанавливаем атрибутs
  $doc->setAttribute("Coords", $row['coords']); // Устанавливаем атрибутs
  $doc->setAttribute("Exp", $row['exp']); // Устанавливаем атрибутs
  $root->appendChild($doc); // Добавляем в корневой узел

}
$dom->save($xmlURL); // Сохраняем полученный XML-документ в файл



   exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/riders'></head></html>");
?>