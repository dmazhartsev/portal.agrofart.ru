 <?php 
 $isGroup = $_POST['options'];
 include 'prelogin.php';
 ?>

 <table>
      <tr><th>Id</th><th>Id1C</th><th>Login</th><th>Password</th><th></th></tr>
 <?php 
 include ("../../sql/bd.php"); 
 //mysql_select_db("users") or die(mysql_error());
 $strSQL = "SELECT * FROM users where isGroup='".$isGroup."'";
 $rs = mysql_query($strSQL);
 while($row = mysql_fetch_array($rs)) {
 	
 	echo "<tr>
 	<td>".$row['id']."</td>
 	<td>".$row['id1C']."</td>
 	<td>".$row['login']. "</td>
 	<td>".$row['password']."</td>
 	<td width=50px>
 	<form action='edit.php' method='post'>
 	<input name='id' type='text' hidden='true' value=".$row['id'] .">
 	<input name='login' type='text' hidden='true' value=".$row['login'] . ">
 	<input name='password' type='text' hidden='true' value=".$row['password'].">
 	<input type='image' width='20' height='20' src='../../images/edit.png'>
 	</form><form action='delete.php' method='post'>
 	<input name='id' type='text' hidden='true' value=".$row['id'] .">
 	<input type='image' width='20' height='20' src='../../images/delete.png'>
 	</form>
 	</td></tr>";
 	//echo 'Id: '.$row['id'];

 }
 ?>
</table>