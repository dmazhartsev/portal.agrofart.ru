<?php  

include ("../../sql/bd.php");
$result = mysql_query("SELECT * FROM users WHERE id=".$_SESSION['id'],$db); 
$myrow = mysql_fetch_array($result);
 if (isset($_GET['mes']))
{
    echo "<p style = 'font-size: 14pt; margin: 5px' >Координаты: ". $_GET['mes']."</p>";
}
?>

 <div id='coords'></div>
 <table>
      <tr><th>Адрес</th><th></th></tr>
 <?php 

	$strSQL = "SELECT * FROM Riders WHERE Rider='$proekt' ORDER BY date, time ASC";

 $rs = mysql_query("$strSQL");
 while($row = mysql_fetch_array($rs)) {
 	
 	echo "<tr>";
 	echo "
 	
 	<td style = 'font-size: 14pt;'>".$row['adress']."</td>";
 
 	//echo "<td>".$row['Exp']. "</td>";

  	
 	if ($row['exp']==0){echo
  	"<td width='140px'><div><div style='display: inline-block;'>
 	<form action='exp.php' method='post'>
 	<input name='id' type='text' hidden='true' value=".$row['id'] .">
  <input name='proekt' type='text' hidden='true' value=".$proekt.">
  <input name='coords' type='text' hidden='true' value='".$_GET['mes']."'>
  <select type='expsel' name='expsel'>
  <option value=1>Доставлено</option>
  <option value=2>Частично</option>
  <option value=3>Отказ</option>
  </select> 
 	<input type='submit' name='submit' value='ОК'>
 	</form></div></td>";}
 	else{echo 
 		"<td width=50px><div style='display: inline-block;'><form action='cancel.php' method='post' style='display: inline-block;'>
 	<input name='id' type='text' hidden='true' value=".$row['id'] .">
 	<input type='submit' name='submit' value='Отмена'>
 	</form></div></td>
 		";}
 		
 }
 echo "</table>";
 if (isset($_GET['mes']))
{
    exit();
}
?>




<script language="javascript"><!--
  if (!navigator.geolocation) {
query='mes=Неизвестная ошибка'; 
document.location.href=document.URL+'?'+query;
}else{
navigator.geolocation.getCurrentPosition(function(position) {
  query='mes=' + position.coords.latitude.toFixed(3) + ';' + position.coords.longitude.toFixed(3)+ ';' + position.coords.accuracy.toFixed(3); 
  document.location.href=document.URL+'?'+query;
}, function(error) {
query='mes=' + error.message; 
document.location.href=document.URL+'?'+query;
            });}
//--></script>

