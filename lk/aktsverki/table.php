<?php 
include ("../../sql/bd.php"); 
  $result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db);     
     $myrow = mysql_fetch_array($result);
     $proekt = $_SESSION['id1C'];
	 $Super = $myrow['Super'];

if ($_SESSION['login']=="Admin"){
	$proekt = $_POST['login'];
	include 'selectuser.php';
}elseif($Super == 1){
	$proekt = $_POST['login'];
	include 'selectuser.php';
}
//echo "table";
include 'reestr.php';

 echo "<table>
<tr><th>Проект</th><th>НомерАкта</th><th>Контрагент</th><th>ДатаВозврата</th><th>Инфо</th></tr>";

if($proekt<>999999){
       $pProekt="((AktSverki.Proekt='$proekt') or (id1C1='$proekt') or (id1C2='$proekt'))";
   }elseif ($_SESSION['login']=="Admin"){
      $pProekt=" ";
  }else{      
   $pProekt="((id1C1='$proekt') or (id1C2='$proekt'))"; 
}

$strSQL = "SELECT AktSverki.Kvartal, AktSverki.Proekt, AktSverki.DateA, AktSverki.DateB, AktSverki.DateC, users.id1C1, users.id1C2, users.login, AktSverki.NomDoc, AktSverki.KodKA, AktSverki.KommentSbis, kontragents.name
FROM `AktSverki`
INNER JOIN users ON users.id1C = AktSverki.Proekt
LEFT JOIN kontragents ON kontragents.KodKA = AktSverki.KodKA
WHERE ".$pProekt." and (Kvartal=".$exp.") ORDER BY login, name ASC";



 $rs = mysql_query($strSQL);

 while($row = mysql_fetch_array($rs)) {
	 
	 if((date('d.m.Y', $time))<(date('d.m.Y', strtotime($row['DateC'])))){
		$DateC = date('d.m.Y', strtotime($row['DateC']));}
	else{
		$DateC = '';
    };
 
	echo "<tr>
    <td>".$row['login']."</td>
 	<td>".$row['NomDoc']."</td>
 	<td>".$row['name']."</td>
    <td>".$DateC."</td>
	<td>".$row['KommentSbis']."</td>
	</tr>"; 
 } 

echo"</table>";

echo phpversion();
?>




