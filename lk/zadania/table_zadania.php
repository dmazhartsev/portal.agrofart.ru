<?php

include 'category_select.php'; 

if($completed=='Выполненные'){
	$pCompleted = $Super == 0 ? ' and (IFNULL(StatusZadania.Complete, 0)<>0)' : ' and (IFNULL(StatusZadania.Complete, 0)=1)';
}else{
	$pCompleted = $Super == 0 ? ' and (IFNULL(StatusZadania.Complete, 0)=0)' : ' and (IFNULL(StatusZadania.Complete, 0)<>1)';
};

//echo 'pCategory='.$pCategory.' category='.$category;

$strSQL = "SELECT DISTINCT
    Zadania.id, 
    Zadania.DateA, 
    Zadania.DateB, 
    Zadania.ProektName, 
    Zadania.Zadanie, 
    users.id1C1, 
    users.id1C2, 
    kontragents.name, 
    torgtochki.Adress, 
    VIdZadach.BlokZadach, 
    VIdZadach.GrupZadach, 
    IFNULL(StatusZadania.Complete, 0) Complete, 
    StatusZadania.DateC, 
    StatusZadania.Komment 
FROM `Zadania` 
INNER JOIN users ON (users.id1C = Zadania.Proekt) ".$pProekt."
".$pMarshrut." 
LEFT JOIN kontragents ON kontragents.KodKA = Zadania.KodKA 
LEFT JOIN torgtochki on Zadania.KodTT = torgtochki.KodTT
LEFT JOIN VIdZadach ON VIdZadach.id = Zadania.idVidZadach 
LEFT JOIN (
    SELECT idZadania, 
	Complete, 
	DateC, 
	Komment 
    FROM StatusZadania S 
    WHERE DateC = (SELECT MAX(DateC) FROM StatusZadania WHERE idZadania = S.idZadania)
) AS StatusZadania ON StatusZadania.idZadania = Zadania.id 
WHERE  ".$pCategory."  ".$pKodKA."  ".$pKodTT." ".$pCompleted."
ORDER BY ProektName, DateB";

//echo $strSQL;

echo "<table>
<tr style='border-bottom-style:ridge; '>
";
if ($_SESSION['login']=="Admin" or $Super == 1){
echo "<th  width='30'>Проект</th>";
};
echo "
<th colspan='2'>Задание</th>
<th>Дата получения</th>
<th>Срок выполнения</th>
<th></th>
</tr>";

$rs = mysql_query("$strSQL");

