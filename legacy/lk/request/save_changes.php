<?php
include ("../../sql/bd.php");
include ("../../sql/smtp-func.php");

if (isset($_POST['KodKA'])) { $KodKA=$_POST['KodKA']; if ($KodKA =='') { unset($KodKA);} }
if (isset($_POST['id'])) { $id = $_POST['id'];  if ($id == '') { unset($id);} } 
if (isset($_POST['exp'])) { $exp = $_POST['exp'];  if ($exp == '') { unset($exp);} } 
if (isset($_POST['login'])) { $login = $_POST['login'];  if ($login == '') { unset($login);} } 
if (isset($_POST['NomDoc'])) { $NomDoc = $_POST['NomDoc'];  if ($NomDoc == '') { unset($NomDoc);} }

	if($_POST['CheckCen']=='No'){
		$Komment = $_POST['Komment'];		
		$type = 'plain';
		$charset = 'utf-8';
	    $message = $Komment;
	    $subject = 'Несоответствие цен в '.$NomDoc.' от '.$_SESSION['login'];
	    $mail_from = 'hosting@agrofart.ru';
	    $replyto = 'hosting@agrofart.ru';
	    
		$mail_to = 'sgodovnikova@agrofart.ru';
		$headers = "To: \"Administrator\" <$mail_to>\r\n".
				  "From: \"$replyto\" <$mail_from>\r\n".
				  "Reply-To: $replyto\r\n".
				  "Content-Type: text/$type; charset=\"$charset\"\r\n";
	    $sended = smtpmail($mail_to, $subject, $message, $headers);
		
		$mail_to = 'sabrosimov@agrofart.ru';
		$headers = "To: \"Administrator\" <$mail_to>\r\n".
				  "From: \"$replyto\" <$mail_from>\r\n".
				  "Reply-To: $replyto\r\n".
				  "Content-Type: text/$type; charset=\"$charset\"\r\n";
		$sended = smtpmail($mail_to, $subject, $message, $headers);
		
		$mail_to = 'acyganova@agrofart.ru';
		$headers = "To: \"Administrator\" <$mail_to>\r\n".
				  "From: \"$replyto\" <$mail_from>\r\n".
				  "Reply-To: $replyto\r\n".
				  "Content-Type: text/$type; charset=\"$charset\"\r\n";
		$sended = smtpmail($mail_to, $subject, $message, $headers);
		
		// $mail_to = 'dmazharcev@agrofart.ru';
		// $sended = smtpmail($mail_to, $subject, $message, $headers);
		$result = mysql_query ("UPDATE Zayavki SET StatusProverkaCen='Несоответствие' WHERE (NomDoc = '".$NomDoc."')");		
	};
	
	if($_POST['CheckCen']=='Yes'){
		$result = mysql_query ("UPDATE Zayavki SET StatusProverkaCen='Подтверждено' WHERE (NomDoc = '".$NomDoc."')");
	};	

unset($_POST['CheckCen']);
?>
