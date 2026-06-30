<?php

 

include 'reestr.php';

$strsql = "SELECT 
kontragents.name AS name, 
IFNULL( torgtochki.Adress, ' ' ) AS Adress, 
Zadania.KodKA AS KodKA, 
Zadania.KodTT AS KodTT, 
COUNT( Zadania.id )		
FROM `Zadania` 
INNER JOIN users ON (users.id1C = Zadania.Proekt) ".$pProekt." ".$pMarshrut." 
LEFT JOIN kontragents on kontragents.KodKA = Zadania.KodKA 
LEFT JOIN torgtochki on Zadania.KodTT = torgtochki.KodTT
WHERE (1=1) ".$pKodKA."
GROUP BY name, Adress, KodKA, KodTT
ORDER BY name";

//echo $strsql;

echo "<table>
<tr style='border-bottom-style:ridge; '>
<th>Контрагент</th>
<th></th>
</tr>
";

$rs = mysql_query("$strsql");

while($row = mysql_fetch_array($rs)) {
	echo "<tr>";
	
	if (empty($row['name'])){
		echo "<td>Не по маршруту</td>";
	} else { 
		echo "<td><strong>".$row['name']."</strong> ".$row['Adress']."</td>"; 
	};
	
	echo"<td>";
 echo"<form action='' method='post'>";
 
	if(empty($row['KodKA'])) {
		echo "<input name='KodKA' type='text' hidden='true' value=''>";
	}else{  
		$KodKA = $row['KodKA'];
		echo "<input name='KodKA' type='text' hidden='true' value='".$KodKA."'>";
	};
	
	if(empty($row['KodTT'])) {
		echo "<input name='KodTT' type='text' hidden='true' value=''>";
	}else{  
		$KodTT = $row['KodTT'];
		echo "<input name='KodTT' type='text' hidden='true' value='".$KodTT."'>";
	};
	
	if (empty($_POST['exp'])) {
		echo "<input name='exp' type='text' hidden='true' value='ВсеЗадания'>";
	} else {
		$exp = $_POST['exp'];
		echo "<input name='exp' type='text' hidden='true' value='".$exp."'>";
	};
	
	if (empty($_POST['login'])) {
	  $proekt = $_SESSION['id1C'];
	   echo "<input name='login' type='text' hidden='true' value='".$proekt."'>";
	} else {
	  $proekt = $_POST['login'];
	   echo "<input name='login' type='text' hidden='true' value='".$proekt."'>";
	};
	
	echo "<input name='completed' type='text' hidden='true' value='НеВыполненные'>";
	
	echo "<input name='table' type='text' hidden='true' value='zadania'>";
	
	echo"<input style='width: 80px; margin-top:5px;' type='submit' name='submit' value='Задания'>
	</form>";
	echo"</td>";
	
	echo "</tr>";
	
}

echo "</table>";