while($row = mysql_fetch_array($rs)) { 

	if (time() > strtotime($row['DateB'])) {
		$BGColor = "color:black; ' bgcolor='#FA8072' ";
	}else{
		$BGColor = "' ";
	};
	
	$CompleteTP = "";
	
	if($row['Complete']<>0){
		$CompleteTP = "Выполнено "; 
		$TextButton = 'Не выполнено';
		$PutComplete = 0;
	}else{
		$TextButton = 'Выполнено';
		$PutComplete = 2;
	};
	
	if (ltrim(rtrim($row['Komment']))<>"Выполнено") {	
		$CompleteTP = ltrim(rtrim($row['Komment']));
	};

   $strDateA = date_create($row['DateA']);
   $strDateB = date_create($row['DateB']);
      
   $strDateA = date_format($strDateA,'d.m.Y');
   $strDateB = date_format($strDateB,'d.m.Y');
      
   echo "<tr style='".$BGColor.">
   ";
	if ($_SESSION['login']=="Admin" or $Super == 1){
	echo "<td  width='30' rowspan='3'>".$row['ProektName']."</td>";
	};
 	echo "
   <td >".$row['BlokZadach']."</td><td >".$row['GrupZadach']."</td>
   <td  rowspan='3'>".$strDateA."</td>
   <td  rowspan='3'>".$strDateB." ".$CompleteTP."</td><td  rowspan='3'>";
	if(($Super == 1) and ($exp == 'ЗаданияОтСупервайзера')){ 			
			echo "<td  rowspan='3'><div style='display: inline-block;'>
			<form action='complete.php' method='post'>
			<input name='id' type='text' hidden='true' value='".$row['id']."'>
			<input name='complete' type='number' hidden='true' value=1>";
			if(empty($_POST['KodKA'])) {
				echo "<input name='KodKA' type='text' hidden='true' value=''>";
			}else{  
				$KodKA = $_POST['KodKA'];
				echo "<input name='KodKA' type='text' hidden='true' value='".$KodKA."'>";
			};
			if (empty($_POST['exp'])) {
			  echo "<input name='KodKA' type='text' hidden='true' value='ВсеЗадания'>";
			} else {
			  $exp = $_POST['exp'];
			  echo "<input name='exp' type='text' hidden='true' value='".$exp."'>";
			};
			if (empty($_POST['login'])) {
			  $proekt = $_SESSION['id1C'];
			} else {
			  $proekt = $_POST['login'];			   
			};
			echo "<input name='login' type='text' hidden='true' value='".$proekt."'>";
			echo"<input type='submit' style='width:70px' name='submit' value='Выполнено'>
			</form>
			<form action='complete.php' method='post'>
			<input name='id' type='text' hidden='true' value='".$row['id']."'>
			<input name='DateB' type='date' hidden='true' value='".$row['DateB'] ."'>
			<input name='complete' type='number' hidden='true' value=0>";
			if(empty($_POST['KodKA'])) {
				echo "<input name='KodKA' type='text' hidden='true' value=''>";
			}else{  
				$KodKA = $_POST['KodKA'];
				echo "<input name='KodKA' type='text' hidden='true' value='".$KodKA."'>";
			};
			if (empty($_POST['exp'])) {
			  echo "<input name='KodKA' type='text' hidden='true' value='ВсеЗадания'>";
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
			echo"
			<input type='submit' style='width:70px' name='submit' value='Перенести'>
			</form>
			<form action='' method='post'>
			<input name='OtmenaZadania' type='text' hidden='true' value='Yes'>
			<input name='id' type='text' hidden='true' value='".$row['id']."'>";
			if(empty($_POST['KodKA'])) {
				echo "<input name='KodKA' type='text' hidden='true' value=''>";
			}else{  
				$KodKA = $_POST['KodKA'];
				echo "<input name='KodKA' type='text' hidden='true' value='".$KodKA."'>";
			};
			if (empty($_POST['exp'])) {
			  echo "<input name='KodKA' type='text' hidden='true' value='ВсеЗадания'>";
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
			echo"
				<input type='submit' style='width:70px' name='submit' value='Отменить'>
				</form>
				</div></td>";}elseif(($Super == 0)&&($completed<>'Выполненные')){ 
					echo "<div style='display: inline-block;'>
					<form action='complete.php' method='post'>
					<input name='id' type='text' hidden='true' value='".$row['id']."'>
					<input name='complete' type='number' hidden='true' value=".$PutComplete.">";
					if(empty($_POST['KodKA'])) {
						echo "<input name='KodKA' type='text' hidden='true' value=''>";
					}else{  
						$KodKA = $_POST['KodKA'];
						echo "<input name='KodKA' type='text' hidden='true' value='".$KodKA."'>";
					};
					if (empty($_POST['exp'])) {
					  echo "<input name='KodKA' type='text' hidden='true' value='ВсеЗадания'>";
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
					echo"<input type='submit' style='width:70px' name='submit' value='".$TextButton."'>
					</form>
					";
			}else{
				echo '$Super='.$Super.' Complete='.$row['Complete'];
			};
   echo "</td></tr>
   <tr style='".$BGColor.">";
   if (empty($row['name'])){
   echo "<td  colspan='2'>Не по маршруту</td>";
   } else { 
   echo "<td colspan='2'><strong>".$row['name']."</strong> ".$row['Adress']."</td>"; 
   };
   echo "
   </tr>
   <tr style='border-bottom-style:ridge; ".$BGColor.">
   <td colspan='2'>".$row['Zadanie']."</td>
   </tr>";
}
echo "</table>";