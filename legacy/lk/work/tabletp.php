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

if ($exp == 'Выгружено'){
	$strSQL = mysql_query("SELECT Sum(Exp) AS value_sum,  Count(*) AS value_count from dolg WHERE (exp<>0) and ((Proekt='$proekt') or (SuperProekt='$proekt') or (SuperPuperProekt='$proekt'))");
	$row = mysql_fetch_assoc($strSQL); 
	echo "<h3>Всего сформировано ".$row['value_count']." ПКО на сумму: ".$row['value_sum']."</h3>";
};
	  
 
 if ($_SESSION['login']=="Admin"){
	$strSQL = "SELECT * FROM dolg %TextFilterMarshrut%
	WHERE ((dolg.Proekt='$proekt') or (dolg.SuperProekt='$proekt') or (dolg.SuperPuperProekt='$proekt')) %SearchText% 
	ORDER BY dolg.ProektName,  dolg.Kontragent ASC";
}else{
	if ($exp == 'Загружено'){ 
	$strSQL = "SELECT dolg.NomDoc, dolg.DocDate, dolg.Proekt, dolg.SuperProekt, dolg.SuperPuperProekt, dolg.ProektName, dolg.AnotherProekt, dolg.Kontragent, dolg.Exp, dolg.Adress, dolg.Name,
	dolg.Sum, dolg.id, dolg.LoadedTo1C, dolg.StatusEGAIS, dolg.StatusEDO, anotherUser.login as AnotherUserName
	FROM dolg %TextFilterMarshrut%
	LEFT JOIN users as anotherUser on anotherUser.id1C = dolg.AnotherProekt
	WHERE ((dolg.Proekt='$proekt') or (dolg.SuperProekt='$proekt') or (dolg.SuperPuperProekt='$proekt')) and (dolg.Exp=0) %SearchText% 
	ORDER BY dolg.ProektName,   dolg.AnotherProekt, dolg.Kontragent ASC"; 
	} elseif ($exp == 'Выгружено') { 
	$strSQL = "SELECT dolg.NomDoc, dolg.DocDate, dolg.Proekt, dolg.SuperProekt, dolg.SuperPuperProekt, dolg.ProektName, dolg.AnotherProekt, dolg.Kontragent, dolg.Exp, dolg.Adress, dolg.Name,
	dolg.Sum, dolg.id, dolg.LoadedTo1C, dolg.StatusEGAIS, dolg.StatusEDO, anotherUser.login as AnotherUserName 
	FROM dolg %TextFilterMarshrut%
	LEFT JOIN users as anotherUser on anotherUser.id1C = dolg.AnotherProekt
	WHERE ((dolg.Proekt='$proekt') or (dolg.SuperProekt='$proekt') or (dolg.SuperPuperProekt='$proekt')) and (dolg.Exp>0) %SearchText% 
	ORDER BY dolg.ProektName,   dolg.AnotherProekt, dolg.Kontragent ASC"; 
	} else { 
	$strSQL = "SELECT dolg.NomDoc, dolg.DocDate, dolg.Proekt, dolg.SuperProekt, dolg.SuperPuperProekt, dolg.ProektName, dolg.AnotherProekt, dolg.Kontragent, dolg.Exp, dolg.Adress, dolg.Name,
	dolg.Sum, dolg.id, dolg.LoadedTo1C, dolg.StatusEGAIS, dolg.StatusEDO, anotherUser.login as AnotherUserName
	FROM dolg %TextFilterMarshrut%
	LEFT JOIN users as anotherUser on anotherUser.id1C = dolg.AnotherProekt
	WHERE ((dolg.Proekt='$proekt') or (dolg.SuperProekt='$proekt') or (dolg.SuperPuperProekt='$proekt'))  %SearchText% 
	ORDER BY dolg.ProektName,   dolg.AnotherProekt, dolg.Kontragent ASC"; 
	}
} 

if (empty($_POST['SearchText'])) {
	$strSQL = str_replace("%SearchText%", "", $strSQL);
} else {
	$strSQL = str_replace("%SearchText%", "and ((dolg.Name like '%".$_POST['SearchText']."%') or (dolg.Kontragent like '%".$_POST['SearchText']."%') 
	or (dolg.KodKA like '%".$_POST['SearchText']."%')  or (dolg.Adress like '%".$_POST['SearchText']."%'))", $strSQL);
};

