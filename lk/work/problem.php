<?php  
header ("Content-Type: text/html; charset=utf-8");
include ("../../sql/bd.php");
include ("../../sql/smtp-func.php");
if (isset($_POST['proekt'])) { $proekt=$_POST['proekt']; 
	if ($proekt =='') { unset($proekt);} } 
    if (empty($proekt)) { exit ("Нет пользователя!");} 

//Замените настройки на нужные.
$mail_to = 'kredit@agrofart.ru'; //вам потребуется указать здесь Ваш настоящий почтовый ящик, куда должно будет прийти письмо.
//$mail_to = 'dmazharcev@agrofart.ru'; //вам потребуется указать здесь Ваш настоящий почтовый ящик, куда должно будет прийти письмо.
$type = 'plain'; //Можно поменять на html; plain означяет: будет присылаться чистый текст.
$charset = 'utf-8';
   //$message = 'Необходимо связаться с торговым представителем '.$proekt .' по вопросу задолженностей контрагентов';
   $message = "Необходимо связаться с торговым представителем ".$proekt ." по вопросу задолженностей контрагентов";
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
   echo '</body>';
   exit;





//if (!mail("dmazharcev@agrofart.ru", "Запрос с Web-портала", "Необходимо связаться с торговым представителем ".$proekt ." по вопросу задолженностей контрагентов")){
	//exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='3; URL=/lk/work'>Не отправлено!</head></html>"); } 
//echo $proekt;
//exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/work'></head></html>");