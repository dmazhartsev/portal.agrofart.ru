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
if (isset($_POST['proekt'])) { $proekt=$_POST['proekt']; 
  if ($proekt =='') { unset($proekt);} } 
    if (empty($proekt)) { exit ("Нет пользователя!");} 
$login = stripslashes($login);     
$login = htmlspecialchars($login);     
$password = stripslashes($password);     
$password = htmlspecialchars($password); 
include ("../../sql/bd.php");
include ("../../sql/smtp-func.php");

$result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db); 
$myrow = mysql_fetch_array($result);
$id1C = $myrow['id1C'];//

$mail_to = $myrow['email'];
$mail_to = stripslashes($mail_to);
$mail_to = htmlspecialchars($mail_to);
$mail_to = str_replace(';',',',$mail_to);
$mail_to = strval($mail_to);

$today = date("Ymd"); 

$strSQL = mysql_query("SELECT Sum(Exp) AS value_sum,  Count(*) AS value_count from dolg WHERE (exp<>0) and ((Proekt='$proekt') or (SuperProekt='$proekt') or (SuperPuperProekt='$proekt'))");
  $row = mysql_fetch_assoc($strSQL); 


$mail_to1 = "saminkass@agrofart.ru";
$mail_to2 = 'dmazharcev@agrofart.ru'; 
$type = 'html'; 
$charset = 'utf-8';
   $message ="Всего сформировано ".$row['value_count']." ПКО на сумму: ".$row['value_sum'];
   $message = $message." <br><table border='1'><tr><th>Проект</th><th>Контрагент</th><th>Реализация</th><th>Задолж.</th><th>ПКО</th></tr>";
   $strSQL = "SELECT * FROM dolg WHERE proekt='$proekt' and Exp>0 ORDER BY Kontragent ASC";
   $rs = mysql_query("$strSQL");
   while($row = mysql_fetch_array($rs)) {
   $message = $message."<tr>
	<td>".$row['ProektName']."</td>
 	<td>".$row['Kontragent']."</td>
 	<td>".$row['Name']."</td>
 	<td>".$row['Sum']. "</td>
 	<td>".$row['Exp']. "</td>
 	</tr>";	
   }
   $message = $message."</table>";
   $subject = $_SESSION['login'].' Реестр ПКО за '.$today;
   $mail_from = 'hosting@agrofart.ru';
   $replyto = 'hosting@agrofart.ru';
   $headers = "To: \"Administrator\" <$mail_to>\r\n".
              "From: \"$replyto\" <$mail_from>\r\n".
              "Reply-To: $replyto\r\n".
              "Content-Type: text/$type; charset=\"$charset\"\r\n";
	//$sended2 = smtpmail($mail_to2, $subject, $message, $headers);
	$sended1 = smtpmail($mail_to1, $subject, $message, $headers);
   $sended = smtpmail($mail_to, $subject, $message, $headers);
   echo '<html>
        <head>
        <meta http-equiv="content-type" content="text/html; charset='.$charset.'">
        </head>
              <body>';
   if (!$sended) echo "<script>alert(\"Письмо не удалось отправить на ".$mail_to." \");</script>"; 
   else echo "<script>alert(\"Отчет на почту ".$mail_to." отправлен.\");</script>"; 
   
   exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/work'></head></html>");
   echo '</body>';
   exit;

?>

