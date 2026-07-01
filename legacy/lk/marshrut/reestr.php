<?php
$days = array( 1 => "ПН" , "ВТ" , "СР" , "ЧТ" , "ПТН" , "СБ" , "ВС" );
if (empty($_POST['exp'])) {
  $exp = $days[date("N")];
} else {
  $exp = $_POST['exp'];
}
include 'save_changes.php';
?>
<div>
  <div style='display: inline-block;'>
  	<form action="" method="post">
  	<input name='exp' type='text' hidden='true' value='Алфавит'>
	<?php 
	if (empty($_POST['login'])) {}else{ $login = $_POST['login']; echo "<input name='login' type='text' hidden='true' value='$login'>";}
	if ($exp == 'Алфавит')  { echo " <input type='submit' style='background-color: #04581d;' value='Сорт по контрагенту'></p>";}
		else {echo " <input type='submit' value='Сорт по контрагенту'></p>"; }?> 
	</form>
 </div>
<div style='display: inline-block;'>
  	<form action="" method="post">
  	<input name='exp' type='text' hidden='true' value='Посещ'>
	<?php
	if (empty($_POST['login'])) {}else{ $login = $_POST['login']; echo "<input name='login' type='text' hidden='true' value='$login'>";}
	if ($exp == 'Посещ')  { echo " <input type='submit' style='background-color: #04581d;' value='Сорт по дню посещения'></p>";}
		else {echo " <input type='submit' value='Сорт по дню посещения'></p>"; }?> 
	</form>
 </div>
 <?php
 
 foreach ($days as $key => $value) {
	if ( $days[date("N")] == $value) {$namebutton = 'Маршрут текущ дня';} else {$namebutton = $value;};
   echo "<div style='display: inline-block;'>  	<form action='' method='post'>  	<input name='exp' type='text' hidden='true' value='".$value."'>";	 
	if (empty($_POST['login'])) {}	else{$login = $_POST['login']; 	echo "<input name='login' type='text' hidden='true' value='$login'>";}
	if ($exp == $value)  { echo " <input type='submit' style='background-color: #04581d;' value='".$namebutton."'></p>";} else {echo " <input type='submit' value='".$namebutton."'></p>"; } 
	echo "</form> </div> ";
}
 ?>
 
</div>
