<?php 
session_start();
if(isset($_GET['exit'])) { 
session_destroy();     
#redirect 
header('Location: ../../'); 
exit; 
} 
include ("../../sql/bd.php");
$result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db);     
$myrow = mysql_fetch_array($result);
$userproekt = $myrow['id1C'];
$userSuper = $myrow['Super'];

$cbo_sel = 'SELECTED="SELECTED"';

$strSQL1 = "SELECT distinct Marshrut.Proekt, kontragents.KodKA, kontragents.name FROM `Marshrut`
INNER JOIN users ON (users.id1C = Marshrut.Proekt) and  ((users.id1C='$userproekt') or (id1C1='$userproekt') or (id1C2='$userproekt'))
LEFT JOIN kontragents on kontragents.KodKA = Marshrut.KodKA
Order by kontragents.name";
$rs = mysql_query("$strSQL1");
$selectProektKontragent = [];
$NamesKA = [];
while($row = mysql_fetch_array($rs)) {
$selectProektKontragent[$row['Proekt']][] = $row['KodKA'];
if ($userSuper==1){
	$selectProektKontragent[$_SESSION['id1C']][] = $row['KodKA'];
};
if(!(in_array($row['KodKA'],$NamesKA))){
	$NamesKA[$row['KodKA']][] = htmlspecialchars($row['name']);
};
}; 

$strSQL2 = "SELECT *  FROM `VIdZadach` ORDER BY id"; 

$rs = mysql_query("$strSQL2");

$selectBlokGrupZadach = [];

