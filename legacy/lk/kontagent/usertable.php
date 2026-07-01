 <table>
      <tr><th>Наименование</th><th>ИНН</th><th></th></tr>
 <?php 
 // echo "".$Id1C."";
 include ("../../sql/bd.php"); 
  $result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db);     
     $myrow = mysql_fetch_array($result);
     $Id1C = $myrow['id1C'];
  $strSQL = "SELECT DISTINCT 
  kontragents.PhoneDirector, 
  kontragents.PhoneOtvet, 
  kontragents.EmailDirector, 
  kontragents.EmailDirector, 
  kontragents.DayDZ, 
  kontragents.name, 
  kontragents.inn, 
  kontragents.id, 
  kontragents.KodKA,
  USERSTABLE.login
  FROM kontragents
  INNER JOIN (SELECT DISTINCT dolg.kodKA, users.login, users.id1C FROM dolg 
	INNER JOIN users ON (users.id1C = dolg.proekt) and ((users.Id1C='".$Id1C."') or (users.Id1C1='".$Id1C."') or (users.Id1C2='".$Id1C."'))
  UNION ALL
  SELECT DISTINCT Marshrut.kodKA, users.login, users.id1C FROM Marshrut 
	INNER JOIN users ON (users.id1C = Marshrut.proekt) and ((users.Id1C='".$Id1C."') or (users.Id1C1='".$Id1C."') or (users.Id1C2='".$Id1C."'))
	) AS USERSTABLE ON kontragents.kodKA = USERSTABLE.kodKA 
  order by USERSTABLE.login, kontragents.name";
 $rs = mysql_query($strSQL);

 while($row = mysql_fetch_array($rs)) {
     unset($Alert);
     
     $PhoneDirector = ltrim(rtrim($row['PhoneDirector']));
     $PhoneOtvet = ltrim(rtrim($row['PhoneOtvet']));
	 $PhoneDeclaration = ltrim(rtrim($row['PhoneDeclaration']));
     $EmailOtvet = ltrim(rtrim($row['EmailDirector']));
     $EmailDirector = ltrim(rtrim($row['EmailDirector']));
	 $EmailDeclaration = ltrim(rtrim($row['EmailDirector']));
     $DayDZ = ltrim(rtrim($row['DayDZ']));
     if (
	 ($row['DayDZ'] == 0) 
	 || ($row['DayDZ'] == '') 
	 || ($PhoneDirector == '') 
	 || ($PhoneOtvet == '') 
	 || ($EmailOtvet == '') 
	 || ($EmailDirector == '') 
	 || ($PhoneDeclaration == '') 
	 || ($EmailDeclaration == '')
	)	 
	 {
		$Alert = '!';
	 }
 	
 	echo "<tr>
 	<td>".$row['name']."</td>
 	<td>".$row['inn']."</td>
 	<td width=50px><strong><font color=#ff0000>".$Alert."</font></strong>
 	<div style='display: inline-block;'>
 	<form action='edit.php' method='post'>
 	<input name='KodKA' type='text' hidden='true' value=".$row['KodKA'] .">
	<input name='PageInner' type='text' hidden='true' value='kontagent'>
 	<input type='image' width='20' height='20' src='../../images/edit.png'>
 	</form>
 	</div>
 	</td></tr>";
 	//echo 'Id: '.$row['id'];

 }
  echo "</table>";
  //echo $strSQL;
 ?>

