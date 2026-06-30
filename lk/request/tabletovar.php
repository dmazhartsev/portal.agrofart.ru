<html>
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Документ</title>
    <link rel="shortcut icon" href="../../images/af.png" type="image/png">
    <link rel="stylesheet" href="../../css/styles.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
 <?php 									
	include ("../../sql/bd.php"); 
	$strSQL = "SELECT 
	DocReal.NomDoc AS NomDoc, 
	DocReal.DateDoc AS DateDoc,
	Tovar.Name AS Tovar, 
	DocReal.Kol AS Kol, 
	DocReal.Sum AS Sum, 
	DocReal.SkidkaTovar AS Skidka
	FROM DocReal
	LEFT JOIN Tovar ON Tovar.id1C = DocReal.KodTovar
	WHERE (DocReal.NomDoc='".$_POST['NomDoc']."')";
	$result = mysql_query($strSQL,$db);     
	$myrow = mysql_fetch_array($result);
	$NameDoc = "Реализация ".$myrow['NomDoc']." (".date_format(date_create($myrow['DateDoc']),'d.m.Y').")";
	if (!mysql_data_seek($result, 0)) {
        exit ("По реализации ".$_POST['NomDoc']." не прогружена табличная часть");
    };
?>
    <div id="wrapper" > 
        <table style='width:100%;height:100%;' border="0">
            <tr>
                <td style='padding: 20px'>
                    <div style='text-align: right;background-color:#e1e5ec;font-family:sans-serif;'>
                        <h3 style='text-align: center'>
						<?php
							echo $NameDoc;
						?>
						</h3>
							<table>
							  <tr>
							  <th>Товар</th>
							  <th>Количество</th>
							  <th>Цена</th>
							  <th>Сумма</th>
							  <th></th>
							  </tr>
							   <?php 
								while($row = mysql_fetch_array($result)) {
									$Price = $row['Sum']/$row['Kol'];
									echo "<tr>";
									echo "<td>".$row['Tovar']."</td>";
									echo "<td>".$row['Kol']."</td>";
									echo "<td>".$Price."</td>";
									echo "<td>".$row['Sum']."</td>";
									echo "</tr>";
								}
							   ?>
							</table>
							<div style='width: 100%;'>
								<div style='width:60%;display: inline-block;'>
									<?php echo"
									<form action='/lk/request/' method='post'>
									<input name='CheckCen' type='text' hidden='true' value='Yes'>
									<input name='NomDoc' type='text' hidden='true' value='".$_POST['NomDoc']."'>
									<button type='submit'>Подтверждено</button>
									</form>"; ?>									
								</div>
								<div style='display: inline-block;'>
									<?php echo"
									<form action='complete.php' method='post'>
									<input name='CheckCen' type='text' hidden='true' value='No'>
									<input name='NomDoc' type='text' hidden='true' value='".$_POST['NomDoc']."'>
									<button type='submit'>Несоответствие цен</button>
									</form>"; ?>
								</div>
							</div>
					</div>
				</td>
			</tr>	
        </table>
    </div>
</body>
</html>