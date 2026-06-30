<?php 
include ("../../sql/bd.php"); 
  $result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db);     
     $myrow = mysql_fetch_array($result);
     $proekt = $_SESSION['id1C'];
	 $Super = $myrow['Super'];

	include 'selectuser.php';


?>

 <table>
      <tr><th>Проект</th><th>Контрагент</th><th>Реализация</th><th>Сумма</th><th></th></tr>
 <?php 
 
 if(empty($_POST['KodKA'])) {
$pKodKA=" ";
}elseif($_POST['KodKA']=="Не по маршруту"){
	$KodKA = $_POST['KodKA'];
   $pKodKA=" and (dolg.KodKA='')";
}else{  
	$KodKA = $_POST['KodKA'];
   $pKodKA=" and (dolg.KodKA='$KodKA')"; 
};

  $strSQL = "SELECT * FROM dolg WHERE ((Proekt='$proekt') or (SuperProekt='$proekt') or (SuperPuperProekt='$proekt')) and (Prosrok>=7) ".$pKodKA." ORDER BY ProektName, Kontragent ASC";
 $rs = mysql_query($strSQL);

 while($row = mysql_fetch_array($rs)) {
     unset($Alert);
     
     if (($row['PenniText'] == '')and($row['PenniTextSuper'] == '')) {$Alert = '!'; }
	$lastyear = strtotime('-5 year', time()); 
 	if (empty($row['PenniLogDate'])) {
        $mydate = '-';
    } else if((date('d.m.Y', $time))<(date('d.m.Y', strtotime($row['PenniLogDate'])))){
		$mydate = date('d.m.Y', strtotime($row['PenniLogDate']));}
	else{
		$mydate = '';
    }
	
 	echo "<tr>
    <td>".$row['ProektName']."</td>
 	<td>".$row['Kontragent']."</td>
 	<td>".$row['Name']."</td>
    <td>".$row['Sum']."</td>
 	<td width=50px><strong><font color=#ff0000>".$Alert."</font></strong>
 	<div style='display: inline-block;'>
 	<form action='edit.php' method='post'>
 	<input name='id' type='text' hidden='true' value=".$row['id'] .">
 	<input type='image' width='20' height='20' src='../../images/edit.png'>
 	</form>".$mydate."
 	</div>
 	</td></tr>";
 	//echo 'Id: '.$row['id'];

 }
 
//echo ; // 22.03.2024 13:46:41

 ?>
</table>
