<?php
//echo "buttons";

$result = mysql_query("SELECT DateB, Kvartal
FROM AktSverki
GROUP BY Kvartal
ORDER BY DateB DESC
LIMIT 1",$db);
$myrow = mysql_fetch_array($result);
$MaxKvartal = $myrow['Kvartal'];

if (empty($_POST['exp'])) {
  $exp = $MaxKvartal;
} else {
  $exp = $_POST['exp'];
}

$strSQL = "SELECT DISTINCT DateA , DateB , Kvartal FROM AktSverki";
$rs = mysql_query($strSQL);
echo "<div>";
while($row = mysql_fetch_array($rs)) {
	$DateA = date('d.m.Y', strtotime($row['DateA']));
	$DateB = date('d.m.Y', strtotime($row['DateB']));
	echo "<div style='display: inline-block;'>
  	<form action='' method='post'>
  	<input name='exp' type='text' hidden='true' value='".$row['Kvartal']."'>"; 
	if (empty($_POST['login'])) {}else{ $login = $_POST['login']; 
	echo "<input name='login' type='text' hidden='true' value='$login'>";}
	if ($exp == $row['Kvartal'])  { echo " <input type='submit' style='background-color: #04581d;' value='".$DateA."-".$DateB."'></p>";}
		else {echo " <input type='submit' value='".$DateA."-".$DateB."'></p>"; } 
	echo"</form>
	</div>";
}
echo "</div>";
?>
