<?php
include ("../sql/bd.php");


	if($_POST['SaveChangesZadania']=='Yes'){
		if (isset($_POST['id'])) { $id = $_POST['id'];  if ($id == '') { unset($id);} } 
		if (isset($_POST['BlokZadach'])) { $BlokZadach=$_POST['BlokZadach']; if ($BlokZadach =='') { unset($BlokZadach);} }
		if (isset($_POST['GrupZadach'])) { $GrupZadach=$_POST['GrupZadach']; if ($GrupZadach =='') { unset($GrupZadach);} }
		if (isset($_POST['Zadanie'])) { $Zadanie=$_POST['Zadanie']; if ($Zadanie =='') { unset($Zadanie);} }
		if (isset($_POST['DateB'])) { $DateB=$_POST['DateB']; if ($DateB =='') { unset($DateB);} }
		if (isset($_POST['Proekt'])) { $Proekt=$_POST['Proekt']; if ($Proekt =='') { unset($Proekt);} }
		if (isset($_POST['Marshrutid'])) { $idMarshrut=$_POST['Marshrutid']; if ($idMarshrut =='') { unset($idMarshrut);} }
		if (isset($_POST['KodKA'])) { $KodKA=$_POST['KodKA']; if ($KodKA =='') { unset($KodKA);} }
		if (isset($_POST['KodTT'])) { $KodTT=$_POST['KodTT']; if ($KodTT =='') { unset($KodTT);} }
		if (isset($_POST['ProektName'])) { $ProektName=$_POST['ProektName']; if ($ProektName =='') { unset($ProektName);} }
		if (isset($_POST['tovar'])) { $tovar=$_POST['tovar']; if ($tovar =='') { unset($tovar);} }
		if (isset($_POST['kolvo'])) { $kolvo=$_POST['kolvo']; if ($kolvo =='') { unset($kolvo);} }
		if (isset($_POST['edizm'])) { $edizm=$_POST['edizm']; if ($edizm =='') { unset($edizm);} }

		$result = mysql_query("SELECT * FROM VIdZadach WHERE (BlokZadach like '".$BlokZadach."') and (GrupZadach like '".$GrupZadach."')",$db);     
		$myrow = mysql_fetch_array($result);
		$idVidZadach = $myrow['id'];

		$ProektName = stripslashes($ProektName);    
		$ProektName = htmlspecialchars($ProektName);    
		$ProektName = trim($ProektName);

		$Zadanie = stripslashes($Zadanie);    
		$Zadanie = htmlspecialchars($Zadanie);    
		$Zadanie = trim($Zadanie);

		$date_today = date("y.m.d");

		$sql = "INSERT INTO `Zadania`(`Proekt`, `Zadanie`, `Category`, `DateA`, `DateB`, `ProektName`, `idVidZadach`, `KodKA`, `KodNom`, `kolvo`, `edizm`) 
						VALUES ('$Proekt','$Zadanie',2,'$date_today','$DateB','$ProektName','$idVidZadach','$KodKA', '$tovar', '$kolvo', '$edizm')";
		$result = mysql_query($sql) or die("Error ".$sql);
	};
	if($_POST['SaveChangesKontragents']=='Yes'){
		if (isset($_POST['Name'])) { $Name = $_POST['Name'];  if ($Name == '') { unset($Name);} } 
		if (isset($_POST['INN'])) { $INN=$_POST['INN']; if ($INN =='') { unset($INN);} }
		if (isset($_POST['KPP'])) { $KPP=$_POST['KPP']; if ($KPP =='') { unset($KPP);} }
		if (isset($_POST['Index'])) { $Index=$_POST['Index']; if ($Index =='') { unset($Index);} }
		if (isset($_POST['Region'])) { $Region=$_POST['Region']; if ($Region =='') { unset($Region);} }
		if (isset($_POST['City'])) { $City=$_POST['City']; if ($City =='') { unset($City);} }
		if (isset($_POST['Street'])) { $Street=$_POST['Street']; if ($Street =='') { unset($Street);} }
		if (isset($_POST['House'])) { $House=$_POST['House']; if ($House =='') { unset($House);} }
		if (isset($_POST['KodKA'])) { $KodKA=$_POST['KodKA']; if ($KodKA =='') { unset($KodKA);} }
		if (isset($_POST['KodTT'])) { $KodTT=$_POST['KodTT']; if ($KodTT =='') { unset($KodTT);} }
		if (isset($_POST['DayDZ'])) { $DayDZ=$_POST['DayDZ']; if ($DayDZ =='') { unset($DayDZ);} }
		if (isset($_POST['EmailDirector'])) { $EmailDirector=$_POST['EmailDirector']; if ($EmailDirector =='') { unset($EmailDirector);} }
		if (isset($_POST['EmailOtvet'])) { $EmailOtvet=$_POST['EmailOtvet']; if ($EmailOtvet =='') { unset($EmailOtvet);} }
		if (isset($_POST['EmailDeclaration'])) { $EmailDeclaration=$_POST['EmailDeclaration']; if ($EmailDeclaration =='') { unset($EmailDeclaration);} }
		if (isset($_POST['PhoneDirector'])) { $PhoneDirector=$_POST['PhoneDirector']; if ($PhoneDirector =='') { unset($PhoneDirector);} }
		if (isset($_POST['PhoneOtvet'])) { $PhoneOtvet=$_POST['PhoneOtvet']; if ($PhoneOtvet =='') { unset($PhoneOtvet);} }
		if (isset($_POST['PhoneDeclaration'])) { $PhoneDeclaration=$_POST['PhoneDeclaration']; if ($PhoneDeclaration =='') { unset($PhoneDeclaration);} }
		if (isset($_POST['PageInner'])) { $PageInner=$_POST['PageInner']; if ($PageInner =='') { unset($PageInner);} }

		$Name = stripslashes($Name);    $Name = htmlspecialchars($Name);    $Name = trim($Name);
		$INN = stripslashes($INN);    $INN = htmlspecialchars($INN);    $INN = trim($INN);
		$KPP = stripslashes($KPP);    $KPP = htmlspecialchars($KPP);    $KPP = trim($KPP);
		$Index = stripslashes($Index);    $Index = htmlspecialchars($Index);    $Index = trim($Index);
		$Region = stripslashes($Region);    $Region = htmlspecialchars($Region);    $Region = trim($Region);
		$City = stripslashes($City);    $City = htmlspecialchars($City);    $City = trim($City);
		$Street = stripslashes($Street);    $Street = htmlspecialchars($Street);    $Street = trim($Street);
		$House = stripslashes($House);    $House = htmlspecialchars($House);    $House = trim($House);    
		$Adress = ''.$Index.' '.$Region.' '.$City.' '.$Street.' '.$House; 
		 $EmailDirector = stripslashes($EmailDirector);    $EmailDirector = htmlspecialchars($EmailDirector);    $EmailDirector = trim($EmailDirector);  
		$EmailOtvet = stripslashes($EmailOtvet);    $EmailOtvet = htmlspecialchars($EmailOtvet);    $EmailOtvet = trim($EmailOtvet);
$EmailDeclaration = stripslashes($EmailDeclaration);    $EmailDeclaration = htmlspecialchars($EmailDeclaration);    $EmailDeclaration = trim($EmailDeclaration);		
		 $PhoneDirector = stripslashes($PhoneDirector);    $PhoneDirector = htmlspecialchars($PhoneDirector);    $PhoneDirector = trim($PhoneDirector);  
		$PhoneOtvet = stripslashes($PhoneOtvet);    $PhoneOtvet = htmlspecialchars($PhoneOtvet);    $PhoneOtvet = trim($PhoneOtvet); 
		$PhoneDeclaration = stripslashes($PhoneDeclaration);    $PhoneDeclaration = htmlspecialchars($PhoneDeclaration);    $PhoneDeclaration = trim($PhoneDeclaration);

		include ("../../sql/bd.php");

		 $sql = "UPDATE kontragents SET 
		 DayDZ='$DayDZ', 
		 EmailDirector='$EmailDirector', 
		 EmailOtvet='$EmailOtvet', 
		 EmailDeclaration='$EmailDeclaration',
		 PhoneDirector='$PhoneDirector', 
		 PhoneOtvet='$PhoneOtvet', 
		 PhoneDeclaration='$PhoneDeclaration',
		 NeedToLoad=1 
		 WHERE (KodKA = '$KodKA')";

		 $result = mysql_query($sql) or die("Error ".mysql_error());
	};

unset($_POST['SaveChangesZadania']);
unset($_POST['SaveChangesKontragents']);

?>
