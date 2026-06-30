<?php     
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
$result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db); 
$myrow = mysql_fetch_array($result);
$proekt = $myrow['id1C'];
// Подключение     
?>

<?php 

if (empty($_POST['exp'])) {
  $exp = 'ПерезаключенияДоговоров';
} else {
  $exp = $_POST['exp'];
}

if (empty($_POST['login'])) {
  //$proekt = 999999;
} else {
  $proekt = $_POST['login'];
}

include 'tabletp.php'; 
?>
