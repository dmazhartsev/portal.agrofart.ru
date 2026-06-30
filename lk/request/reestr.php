<?php
if (empty($_POST['exp'])) {
  $exp = 'Сегодня';
} else {
  $exp = $_POST['exp'];
}
include 'save_changes.php';
?>
<div>
  <div style='display: inline-block;'>
  	<form action="" method="post">
  	<input name='exp' type='text' hidden='true' value='Сегодня'>
	<?php 
	if (empty($_POST['login'])) {}else{ $login = $_POST['login']; echo "<input name='login' type='text' hidden='true' value='$login'>";};
	if ($exp == 'Сегодня')  { echo " <input type='submit' style='background-color: #04581d;' value='Реестр заказов'></p>";}
		else {echo " <input type='submit' value='Реестр заказов'></p>"; }?> 
	</form>
 </div>
<div style='display: inline-block;'>
  	<form action="" method="post">
  	<input name='exp' type='text' hidden='true' value='Вчера'>
	<?php 
	if (empty($_POST['login'])) {}else{ $login = $_POST['login']; echo "<input name='login' type='text' hidden='true' value='$login'>";};
	if ($exp == 'Вчера')  { echo " <input type='submit' style='background-color: #04581d;' value='Текущий развоз'></p>";}
		else {echo " <input type='submit' value='Текущий развоз'></p>"; }?> 
	</form>
 </div>
<div style='display: inline-block;'>
  	<form action="" method="post">
  	<input name='exp' type='text' hidden='true' value='Потом'>
	<?php 
	if (empty($_POST['login'])) {}else{ $login = $_POST['login']; echo "<input name='login' type='text' hidden='true' value='$login'>";};
	if ($exp == 'Потом')  { echo " <input type='submit' style='background-color: #04581d;' value='Передоставки'></p>";}
		else {echo " <input type='submit' value='Передоставки'></p>"; }?> 
	</form>
 </div>
</div>

