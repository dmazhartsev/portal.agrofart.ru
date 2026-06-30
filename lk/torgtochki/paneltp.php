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
$result = mysql_query("SELECT * FROM kontragents WHERE id='$idKa'",$db);
$myrow = mysql_fetch_array($result);
$Kontragent = $myrow['name'];
$result = mysql_query("SELECT * FROM users WHERE id=".$_SESSION['id'],$db); 
$myrow = mysql_fetch_array($result);
$proekt = $myrow['id1C'];

?>
<div>
   

 <div style='display: inline-block;'>
  <form action='reg.php' method='post'>
  <input name='idKa' type='text' hidden='true' value=<?php echo $idKa; ?>>
  <input name='todo' type='text' hidden='true' value='add'>
	<input type='submit' name='submit' value='Добавить'>
	</form>
   </div>

 <div style='display: inline-block;'>
  <form action='upload.php' method='post'>
  <input name='proekt' type='text' hidden='true' value=<?php echo $proekt; ?>>
  <input type='submit' name='submit' value='Выгрузить'>
  </form>
   </div>
 
</div>
<br>



<?php 

include 'usertable.php'; ?>