while($row = mysql_fetch_array($rs)) {
    $selectBlokGrupZadach[$row['BlokZadach']][] = $row['GrupZadach'];
} 
$PageInner = $_POST['PageInner'];
?>
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Постановка задачи</title>
    <link rel="shortcut icon" href="../../images/af.png" type="image/png">
    <link rel="stylesheet" href="../../css/styles.css" type="text/css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div id="wrapper">
        <table style='width:100%;height:100%;border-width: 0;'>
            <tr>
              <td style='padding: 20px'>
                  <div class='authform' style='text-align: right;background-color:#e1e5ec;font-family:sans-serif;'>
                      <?php                                                             
                      if(isset($_POST['id'])){		
                          $result = mysql_query("SELECT * FROM Zadania WHERE id=".$_POST['id'],$db);     
                          $myrow = mysql_fetch_array($result);         
                          $proekt = $myrow['Proekt']; 
                          $Zadanie = $myrow['Zadanie'];
                          $DateA = $myrow['DateA'];
                          $DateB = $myrow['DateB'];
                          $ProektName = $myrow['ProektName'];
                          $idVidZadach = $myrow['idVidZadach'];
                          $idMarshrut = $myrow['idMarshrut'];
						  $KodKA = $myrow['KodKA'];
                          if(isset($idMarshrut)){
                            $result = mysql_query("SELECT Marshrut.Proekt, Marshrut.id, Marshrut.Kontragent, Marshrut.Adress, Marshrut.KodKA, Marshrut.KodTT FROM Marshrut FROM Marshrut 
							WHERE id=".$idMarshrut,$db);     
                            $myrow = mysql_fetch_array($result);           
                            $Kontragent = $myrow['Kontragent'];
                            $Adress = $myrow['Adress'];
							$KodKA = $myrow['KodKA'];
							$KodTT = $myrow['KodTT'];
                        }		  
                    }elseif(isset($_POST['Marshrutid'])){
                     $result = mysql_query("SELECT Marshrut.Proekt, users.login, Marshrut.id, Marshrut.Kontragent, Marshrut.Adress, Marshrut.KodKA, Marshrut.KodTT FROM Marshrut 
					 inner join users on (users.id1c = Marshrut.Proekt)
					 WHERE Marshrut.id=".$_POST['Marshrutid'],$db);     
                     $myrow = mysql_fetch_array($result);         
                     $proekt = $myrow['Proekt']; 
                     $ProektName = $myrow['login'];
                     $idMarshrut = $myrow['id'];	 
                     $Kontragent = $myrow['Kontragent'];
                     $Adress = $myrow['Adress'];
					 $KodKA = $myrow['KodKA'];
					 $KodTT = $myrow['KodTT'];
                 }; 
				 
//var_dump($selectBlokGrupZadach);	
//print_r($NamesKA);
	 
echo "<div style='width: 100%;'><br>";
 
echo "<div style='display: inline-block;width:90%;'>";

echo"<form action='/lk/".$PageInner."/' method='post'>";

if (isset($ProektName)){
	echo"<h3 style='text-align: center'>Постановка задачи для ".$ProektName."</h3>";
 }else{
	echo "<select id='proekt' style='width:100%' name='proekt' class='proekt form-select' onchange='swithkaSelect();'>";
	if ($proekt==$_SESSION['id1C']) {
        echo "<option value=".$_SESSION['id1C']." selected='selected'>Все проекты</option>";
    }else{
        echo "<option value=".$_SESSION['id1C']." >Все проекты</option>";
    };
	$strSQL = "SELECT login,id1C FROM users WHERE (isGroup=0) and ((id1C1='$userproekt')or(id1C2='$userproekt')) ORDER BY id1C";
	$rs = mysql_query($strSQL);
    while($row = mysql_fetch_array($rs)) {
        if ($proekt==$row['id1C']) {
            echo "<option value='".$row['id1C']."' selected='selected'>".$row['id1C'].":".$row['login']."</option>";
        }else{
            echo "<option value='".$row['id1C']."' >".$row['id1C'].":".$row['login']."</option>";
        };                 
    }; 
	echo "</select>";
 };
 
if (isset($Kontragent)){
    echo"<h5 style='text-align: right; '>".$Kontragent."</h3>";
 }else{
	echo "<select id='KodKA' style='width:100%' name='KodKA' class='KodKA form-select'>";
    echo "<option value='0' >Не по маршруту</option>";
	if (empty($_POST['KodKA'])) {
			  $KodKA = '';			  
		  }else{
			  $KodKA = $_POST['KodKA'];
          }; 
	echo "</select>";
 };
 
if (isset($Adress)){	
    echo"<h5 style='text-align: right'>".$Adress."</h3>";
};


echo "<select id='tovar' style='width:100%' name='tovar' class='tovar form-select'>";
echo "<option value='' selected='selected'>Товарная группа</option>";

$strSQL = "SELECT Tovar.id1C, Tovar.Name
FROM `Tovar`
WHERE isGroup =1
ORDER BY id1C2, id1C1, Name";
$rs = mysql_query($strSQL);
while($row = mysql_fetch_array($rs)) {
	if ($proekt==$row['id1C']) {
		echo "<option value='".$row['id1C']."' selected='selected'>".$row['Name']."</option>";
	}else{
		echo "<option value='".$row['id1C']."' >".$row['Name']."</option>";
	};                 
}; 
echo "</select>";

	  echo"<input name='SaveChangesZadania' type='text' hidden='true' value='Yes'>";
	  
	  if ($PageInner=='marshrut'){
		if(isset($_POST['login'])){
			echo"<input name='login' type='text' hidden='true' value='".$_POST['login']."'>";	
		};
		if(isset($_POST['exp'])){
			echo"<input name='exp' type='text' hidden='true' value='".$_POST['exp']."'>";	
		};
        echo"<input name='proekt' type='text' hidden='true' value=".$proekt." >
			<input name='ProektName' type='text' hidden='true' value='".$ProektName."'>
			<input name='KodKA' type='text' hidden='true' value='".$KodKA."' >
			<input name='KodTT' type='text' hidden='true' value='".$KodTT."' >
			<input name='Marshrutid' type='text' hidden='true' value='".$idMarshrut."'>";
         if(isset($_POST['id'])){
            echo "<input name='id' type='text' hidden='true' value=".$_POST['id'].">";				  
         };
	  };
?>

              <div style="margin-bottom:20px;width: 100%;">
                <select id="BlokZadach" name="BlokZadach" style='width:100%' class="base form-select" onchange="swithGrupZadachSelect();">
				<?php
					$strSQL3 = "SELECT DISTINCT BlokZadach FROM `VIdZadach`";
					$rs = mysql_query("$strSQL3");
					while($row = mysql_fetch_array($rs)) {
						echo "<option value='".$row['BlokZadach']."' >".$row['BlokZadach']."</option>";
					}
				?>
                </select>

                <select id="GrupZadach" name="GrupZadach" style='width:100%' class="second form-select">
				<?php
					$strSQL4 = "SELECT DISTINCT GrupZadach FROM `VIdZadach`";
					$rs = mysql_query("$strSQL4");
					while($row = mysql_fetch_array($rs)) {
						echo "<option value='".$row['GrupZadach']."' >".$row['GrupZadach']."</option>";
					}
				?>
                </select>
            </div>
			
			<div style='width:100%;display:block;'>
                <label style='width:10%;display:inline-block;' >Количество:</label>
                <input name="kolvo" type="number" style='width:40%;display:inline-block;' value=<?php echo "'".$kolvo."'" ?>>
				<select id="edizm" name="edizm" style='width:40%;display:inline-block;' class="edizm form-select">
				<?php
					$strSQL5 = "SELECT DISTINCT name FROM `units`";
					$rs = mysql_query("$strSQL5");
					while($row = mysql_fetch_array($rs)) {
						echo "<option value='".$row['name']."' >".$row['name']."</option>";
					}
				?>
				</select>
            </div>
			
			<br>

            <p>
                <label>Текст задания:</label>
                <input name="Zadanie" type="text" required style='width:80%;' maxlength="500" value=<?php echo "'".$Zadanie."'" ?>>
            </p>
            <p>
                <label>Срок выполнения:</label>
                <input name="DateB" type="date" required style='width:80%' value=<?php echo "'".$DateB."'" ?>>
            </p>

            <input type="submit" name="submit" value="Сохранить">
        </form>
    </div>
    <div style='display: inline-block;'>
        <?php 
          echo"<form action='/lk/".$PageInner."/' method='post'>";
		  echo"<input name='SaveChangesZadania' type='text' hidden='true' value='No'>";
	  if(isset($_POST['login'])){
            echo"<input name='login' type='text' hidden='true' value=".$_POST['login'].">";	
      };
	  if(isset($_POST['exp'])){
            echo"<input name='exp' type='text' hidden='true' value='".$_POST['exp']."'>";	
      };
      ?>
      
      <button type="submit">Отмена</button>
  </form>
</div>
</div>
</table>
</div>
<script>
    let BlokGrupZadach;
    let BlokZadachSelect;
	var KodKA = "<?php Print($KodKA); ?>";
	var proekt = "<?php Print($proekt); ?>";
	var NameKA = "";
	let proektselect;
	let proektkontragent;
	let NamesKA;

    $(document).ready(
        function () {
            BlokZadachSelect = jQuery.parseJSON('<?= json_encode(array_keys($selectBlokGrupZadach)); ?>');
            BlokGrupZadach = jQuery.parseJSON('<?= json_encode($selectBlokGrupZadach); ?>');
			proektselect = jQuery.parseJSON('<?= json_encode(array_keys($selectProektKontragent)); ?>');
            proektkontragent = jQuery.parseJSON('<?= json_encode($selectProektKontragent); ?>');
			NamesKA = jQuery.parseJSON('<?= json_encode($NamesKA); ?>');
			
			$( "#BlokZadach" ).html('');
            BlokZadachSelect.forEach(function(item) {
              $( "#BlokZadach" ).append('<option name="'+item+'">'+item+'</option>');
			});
			
			//alert($('#proekt').val());
			
			swithGrupZadachSelect();
			
			swithkaSelect();
			
			if (KodKA === ''){
				$("#KodKA :nth-child(1)").attr("selected", "selected");
			}else{
				$('#KodKA option[value="'+KodKA+'"]').prop('selected', true);
			}
			
			if (proekt === ''){
				$("#proekt :nth-child(1)").attr("selected", "selected");
			}else{
				$('#proekt option[value="'+proekt+'"]').prop('selected', true);
			}
			
			$("#BlokZadach :nth-child(1)").attr("selected", "selected");				
            		
        }
        );

    function swithGrupZadachSelect()
    {
        $( "#GrupZadach" ).html('');
        BlokGrupZadach[$('#BlokZadach').val()].forEach(function(item) {
            $( "#GrupZadach" ).append('<option name="'+item+'">'+item+'</option>');
        });
    }
	
	 function swithkaSelect()	 
	 {
	 let TempArr = [];
	 $("#KodKA").html('');
	 $('#KodKA').append($('<option>', {value: "0", text: 'Не по маршруту'}));
         proektkontragent[$('#proekt').val()].forEach(function(item) {
             if(TempArr.includes(item)===false){
					 NameKA = "";
					 NamesKA[item].forEach(function(item) {
					 NameKA = item;
					 });	 
					 TempArr.push(item);
					$("#KodKA").append('<option value="'+item+'">'+NameKA+'</option>');
				}
         });
    }
</script>
</body>
