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
<div>
   
  <!--  <div style='display: inline-block;'>
  <form action='loadxml.php' method='post'>
  <input name='proekt' type='text' hidden='true' value=<?php echo $proekt; ?>>
	<input type='submit' name='submit' value='Обновить список'>
	</form>
   </div> -->

    

 
</div>
<br>



<?php include 'usertable.php'; ?>
