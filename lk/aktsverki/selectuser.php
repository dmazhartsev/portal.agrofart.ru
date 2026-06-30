
<?php
include ("../../sql/bd.php"); 
				$result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db);     
				$myrow = mysql_fetch_array($result);
				$userproekt = $myrow['id1C'];
				$userSuper = $myrow['Super'];
if (empty($_POST['login'])) {
  $proekt = $userproekt;
} else {
  $proekt = $_POST['login'];
}
?>

<form action="" method="post">

               
               <select type="login" name="login">
               <?php 
			   
			   if ($proekt==$_SESSION['id1C']) {
                    echo "<option value=".$_SESSION['id1C']." selected='selected'>Все проекты</option>";
                  }else{
                    echo "<option value=".$_SESSION['id1C']." >Все проекты</option>";
                  }  

			   if ($userSuper==1){
				   $strSQL = "SELECT login,id1C FROM users WHERE (isGroup=0) and ((id1C1='$userproekt')or(id1C2='$userproekt')) ORDER BY id1C";
			   }else{
				   $strSQL = "SELECT login,id1C FROM users WHERE isGroup=0 ORDER BY id1C";
			   }
			
               
               $rs = mysql_query($strSQL);
                while($row = mysql_fetch_array($rs)) {
                 if ($proekt==$row['id1C']) {
                    echo "<option value='".$row['id1C']."' selected='selected'>".$row['id1C'].":".$row['login']."</option>";
                  }else{
                    echo "<option value='".$row['id1C']."' >".$row['id1C'].":".$row['login']."</option>";
                  }                 
               } 
               ?>
               </select> 
            
<?php
if (empty($_POST['exp'])) {}else{ $exp = $_POST['exp']; 
echo "<input name='exp' type='text' hidden='true' value='$exp'>";}
?>
<input type="submit" value="Сформировать отчет">
</form>



