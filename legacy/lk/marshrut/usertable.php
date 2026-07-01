<?php 
include ("../../sql/bd.php"); 

  $result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db);     
     $myrow = mysql_fetch_array($result);
     $proekt = $_SESSION['id1C'];
	 $Super = $myrow['Super'];

if ($_SESSION['login']=="Admin" or $Super == 1){
	$proekt = $_POST['login'];
	include 'selectuser.php';
}

include 'reestr.php';
 

//
$days = array( 1 => "ПН" , "ВТ" , "СР" , "ЧТ" , "ПТН" , "СБ" , "ВС" );
//echo $days[2];
 //echo "Проект:".$proekt."";
if ($exp == 'Алфавит'){
	$SortingTxt = 'order by ProektName, Kontragent';
	$VisitDayTxt = " ";
}elseif ($exp == 'Посещ'){
	$SortingTxt = 'order by NomVisitDay, ProektName, Kontragent';
	$VisitDayTxt = " ";
}else{
	$SortingTxt = 'order by ProektName, Kontragent';
	$VisitDayTxt = " and (VisitDay like '%".$exp."%')";
};
		   
$strSQL = "SELECT DISTINCT 
Marshrut.id, 
Marshrut.KodKA, 
Marshrut.KodTT, 
Marshrut.Proekt, 
Marshrut.ProektName, 
Marshrut.Kontragent, 
Marshrut.Adress, 
Marshrut.VisitDay, 
Marshrut.Adress, 
Marshrut.SrokKredit,
Marshrut.VisitPeriod, 
Marshrut.SummKredit, 
Marshrut.Dolg, 
torgtochki.SrokLicense, 
MonthStatistics.CountSalesMonth 
FROM Marshrut 
LEFT OUTER JOIN kontragents ON kontragents.KodKA = Marshrut.KodKA
LEFT JOIN torgtochki ON torgtochki.KodTT = Marshrut.KodTT
right join users on (users.id1c = Marshrut.Proekt) and ((users.id1C='$proekt') or (users.id1C1='$proekt') or (users.id1C2='$proekt'))
LEFT JOIN MonthStatistics on (MonthStatistics.Proekt = Marshrut.Proekt) and (MonthStatistics.KodTT = Marshrut.KodTT)
where (Marshrut.id IS NOT NULL) ".$VisitDayTxt."
".$SortingTxt."
";
		   
		  // echo $strSQL;
 $rs = mysql_query($strSQL);
