<?php  

include ("../../sql/bd.php");
$result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db); 
$myrow = mysql_fetch_array($result);
$Super = $myrow['Super'];
$proekt = $_SESSION['id1C'];

if ($_SESSION['login']=="Admin" or $Super == 1){
	$proekt = $_POST['login'];
	include 'selectuser.php';
}
	
include 'reestr.php';

 if ($exp == 'Сегодня'){
	 $strSQL = mysql_query("SELECT Sum(Sum) AS value_sum,  Count(*) AS value_count from Zayavki WHERE ((Proekt='$proekt')  or (SuperProekt='$proekt') or (SuperPuperProekt='$proekt'))  AND (DocDate = CURRENT_DATE())");
	$row = mysql_fetch_assoc($strSQL); 
	echo "<h3>Всего сформировано ".$row['value_count']." документов на сумму: ".$row['value_sum']."</h3>";
echo "<table>
      <tr>";
	  if ($_SESSION['login']=="Admin" or $Super == 1){
	  echo "<th  width='30'>Проект</th>";
	  };
	  echo "<th>Контрагент</th>
	  <th>Реализация</th>
	  <th>Сумма</th>
	  <th>Комент</th>
	  <th>Статус</th>
	  <th></th>
	  </tr>";
	$strSQL = "SELECT * FROM Zayavki WHERE ((Proekt='$proekt')  or (SuperProekt='$proekt') or (SuperPuperProekt='$proekt'))  AND (DocDate = CURRENT_DATE()) ORDER BY ProektName,DocDate,Kontragent ASC";
	 //binary(lower(Kontragent))
 $rs = mysql_query("$strSQL");
	while($row = mysql_fetch_array($rs)) { 
	$strSQL = mysql_query("SELECT Count(*) AS value_count
	FROM DocReal
	WHERE DocReal.NomDoc = '".$row['NomDoc']."'");
	$rowCountDoc = mysql_fetch_assoc($strSQL);
	$CountDoc = $rowCountDoc['value_count'];
	unset($Alert);   
	if(($row['StatusProverkaCen'] == 'Несоответствие')){	
		$Question = '?';
    }elseif (($row['StatusProverkaCen'] <> 'Подтверждено')) {
		$Alert = '!'; 		
	}else{
		$Question = ''; 
		$Alert = ''; 
	};
	if ($row['Status'] <> "Проведён") {
		$BGColor = "color:black; ' bgcolor='#FA8072' ";
	}else{
		$BGColor = "' ";
	};	 
 	echo "<tr style='".$BGColor.">
   ";
	if ($_SESSION['login']=="Admin" or $Super == 1){
	echo "<td  width='30'>".$row['ProektName']."</td>";
	};
 	echo "<td >".$row['Kontragent']."</td>
 	<td >".$row['Name']."</td>
 	<td >".$row['Sum']. "</td>
	<td >".$row['Koment']. "</td>
 	<td>".$row['Status']. "</td>
	<td width=50px>";
	if($CountDoc>0){
	echo"<strong><font color=#ff0000>".$Alert."</font><font color=#008000>".$Question."</font></strong>
 	<div style='display: inline-block;'>
 	<form action='tabletovar.php' method='post'>
 	<input name='NomDoc' type='text' hidden='true' value=".$row['NomDoc'] .">
 	<input type='image' width='20' height='20' src='../../images/table.png'>
 	</form>
 	</div>";
	}else{
		//echo $CountDoc;
	};
 	echo"</td>	
	</tr>
 	";
 }
 }elseif ($exp == 'Вчера'){
	 $strSQL = mysql_query("SELECT Sum(Sum) AS value_sum,  Count(*) AS value_count from Zayavki WHERE ((Proekt='$proekt')  or (SuperProekt='$proekt') or (SuperPuperProekt='$proekt'))  AND (DeliveryDate = CURRENT_DATE())");
	$row = mysql_fetch_assoc($strSQL); 
	echo "<h3>Всего сформировано ".$row['value_count']." документов на сумму: ".$row['value_sum']."</h3>";
	echo "<table>
      <tr>
	  ";
	  if ($_SESSION['login']=="Admin" or $Super == 1){
	  echo "<th  width='30'>Проект</th>";
	  };
	  echo "
	  <th >Контрагент</th>
	  <th width='30' >Реализация</th>
	  <th>Водитель</th>
	  <th>Статус</th>
	  </tr>
	  ";
	$strSQL = "SELECT * FROM Zayavki WHERE ((Proekt='$proekt')  or (SuperProekt='$proekt') or (SuperPuperProekt='$proekt'))  AND (DeliveryDate = CURRENT_DATE()) ORDER BY ProektName,DocDate,Kontragent ASC";
	 $rs = mysql_query("$strSQL");
	 while($row = mysql_fetch_array($rs)) { 	 
 	echo "<tr>
	";
	if ($_SESSION['login']=="Admin" or $Super == 1){
	echo "<td  width='30'>".$row['ProektName']."</td>";
	};
	$Voditel = 'Не запланирован';
	if (!empty($row['Voditel'])){
		$Voditel = 'Запланирован';
	};
	if (ltrim(rtrim($row['StatusDostavki']))=='Самовывоз'){
		$Voditel = 'Самовывоз';
	};
 	echo "
 	<td>".$row['Kontragent']."</td>
 	<td width='30'>".$row['Name']."</td>
 	<td>".$Voditel. "</td>
 	<td>".$row['StatusDostavki']. "</td>
	</tr>
 	";  
}
 }else{
	 $strSQL = mysql_query("SELECT Sum(Sum) AS value_sum,  Count(*) AS value_count from Zayavki WHERE ((Proekt='$proekt')  or (SuperProekt='$proekt') or (SuperPuperProekt='$proekt'))  AND (DeliveryDate > CURRENT_DATE()) AND (DocDate <> CURRENT_DATE())");
	$row = mysql_fetch_assoc($strSQL); 
	echo "<h3>Всего сформировано ".$row['value_count']." документов на сумму: ".$row['value_sum']."</h3>";
	echo "<table>
      <tr>
	  ";
	  if ($_SESSION['login']=="Admin" or $Super == 1){
	  echo "<th rowspan='2' width='30'>Проект</th>";
	  };
	  echo "
	  <th rowspan='2'>Контрагент</th>
	  <th width='30' rowspan='2'>Реализация</th>
	  <th>Водитель</th>
	  <th rowspan='2'>Доставка</th>
	  </tr>
	  <tr>
		<th width='120'>Телефон</th>
	  </tr>";
	$strSQL = "SELECT * FROM Zayavki WHERE ((Proekt='$proekt')  or (SuperProekt='$proekt') or (SuperPuperProekt='$proekt'))  AND (DeliveryDate > CURRENT_DATE() AND (DocDate <> CURRENT_DATE())) ORDER BY ProektName,DocDate,Kontragent ASC";
	 $rs = mysql_query("$strSQL");
	 while($row = mysql_fetch_array($rs)) { 	
 	echo "<tr>
	";
	if ($_SESSION['login']=="Admin" or $Super == 1){
	echo "<td  width='30'>".$row['ProektName']."</td>";
	};
 	echo "
 	<td rowspan='2'>".$row['Kontragent']."</td>
 	<td width='30' rowspan='2'>".$row['Name']."</td>
 	<td>".$row['Voditel']. "</td>
 	<td>".date_format(date_create($row['DeliveryDate']),'d.m.Y'). "</td>
	</tr>
	<tr>
	<td  width='120' >".$row['Telefon']. "</td>
	<td>".$row['StatusDostavki']. "</td> 	
	</tr>
	
 	";
 }
}

?>
</table>
