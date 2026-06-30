 <table>
      <tr><th>№</th><th>Контрагент</th><th>Документ</th></tr>
 <?php 
 // echo "".$Id1C."";
 include ("../../sql/bd.php"); 
  $result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db);     
  $myrow = mysql_fetch_array($result);
  $Id1C = $myrow['id1C'];
  $strSQL = "SELECT 
	Zayavki.Kontragent, CONCAT('Реализация ', Zayavki.NomDoc, ' (', DATE_FORMAT(Zayavki.DocDate, '%d.%m.%y'), ')') AS Name
	FROM Zayavki
	LEFT JOIN users ON users.id1C = Zayavki.Proekt
	WHERE ((users.id1C='".$Id1C."') OR (users.id1C1='".$Id1C."') OR (users.id1C2='".$Id1C."'))
	AND (Zayavki.StatusEdo = 'Отправлен' OR  Zayavki.StatusEdo = 'Доставлен')
	AND Zayavki.DeliveryDate < CURDATE()

	UNION ALL

	SELECT 
	Korrektirovki.Kontragent, 
	CONCAT('ИспрСчетФактура ', Korrektirovki.NomDoc, ' (', DATE_FORMAT(Korrektirovki.DocDate, '%d.%m.%y'), ')') AS Name
	FROM Korrektirovki
	LEFT JOIN users ON users.id1C = Korrektirovki.Proekt
	WHERE ((users.id1C='".$Id1C."') OR (users.id1C1='".$Id1C."') OR (users.id1C2='".$Id1C."'))
	AND (Korrektirovki.StatusEdo = 'Отправлен' OR Korrektirovki.StatusEdo = 'Доставлен')
	
	ORDER BY Kontragent, Name";
  
  $rs = mysql_query($strSQL);
  $NomerStr = 0;	
  while($row = mysql_fetch_array($rs)) {
	
	$NomerStr = $NomerStr + 1;
	
 	echo "<tr>
	<td>".$NomerStr."</td>
 	<td>".$row['Kontragent']."</td>
 	<td>".$row['Name']."</td>
 	</tr>";

 }
  echo "</table>";
  //echo $strSQL;
 ?>