echo" <table>
	  <tr>
			";
	  if ($_SESSION['login']=="Admin" or $Super == 1){
	  echo "<th  width='30' rowspan='2'>Проект</th>";
	  };
	  echo "
			<th rowspan='2'>Контрагент</th>
			<th rowspan='2'>Адрес</th>
			<th>Посещение</th>
			<th>Отсрочка</th>
			<th rowspan='2'>Долг</th>
			<th rowspan='2'></th>
		</tr>
		<tr>
			<th>Период</th>
			<th>Лимит</th>
		</tr>";
 while($row = mysql_fetch_array($rs)) {
	 $pKodKA=$row['KodKA'];
	 
    $strSQLZadania = "SELECT * FROM Zadania 
	where (Proekt='".$row['Proekt']."') and (KodKA='$pKodKA')";  
	 $rsZadania = mysql_query($strSQLZadania);
	 $num_rowsZadania = mysql_num_rows($rsZadania);
	 
	 $strSQLPeni = "SELECT * FROM dolg 
	where (Proekt='".$row['Proekt']."') and (KodKA='$pKodKA') and (Prosrok>=7)";  
	 $rsPeni = mysql_query($strSQLPeni);
	 $num_rowsPeni = mysql_num_rows($rsPeni);
	 
	 $strSQLDolg = "SELECT * FROM dolg 
	where (Proekt='".$row['Proekt']."') and (KodKA='$pKodKA')";  
	 $rsDolg = mysql_query($strSQLDolg);
	 $num_rowsDolg = mysql_num_rows($rsDolg);
	 
	 $strSQLKA = "SELECT * FROM kontragents 
	where (KodKA='$pKodKA')";  
	 $rsKA = mysql_query($strSQLKA);
	 $num_rowsKA = mysql_num_rows($rsKA);
	 
	$strSQLTovGroupGisMT = "SELECT * FROM TovGroupGisMT_kontragents 
	where (KodKA='$pKodKA')";
	$rsTovGroup = mysql_query($strSQLTovGroupGisMT);

	$textTovGroupGisMT = '';
	while($rowTovGroup = mysql_fetch_array($rsTovGroup)) {
		$textTovGroupGisMT = $textTovGroupGisMT.$rowTovGroup['nameTovGroupGisMT'].' ';
	}
	if($textTovGroupGisMT<>''){
		$textTovGroupGisMT = '('.ltrim(rtrim($textTovGroupGisMT)).')';
	}
	
	 	  
	if ($row['SrokLicense'] == '0000-00-00') {
        $StrSrokLicense = '';
	} else if(time()<strtotime($row['SrokLicense'])){
		$startTimeStamp = strtotime($row['SrokLicense']);
		$endTimeStamp = time();
		$timeDiff = abs($endTimeStamp - $startTimeStamp);
		$numberDays = $timeDiff/86400;  // 86400 seconds in one day
		//convert to integer
		$numberDays = intval($numberDays);
		$SrokLicense = date('d.m.Y', strtotime($row['SrokLicense']));
		if ($numberDays<=10){
			$StrSrokLicense = "<strong><font color=#ff0000>[АЛКО до ".$SrokLicense."]</font></strong>";
		}else{
			$StrSrokLicense = "[АЛКО до ".$SrokLicense."]";
		}		
	}else{
		$StrSrokLicense = '<strong><font color=#ff0000>[АЛКО Просрочено!]</font></strong>';
	}
	
	if ((int)$row['CountSalesMonth'] == 0){
		$StrSalesMonth = '<strong><font color=#0077FF>[Не отгружено в периоде]</font></strong>';
	}else{
		$StrSalesMonth = '';
	} 
	 
 	echo "<tr>
			";
	if ($_SESSION['login']=="Admin" or $Super == 1){
	echo "<td  width='30' rowspan='2'>".$row['ProektName']."</td>";
	};
 	echo "
			<td rowspan='2'>".$row['Kontragent']." ".$textTovGroupGisMT." ".$StrSrokLicense." ".$StrSalesMonth ."</td>
			<td rowspan='2'>".$row['Adress']."</td>
			<td>".$row['VisitDay']."</td>
			<td>".$row['SrokKredit']."</td>
			<td rowspan='2'>".$row['Dolg']."</td>
			<td rowspan='2'>";
if($num_rowsDolg>0 or $num_rowsKA>0 or $Super == 1){
	 echo	"<div class='dropdown'>
			<button class='dropbtn'>Действия</button>
			<div class='dropdown-content'>";
  if($num_rowsDolg>0){
	 echo	"<form action='../work/' method='post'>
			<input name='FilterMarshrut' type='text' hidden='true' value='No'> 
			<input name='SearchText' type='text' hidden='true' value='".$row['KodKA']."'>
			<input type='submit' value='Задолженности'>
			</form>";
  };
  if($num_rowsPeni>0){
	 echo	"<form action='../penni/' method='post'>
			<input name='KodKA' type='text' hidden='true' value=".$row['KodKA'].">
			<input type='submit' value='ПДЗ'>
			</form>";
  };
  if($num_rowsKA>0){
	 echo	"<form action='../kontagent/edit.php' method='post'>
			<input name='KodKA' type='text' hidden='true' value='".$row['KodKA']."'>
			<input name='PageInner' type='text' hidden='true' value='marshrut'>
			<input name='exp' type='text' hidden='true' value='".$exp."'>
			<input name='login' type='text' hidden='true' value='".$proekt."'>
			<input type='submit' name='submit' value='Редактировать КА'>
			</form>";
  };
    
  if($Super == 1){
	echo	"<form action='../zadania/edit.php' method='post'>
			<input name='Marshrutid' type='text' hidden='true' value='".$row['id']."'>
			<input name='exp' type='text' hidden='true' value='".$exp."'>
			<input name='PageInner' type='text' hidden='true' value='marshrut'>
			<input name='login' type='text' hidden='true' value='".$proekt."'>
			<input type='submit' name='submit' value='Дать задание'>
			</form>";  
  };
   echo	"</div>
		</div>"; };
	if($num_rowsZadania>0){
		echo	"<form action='../zadania/' method='post'>
		<input name='KodKA' type='text' hidden='true' value=".$row['KodKA'].">
		<input name='exp' type='text' hidden='true' value='Все задания'>
		<input name='table' type='text' hidden='true' value='zadania'>
		<input style='width: 80px; margin-top:5px;' type='submit' name='submit' value='Задания'>
		</form>";
	};
		echo	"</td>
		</tr>
		<tr>
			<td>".$row['VisitPeriod']."</td>
			<td>".$row['SummKredit']."</td>
		</tr>";
 }

echo	"</table>";

 ?>