if ($FilterMarshrut == 'Yes'){
	$days = array( 1 => "ПН" , "ВТ" , "СР" , "ЧТ" , "ПТН" , "СБ" , "ВС" );
	$DayToday = $days[date("N")];
	$TextFilterMarshrut = "INNER JOIN Marshrut on ((Marshrut.KodTT = dolg.KodTT) and (VisitDay like '%".$DayToday."%') and (Marshrut.proekt = dolg.proekt))";
	$strSQL = str_replace("%TextFilterMarshrut%", $TextFilterMarshrut, $strSQL);
}else{
	$strSQL = str_replace("%TextFilterMarshrut%", "", $strSQL);
};

 $anotherProject = '';
 
 //echo 'Query: '+$strSQL;
 
 echo"<table>
      <tr>
	  ";
	  
	  if ($_SESSION['login']=="Admin" or $Super == 1){
		echo "<th  width='30'>Проект</th>";
	  };
	  
	  echo "<th>Контрагент</th>
	  <th>Адрес</th>
	  <th>Реализация</th>
	  <th>Задолж.</th>
	  <th>ПКО</th>
	  </tr>";

 $rs = mysql_query("$strSQL");
 while($row = mysql_fetch_array($rs)) {
	 
	$NomDoc = $row['NomDoc'];
	$DocDate = $row['DocDate'];
	 
	$strSQL = mysql_query("SELECT Count(*) AS value_count FROM Dover
		WHERE ((Dover.NomDoc='$NomDoc') and (Dover.DateDoc='$DocDate'))");
	$DoverCount = mysql_fetch_assoc($strSQL); 
	  
	if($DoverCount['value_count']==0){
		$ButtonDover = "<div style='display: inline-block;'>
		<form action='dover.php' method='post' style='display: inline-block;'>
		<input name='NomDoc' type='text' hidden='true' value=".$row['NomDoc'] .">
		<input name='DocDate' type='text' hidden='true' value=".$row['DocDate'] . ">
		<input name='Sum' type='text' hidden='true' value=".$row['Sum'].">
		<input style='width: 80px; margin-top:5px;' type='submit' name='submit' value='Доверенность'>
		</form>
		</div>";
	}else{		
		$ButtonDover = '';
	}; 
	 
	if (($_SESSION['login']<>'Admin') && 
	($Super <> 1) && 
	(isset($row['AnotherProekt'])) && 
	($row['AnotherProekt']<>$anotherProject)
	) {
		echo "<tr bgcolor='#eaf2d3' style='font-weight:bold;'><td colspan='5'>[".$row['AnotherProekt']."] ".$row['AnotherUserName']."</td></tr>";
		$anotherProject = $row['AnotherProekt'];
	};
	
 	unset($Alert);
	unset($StatusEDO);
	
	if ($row['StatusEGAIS'] == 'Отправлен в ЕГАИС') {
		$Alert = ' Не акцептовано'; 
	};
	
	$StatusEDO = ' '.$row['StatusEDO'];
	
 	echo "<tr>";
	
	if ($_SESSION['login']=="Admin" or $Super == 1){
		echo "<td  width='30'>".$row['ProektName']."</td>";
	};
	
 	echo "<td>".$row['Kontragent']."</td>
 	<td>".$row['Adress']."</td>
 	<td>".$row['Name']."<strong><font color=#ff0000>".$Alert."</font><font color=#4682B4>".$StatusEDO."</font></strong>";
	echo "".$ButtonDover;
	echo "</td>";
 
 	//echo "<td>".$row['Exp']. "</td>";
	if ($row['Exp']==0){
		
 	echo "<td style='font-size: 20px;'>".$row['Sum']. "
		<div style='display: inline-block;'>
		<form action='exp.php' method='post' style='display: inline-block;'>
		<input name='id' type='text' hidden='true' value=".$row['id'] .">
		<input name='Name' type='text' hidden='true' value=".$row['Name'] . ">
		<input name='Sum' type='text' hidden='true' value=".$row['Sum'].">
		<input name='Exp' type='text' hidden='true' value=".$row['Sum'].">
		<input style='width: 80px; margin-top:5px;' type='submit' name='submit' value='Погасить'>
		</form>
		</div>";
		
	echo "</td>";
	
	}else{
		echo "<td>".$row['Sum']. "</td>";
	}	
    	
 	if ($row['Exp']==0){
		echo 	"<td width=50px><div><div style='display: inline-block;'>
		<form action='exp.php' method='post'>
		<input name='id' type='text' hidden='true' value=".$row['id'] .">
		<input name='Name' type='text' hidden='true' value=".$row['Name'] . ">
		<input name='Sum' type='text' hidden='true' value=".$row['Sum'].">
		<input name='Exp' type='text' required placeholder='Сумма ПКО' size='10'>
		<input style='width: 122px; margin-top:5px;' type='submit' name='submit' value='Сформировать ПКО'>
		</form></div></td>";
	}
 	else{
		echo "<td width=50px><div>".$row['Exp'];
		if ($row['LoadedTo1C']<>1){
			echo "<div style='display: inline-block;'><form action='cancel.php' method='post' style='display: inline-block;'>
			<input name='id' type='text' hidden='true' value=".$row['id'] .">
			<input type='submit' name='submit' value='Отмена выгрузки'>
			</form></div> ";
		}
		echo "</td>";
	}
 		
 }
echo"</table>";

//echo $strSQL;
?>
