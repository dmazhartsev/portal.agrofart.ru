
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
	if (!empty($_POST['category'])) { 
		$category = $_POST['category']; 
		echo "<input name='category' type='text' hidden='true' value='$category'>";
	}
	if (!empty($_POST['exp'])) { 
		$exp = $_POST['exp']; 
		echo "<input name='exp' type='text' hidden='true' value='$exp'>";
	}
	echo "<input name='table' type='text' hidden='true' value='zadania'>";
?>		
<input name='completed' type='text' hidden='true' value='Выполненные'>
<?php 
if ($completed == 'Выполненные')   {
	echo " <input type='submit' style='background-color: #04581d;' value='Выполненные'></p>";
}else {
	echo " <input type='submit' value='Выполненные'></p>"; 
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
	if (!empty($_POST['category'])) { 
		$category = $_POST['category']; 
		echo "<input name='category' type='text' hidden='true' value='$category'>";
	}
	if (!empty($_POST['exp'])) { 
		$exp = $_POST['exp']; 
		echo "<input name='exp' type='text' hidden='true' value='$exp'>";
	}
	echo "<input name='table' type='text' hidden='true' value='zadania'>";
?>		
<input name='completed' type='text' hidden='true' value='НеВыполненные'>
<?php 
if ($completed == 'НеВыполненные')   {
	echo " <input type='submit' style='background-color: #04581d;' value='Не выполненные'></p>";
}else {
	echo " <input type='submit' value='Не выполненные'></p>"; 
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
		if (!empty($_POST['completed'])) { 
			$completed = $_POST['completed']; 
			echo "<input name='completed' type='text' hidden='true' value='$completed'>";
		}
		if (!empty($_POST['exp'])) { 
			$exp = $_POST['exp']; 
			echo "<input name='exp' type='text' hidden='true' value='$exp'>";
		}
		echo "<input name='table' type='text' hidden='true' value='zadania'>";
		?>		
		<input name='category' type='text' hidden='true' value=''>
		<?php
		if ($category == '')  { 
			echo " <input type='submit' style='background-color: #04581d;' value='Все категории'></p>";
		}else {
			echo " <input type='submit' value='Все категории'></p>"; 
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
		if (!empty($_POST['completed'])) { 
			$completed = $_POST['completed']; 
			echo "<input name='completed' type='text' hidden='true' value='$completed'>";
		}
		if (!empty($_POST['exp'])) { 
			$exp = $_POST['exp']; 
			echo "<input name='exp' type='text' hidden='true' value='$exp'>";
		}
		echo "<input name='table' type='text' hidden='true' value='zadania'>";
		?>		
		<input name='category' type='text' hidden='true' value='ПерезаключенияДоговоров'>
		<?php
		if ($category == 'ПерезаключенияДоговоров')  { 
			echo " <input type='submit' style='background-color: #04581d;' value='Задания от КРО'></p>";
		}else {
			echo " <input type='submit' value='Задания от КРО'></p>"; 
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
		if (!empty($_POST['completed'])) { 
			$completed = $_POST['completed']; 
			echo "<input name='completed' type='text' hidden='true' value='$completed'>";
		}
		if (!empty($_POST['exp'])) { 
			$exp = $_POST['exp']; 
			echo "<input name='exp' type='text' hidden='true' value='$exp'>";
		}
		echo "<input name='table' type='text' hidden='true' value='zadania'>";
		?>		
		<input name='category' type='text' hidden='true' value='ЗаданияОтСупервайзера'>
		<?php
		if ($category == 'ЗаданияОтСупервайзера')  { 
			echo " <input type='submit' style='background-color: #04581d;' value='Задания от супервайзера'></p>";
		}else {
			echo " <input type='submit' value='Задания от супервайзера'></p>"; 
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
		if (!empty($_POST['completed'])) { 
			$completed = $_POST['completed']; 
			echo "<input name='completed' type='text' hidden='true' value='$completed'>";
		}
		if (!empty($_POST['exp'])) { 
			$exp = $_POST['exp']; 
			echo "<input name='exp' type='text' hidden='true' value='$exp'>";
		}
		echo "<input name='table' type='text' hidden='true' value='zadania'>";
		?>		
		<input name='category' type='text' hidden='true' value='ОборотТовара'>
		<?php
		if ($category == 'ОборотТовара')  { 
			echo " <input type='submit' style='background-color: #04581d;' value='Оборот товара'></p>";
		}else {
			echo " <input type='submit' value='Оборот товара'></p>"; 
		}
		?> 
	</form>
</div>




