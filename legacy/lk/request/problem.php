<?php  
header ("Content-Type: text/html; charset=utf-8");
include ("../../sql/bd.php");
include ("../../sql/smtp-func.php");
if (isset($_POST['KodKA'])) { $KodKA=$_POST['KodKA']; if ($KodKA =='') { unset($KodKA);} }
if (isset($_POST['id'])) { $id = $_POST['id'];  if ($id == '') { unset($id);} } 
if (isset($_POST['exp'])) { $exp = $_POST['exp'];  if ($exp == '') { unset($exp);} } 
if (isset($_POST['login'])) { $login = $_POST['login'];  if ($login == '') { unset($login);} } 
if (isset($_POST['NomDoc'])) { $NomDoc = $_POST['NomDoc'];  if ($NomDoc == '') { unset($NomDoc);} }
$mail_to = 'dmazharcev@agrofart.ru';
$type = 'plain';
$charset = 'utf-8';
   $message = "Необходимо связаться с торговым представителем ".$proekt ." по вопросу сделанных реализаций";
   $subject = 'Запрос с Web-портала';
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
   else echo "<script>alert(\"Письмо было успешно отправлено. В ближайшее Вы получите ответ на него.\");</script>"; 
   exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/work'></head></html>");
