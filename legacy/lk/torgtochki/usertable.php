 <table>

  <tr><th colspan="5"> <?php echo "Торговые точки контрагента : ".$Kontragent.""; ?></th></tr>
      
      <tr><th>Наименование</th><th>КПП</th><th>Адрес</th><th></th></tr>
 <?php 
 include ("../../sql/bd.php"); 
  $strSQL = "SELECT * FROM torgtochki where idKa='".$idKa."'";
 $rs = mysql_query($strSQL);
 while($row = mysql_fetch_array($rs)) {
 	$Adress = ''.$row['MailIndex'].', '.$row['Region'].', '.$row['city'].', '.$row['Street'].', '.$row['House']; 
 	echo "<tr>
 	<td>".$row['name']."</td>
 	<td>".$row['kpp']. "</td>
 	<td>".$Adress."</td>
 	<td width=50px>
 	<div style='display: inline-block;'>
 	<form action='edit.php' method='post'>
 	<input name='id' type='text' hidden='true' value=".$row['id'] .">
 	<input name='idKa' type='text' hidden='true' value=".$idKa .">
 	<input type='image' width='20' height='20' src='../../images/edit.png'>
 	</form>
 	</div>
 	<div style='display: inline-block;'>
 	<form action='delete.php' method='post'>
 	<input name='id' type='text' hidden='true' value=".$row['id'] .">
 	<input type='image' width='20' height='20' src='../../images/delete.png'>
 	</form>
 	</div>
 	</td></tr>";
 	//echo 'Id: '.$row['id'];

 }
 ?>
</table>