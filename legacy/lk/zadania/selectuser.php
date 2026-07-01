<?php 
include ("../../sql/bd.php");

$result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db);     
$myrow = mysql_fetch_array($result);
$userproekt = $myrow['id1C'];
$userSuper = $myrow['Super'];
if (empty($_POST['login'])) {
  $proekt = $_SESSION['id1C'];
} else {
  $proekt = $_POST['login'];
};

$strSQL = "SELECT distinct Zadania.KodKA,Zadania.Proekt,kontragents.name FROM `Zadania` 
INNER JOIN users ON (users.id1C = Zadania.Proekt) and  ((users.id1C='$proekt') or (id1C1='$proekt') or (id1C2='$proekt'))
LEFT JOIN kontragents on kontragents.KodKA = Zadania.KodKA   
LEFT JOIN (SELECT idZadania, Complete, DateC FROM StatusZadania S WHERE DateC=(SELECT Max(DateC) From StatusZadania Where idZadania = S.idZadania)) AS StatusZadania on (StatusZadania.idZadania = Zadania.id) and  ((StatusZadania.Complete<>1) or (StatusZadania.Complete is null))
Order by kontragents.name";
$rs = mysql_query("$strSQL");
//echo $strSQL;
$selectItms = [];
$NamesKA = [];

while($row = mysql_fetch_array($rs)) {
$selectItms[$row['Proekt']][] = $row['KodKA'];
if ($userSuper==1){
	$selectItms[$_SESSION['id1C']][] = $row['KodKA'];
}
if(!(in_array($row['KodKA'],$NamesKA))){
	$NamesKA[$row['KodKA']][] = htmlspecialchars($row['name']);
}
} 
//print_r($NamesKA);
echo "<form action='' method='post' >"; 
          if ($_SESSION['login']=="Admin" or $userSuper == 1){
				  $HiddenSelect = "";  
			  }else{
				  //$HiddenSelect = "style='visibility:hidden;'";				
			  };
               echo "<select ".$HiddenSelect." type='login' name='login' class='base form-select' onchange='swithSecondSelect();'>";               
			   if ($_SESSION['login']=="Admin" or $userSuper == 1){
			   if ($proekt==$_SESSION['id1C']) {
                    echo "<option value=".$_SESSION['id1C']." selected='selected'>Все проекты</option>";
                  }else{
                    echo "<option value=".$_SESSION['id1C']." >Все проекты</option>";
                  }      
			   }
              
               //mysql_select_db("users") or die(mysql_error());
               if ($userSuper==1){
				   $strSQL = "SELECT login,id1C FROM users WHERE (isGroup=0) and ((id1C1='$userproekt')or(id1C2='$userproekt')) ORDER BY id1C";
			   }elseif($_SESSION['login']=="Admin"){
				   $strSQL = "SELECT login,id1C FROM users WHERE isGroup=0 ORDER BY id1C";
			   }else{
				   $strSQL = "SELECT login,id1C FROM users WHERE (isGroup=0) and (id1C='$userproekt') ORDER BY id1C";
			   }
               $rs = mysql_query($strSQL);
                while($row = mysql_fetch_array($rs)) {
                 if ($proekt==$row['id1C']) {
                    echo "<option value='".$row['id1C']."' selected='selected'>".$row['id1C'].":".$row['login']."</option>";
                  }else{
                    echo "<option value='".$row['id1C']."' >".$row['id1C'].":".$row['login']."</option>";
                  }                 
               } 
		  echo "</select>   ";   
		  
		  echo "<select id='KodKA' type='login' name='KodKA' class='second form-select'>
		  <option value='' >Все контрагенты</option>";

if (!empty($_POST['exp'])) { 
	$exp = $_POST['exp']; 
	echo "<input name='exp' type='text' hidden='true' value='$exp'>";
}
echo"<input type='submit' value='Сформировать список' style='margin-left: 5px;'>
</form>";
echo "<div id='result'></div>";

//print_r($_POST['KodKA']);

?>	
<script>
    let jsonFull;
    let baseSelect;
	var KodKA = "<?php Print($KodKA); ?>";
	var NameKA = "";
	var result = "";
	
    $(document).ready(
        function () {
			
            baseSelect = jQuery.parseJSON('<?= json_encode(array_keys($selectItms)); ?>');
			
            jsonFull = jQuery.parseJSON('<?= json_encode($selectItms); ?>');
			
			NamesKA = jQuery.parseJSON('<?= json_encode($NamesKA); ?>');
			$('#result').text(result);
            swithSecondSelect();
			if (KodKA == ''){
				$("#KodKA :nth-child(1)").attr("selected", "selected");
			}else{
				$('#KodKA option[value="'+KodKA+'"]').prop('selected', true);
			};
        }
        );

    function swithSecondSelect() {
		let SecondArr = new Array();
        $(".second").html('');
		$('#KodKA').append($('<option>', {
			value: " ",
			text: 'Все контрагенты'
		}));
        jsonFull[$('.base').val()].forEach(function(item) {			
			if (item == ''){
				//if($(".second").includes("Не по маршруту")==false){
					$( ".second" ).append('<option value="Не по маршруту">Не по маршруту</option>')	
				//}			
			}else{
				if(SecondArr.includes(item)==false){
					NameKA = "";
					 NamesKA[item].forEach(function(item) {
					 NameKA = item;
					 });	 
					 SecondArr.push(item);
					$(".second").append('<option value="'+item+'">'+NameKA+'</option>')
				}
			}
        });		
    }
</script>
