
<div style='width: 80%; float: left;'>

<div style='display: inline-block;'>
<form action="" method="post">
<?php
	if (!empty($_POST['login'])) {
		$proekt = $_POST['login']; 
		echo "<input name='login' type='text' hidden='true' value='$proekt'>";
	}
	if (!empty($_POST['KodKA'])) { 
		$KodKA = $_POST['KodKA']; 
		echo "<input name='KodKA' type='text' hidden='true' value='$KodKA'>";
	}
?>		
<input name='exp' type='text' hidden='true' value='ВсеЗадания'>
<?php 
if ($exp == 'ВсеЗадания')   {
	echo " <input type='submit' style='background-color: #04581d;' value='Все задания'></p>";
}else {
	echo " <input type='submit' value='Все задания'></p>"; 
}
?> 
</form>
</div>
  
<div style='display: inline-block;'>
<form action="" method="post">
<?php
	if (!empty($_POST['login'])) {
		$proekt = $_POST['login']; 
		echo "<input name='login' type='text' hidden='true' value='$proekt'>";
	}
	if (!empty($_POST['KodKA'])) { 
		$KodKA = $_POST['KodKA']; 
		echo "<input name='KodKA' type='text' hidden='true' value='$KodKA'>";
	}
?>		
<input name='exp' type='text' hidden='true' value='ТекущийМаршрут'>
<?php 
if ($exp == 'ТекущийМаршрут')   {
	echo " <input type='submit' style='background-color: #04581d;' value='Текущий маршрут'></p>";
}else {
	echo " <input type='submit' value='Текущий маршрут'></p>"; 
}
?> 
</form>
</div>
 
</div>

<div>
<?php
if($Super==1){
	echo	"<form action='edit.php' method='post'>";
	echo 	"<input name='login' type='text' hidden='true' value='".$_SESSION['id1C']."'>";	
	echo	"<input name='PageInner' type='text' hidden='true' value='zadania'>
			<input type='submit' name='submit' value='Дать задание'>
			</form>"; 
} 
?> 
</div>

