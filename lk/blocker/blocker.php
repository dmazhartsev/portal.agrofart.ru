 <table>
      <tr><th>Id</th><th>IP</th><th>Cause</th><th></th></tr>
 <?php 
 include ("../../sql/bd.php"); 
 //mysql_select_db("users") or die(mysql_error());
 $strSQL = "SELECT * FROM blocked";
 $rs = mysql_query($strSQL);
 while($row = mysql_fetch_array($rs)) {
 	
 	echo "<tr>
 	<td>".$row['id']."</td>
 	<td>".$row['ip']."</td>
 	<td>".$row['cause']. "</td>
 	<td width=50px>
 	<form action='delete.php' method='post'>
 	<input name='id' type='text' hidden='true' value=".$row['id'] .">
 	<input type='image' width='20' height='20' src='../../images/delete.png'>
 	</form>
 	</td></tr>";
 	//echo 'Id: '.$row['id'];
	
 }
 ?>
</table>