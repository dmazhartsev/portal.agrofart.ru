<?php
if (empty($_POST['exp'])) {
  $exp = 'Загружено';
} else {
  $exp = $_POST['exp'];
};
if (empty($_POST['FilterMarshrut'])) {
  $FilterMarshrut = 'No';
} else {
  $FilterMarshrut = $_POST['exp'];
};
?>
<div>
   

 <div style='display: inline-block;'>
  	<form action="" method="post">
  	<input name='exp' type='text' hidden='true' value='Загружено'>
	<?php 
	if (empty($_POST['FilterMarshrut'])) {}else{ $FilterMarshrut = $_POST['FilterMarshrut'];	echo "<input name='FilterMarshrut' type='text' hidden='true' value='$FilterMarshrut'>";};
	if (empty($_POST['SearchText'])) {}else{ $SearchText = $_POST['SearchText']; echo "<input name='SearchText' type='text' hidden='true' value='$SearchText'>";};
	if (empty($_POST['login'])) {}else{ $login = $_POST['login']; echo "<input name='login' type='text' hidden='true' value='$login'>";};
	if ($exp == 'Загружено')  { echo " <input type='submit' style='background-color: #04581d;' value='Задолженности'></p>";}
		else {echo " <input type='submit' value='Задолженности'></p>"; }?> 
	</form>
 </div>

<div style='display: inline-block;'>
  	<form action="" method="post">
  	<input name='exp' type='text' hidden='true' value='Выгружено'>
	<?php 
	if (empty($_POST['FilterMarshrut'])) {}else{ $FilterMarshrut = $_POST['FilterMarshrut'];	echo "<input name='FilterMarshrut' type='text' hidden='true' value='$FilterMarshrut'>";};
	if (empty($_POST['SearchText'])) {}else{ $SearchText = $_POST['SearchText']; echo "<input name='SearchText' type='text' hidden='true' value='$SearchText'>";};
	if (empty($_POST['login'])) {}else{ $login = $_POST['login']; echo "<input name='login' type='text' hidden='true' value='$login'>";};
	if ($exp == 'Выгружено')  { echo " <input type='submit' style='background-color: #04581d;' value='Реестр'></p>";}
		else {echo " <input type='submit' value='Реестр'></p>"; }?> 
	</form>
 </div>
 
 <div style='display: inline-block;'>
  	<form action="" method="post">
  	<input name='FilterMarshrut' type='text' hidden='true' value='Yes'>
	<?php 
	if (empty($_POST['SearchText'])) {}else{ $SearchText = $_POST['SearchText']; echo "<input name='SearchText' type='text' hidden='true' value='$SearchText'>";};
	if (empty($_POST['exp'])) {}else{ $exp = $_POST['exp'];	echo "<input name='exp' type='text' hidden='true' value='$exp'>";};
	if (empty($_POST['login'])) {}else{ $login = $_POST['login']; echo "<input name='login' type='text' hidden='true' value='$login'>";};
	if ($FilterMarshrut == 'Yes')  { echo " <input type='submit' style='background-color: #04581d;' value='Текущий маршрут'></p>";}
		else {echo " <input type='submit' value='Текущий маршрут'></p>"; }?> 
	</form>
 </div>
 
 <div style='display: inline-block;'>
  	<form action="" method="post">
  	<input name='FilterMarshrut' type='text' hidden='true' value='No'>
	<?php 
	if (empty($_POST['SearchText'])) {}else{ $SearchText = $_POST['SearchText']; echo "<input name='SearchText' type='text' hidden='true' value='$SearchText'>";};
	if (empty($_POST['exp'])) {}else{ $exp = $_POST['exp'];	echo "<input name='exp' type='text' hidden='true' value='$exp'>";};
	if (empty($_POST['login'])) {}else{ $login = $_POST['login']; echo "<input name='login' type='text' hidden='true' value='$login'>";};
	if ($FilterMarshrut == 'No')  { echo " <input type='submit' style='background-color: #04581d;' value='Все контрагенты'></p>";}
		else {echo " <input type='submit' value='Все контрагенты'></p>"; }?> 
	</form>
 </div>
 
 <div style='display: inline-block;'>
  	<form action="" method="post">  	
	<?php 
	if (empty($_POST['FilterMarshrut'])) {}else{ $FilterMarshrut = $_POST['FilterMarshrut'];	echo "<input name='FilterMarshrut' type='text' hidden='true' value='$FilterMarshrut'>";};
	if (empty($_POST['exp'])) {}else{ $exp = $_POST['exp']; 	echo "<input name='exp' type='text' hidden='true' value='$exp'>";};
	if (empty($_POST['login'])) {}else{ $login = $_POST['login']; 	echo "<input name='login' type='text' hidden='true' value='$login'>";};
	echo "<input name='SearchText' type='text' required size='18,5' value='".$_POST['SearchText']."'>";
	?> 
	 <input type='submit' value='Найти'></p>		
	</form>
 </div>
 
 <div style='display: inline-block;'>
  	<form action="" method="post">  	
	<?php 
	if (empty($_POST['FilterMarshrut'])) {}else{ $FilterMarshrut = $_POST['FilterMarshrut'];	echo "<input name='FilterMarshrut' type='text' hidden='true' value='$FilterMarshrut'>";};
	if (empty($_POST['exp'])) {}else{ $exp = $_POST['exp']; 	echo "<input name='exp' type='text' hidden='true' value='$exp'>";}
	if (empty($_POST['login'])) {}else{ $login = $_POST['login']; 	echo "<input name='login' type='text' hidden='true' value='$login'>";};
	echo "<input name='SearchText' type='text' hidden='true' value=''>";
	?> 
	 <input type='submit' value='Отменить поиск'></p>		
	</form>
 </div>

</div>

