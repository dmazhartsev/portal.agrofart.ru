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
$login = stripslashes($login);     
$login = htmlspecialchars($login);     
$password = stripslashes($password);     
$password = htmlspecialchars($password); 
include ("../../sql/bd.php");
include ("../../sql/smtp-func.php");

$result = mysql_query("SELECT * FROM users WHERE id=".$_SESSION['id'],$db); 
$myrow = mysql_fetch_array($result);
$id1C = $myrow['id1C'];
$mail_to = $myrow['email'];
$today = date("Ymd"); 
if (empty($mail_to)){
echo "<script>alert(\"Доверенности выгружены, но реестр на почту не удалось отправить, так как у Вас не заполнен email. Для заполнения обратитесь к Габитовой Д.Р.\");</script>";
exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/work'></head></html>");
}
   
//exit("Ваш адрес: ".$mail_to." Проект:".$proekt );


//$mail_to = 'dmazharcev@agrofart.ru'; //вам потребуется указать здесь Ваш настоящий почтовый ящик, куда должно будет прийти письмо.
$type = 'html'; //Можно поменять на html; plain означяет: будет присылаться чистый текст.
$charset = 'utf-8';
   $message = " <br><table border='1'><tr><th>Id</th><th>Контрагент</th><th>Реализация</th><th>Задолж.</th></tr>";
   $strSQL = "SELECT * FROM dolg WHERE Proekt='$id1C' and Dover>0 ORDER BY Sortirovka, Kontragent ASC";
   $rs = mysql_query("$strSQL");
   while($row = mysql_fetch_array($rs)) {
   $message = $message."<tr>
 	<td>".$row['id']."</td>
 	<td>".$row['Kontragent']."</td>
 	<td>".$row['Name']."</td>
 	<td>".$row['Sum']. "</td>
 	</tr>";	
   }
   $message = $message."</table>";
   $subject = 'Реестр заказанных Доверенностей за '.$today;
   $mail_from = 'hosting@agrofart.ru';
   $replyto = 'hosting@agrofart.ru';
   $headers = "To: \"Administrator\" <$mail_to>\r\n".
              "From: \"$replyto\" <$mail_from>\r\n".
              "Reply-To: $replyto\r\n".
              "Content-Type: text/$type; charset=\"$charset\"\r\n";
   $sended = smtpmail($mail_to, $subject, $message, $headers);
   echo '<html>
        <head>
        <meta http-equiv="content-type" content="text/html; charset='.$charset.'">
        </head>
              <body>';
   if (!$sended) echo "<script>alert(\"Письмо не удалось отправить. Пожалуйста свяжитесь с администратором сайта\");</script>"; 
   else echo "<script>alert(\"Отчет на почту отправлен.\");</script>"; 

   exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/work'></head></html>");
   echo '</body>';
   exit;

?>

