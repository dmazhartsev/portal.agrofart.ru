<?php
include ("../../sql/bd.php");
if (isset($_POST['KodKA'])) { $KodKA=$_POST['KodKA']; if ($KodKA =='') { unset($KodKA);} }
if (isset($_POST['id'])) { $id = $_POST['id'];  if ($id == '') { unset($id);} } 
if (isset($_POST['exp'])) { $exp = $_POST['exp'];  if ($exp == '') { unset($exp);} } 
if (isset($_POST['login'])) { $login = $_POST['login'];  if ($login == '') { unset($login);} } 
if (isset($_POST['DateB'])){
$strDateB = date_create($_POST['DateB']); 
$strDateB = date_format($strDateB,'d.m.Y');
}
	if($_POST['CompleteZadania']=='Yes'){
		$Komment = $_POST['Komment'];
		$result = mysql_query ("UPDATE Zadania SET Komment = '".$Komment."',Complete = '".$_POST['complete']."' WHERE (id = '".$id."')");
		$resultsql = mysql_query("SELECT * FROM StatusZadania WHERE (DateC=CURRENT_DATE()) and (idZadania = '".$id."')");
		if(is_resource($resultsql) && mysql_num_rows($resultsql) > 0 ){
			$result = mysql_query ("UPDATE StatusZadania SET Komment = '".$Komment."',Complete = '".$_POST['complete']."' WHERE (DateC=CURRENT_DATE()) and (idZadania = '".$id."')");
		}else{
			$result = mysql_query ("INSERT INTO StatusZadania (idZadania,DateC,Komment,Complete) VALUES ('".$id."','".date("y.m.d")."','".$Komment."','".$_POST['complete']."')");
		}
	};
	
	if($_POST['PerenosZadania']=='Yes'){
			
		$result = mysql_query ("UPDATE Zadania SET DateB='".$_POST['DateB']."', Komment = '".$Komment."',Complete = '".$_POST['complete']."' WHERE (id = '".$id."')");
		$Komment = "Перенос на ".$strDateB." (".$_POST['Komment'].")";
	
		$resultsql = mysql_query("SELECT * FROM StatusZadania WHERE (DateC=CURRENT_DATE()) and (idZadania = '".$id."')");
		if(is_resource($resultsql) && mysql_num_rows($resultsql) > 0 ){
			$result = mysql_query ("UPDATE StatusZadania SET Komment = '".$Komment."',Complete = '".$_POST['complete']."' WHERE (DateC=CURRENT_DATE()) and (idZadania = '".$id."')");
		}else{
			$result = mysql_query ("INSERT INTO StatusZadania (idZadania,DateC,Komment,Complete) VALUES ('".$id."','".date("y.m.d")."','".$Komment."','".$_POST['complete']."')");
		}
	};
	
	if($_POST['OtmenaZadania']=='Yes'){
		$result = mysql_query ("Delete from Zadania WHERE (id = '".$id."')");
	};	
	
	if($_POST['SaveChangesZadania']=='Yes'){ 
		//echo '<script>alert("Proekt:'.$_POST['proekt'].';KodKA:'.$_POST['KodKA'].'")</script>';
		if (isset($_POST['BlokZadach'])) { $BlokZadach=$_POST['BlokZadach']; if ($BlokZadach =='') { unset($BlokZadach);} }
		if (isset($_POST['GrupZadach'])) { $GrupZadach=$_POST['GrupZadach']; if ($GrupZadach =='') { unset($GrupZadach);} }
		if (isset($_POST['Zadanie'])) { $Zadanie=$_POST['Zadanie']; if ($Zadanie =='') { unset($Zadanie);} }
		if (isset($_POST['DateB'])) { $DateB=$_POST['DateB']; if ($DateB =='') { unset($DateB);} }
		if (isset($_POST['proekt'])) { $Proekt=$_POST['proekt']; if ($Proekt =='') { unset($Proekt);} }
		if (isset($_POST['KodKA'])) { $KodKA=$_POST['KodKA']; if ($KodKA =='') { unset($KodKA);} } //
		if (isset($_POST['tovar'])) { $tovar=$_POST['tovar']; if ($tovar =='') { unset($tovar);} }
		if (isset($_POST['kolvo'])) { $kolvo=$_POST['kolvo']; if ($kolvo =='') { unset($kolvo);} }
		if (isset($_POST['edizm'])) { $edizm=$_POST['edizm']; if ($edizm =='') { unset($edizm);} }

		$result = mysql_query("SELECT * FROM VIdZadach WHERE (BlokZadach like '".$BlokZadach."') and (GrupZadach like '".$GrupZadach."')",$db);     
		$myrow = mysql_fetch_array($result);
		$idVidZadach = $myrow['id'];
		
		$result = mysql_query("SELECT * FROM users WHERE id1C=".$Proekt,$db);     
		$myrow = mysql_fetch_array($result);
		$userproekt = $myrow['id1C'];
		$userSuper = $myrow['Super'];
		$userName = $myrow['login'];
		
		if ($userSuper==1){
			
			$strSQL = "SELECT login,id1C FROM users WHERE (isGroup=0) and ((id1C1='$userproekt')or(id1C2='$userproekt')) ORDER BY id1C";
			$rs = mysql_query("$strSQL");
			while($row = mysql_fetch_array($rs)) {
				
				$ProektName = stripslashes($row['login']);    
				$ProektName = htmlspecialchars($ProektName);    
				$ProektName = trim($ProektName);

				$Zadanie = stripslashes($Zadanie);    
				$Zadanie = htmlspecialchars($Zadanie);    
				$Zadanie = trim($Zadanie);
				
				$Proekt = $row['id1C'];

				$date_today = date("y.m.d");

				$sql = "INSERT INTO `Zadania`(`Proekt`, `Zadanie`, `Category`, `DateA`, `DateB`, `ProektName`, `idVidZadach`, `KodKA`, `KodNom`, `kolvo`, `edizm`) 
						VALUES ('$Proekt','$Zadanie',2,'$date_today','$DateB','$ProektName','$idVidZadach','$KodKA', '$tovar', '$kolvo', '$edizm')";
				$result = mysql_query($sql) or die("Error ".$sql);
				
			}	
			
		}else{
						
			$ProektName = stripslashes($userName);    
			$ProektName = htmlspecialchars($ProektName);    
			$ProektName = trim($ProektName);

			$Zadanie = stripslashes($Zadanie);    
			$Zadanie = htmlspecialchars($Zadanie);    
			$Zadanie = trim($Zadanie);

			$date_today = date("y.m.d");

			$sql = "INSERT INTO `Zadania`(`Proekt`, `Zadanie`, `Category`, `DateA`, `DateB`, `ProektName`, `idVidZadach`, `KodKA`, `KodNom`, `kolvo`, `edizm`) 
						VALUES ('$Proekt','$Zadanie',2,'$date_today','$DateB','$ProektName','$idVidZadach','$KodKA', '$tovar', '$kolvo', '$edizm')";
			$result = mysql_query($sql) or die("Error ".$sql);
			
		}	
	}

unset($_POST['CompleteZadania']);
unset($_POST['PerenosZadania']);
unset($_POST['OtmenaZadania']);
unset($_POST['SaveChangesZadania']);

?>
