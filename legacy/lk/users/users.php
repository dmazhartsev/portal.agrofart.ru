<div>
   <!--div style="display: inline-block;">
	<form action='../../sql/reg.php' method='post'>
	<input type="submit" name="submit" value="Добавить пользователя">
	</form>
   </div-->
   <div style="display: inline-block;">
    <form action='loadxml.php' method='post'>
	<input type="submit" name="submit" value="Загрузить XML">
	</form>
   </div>
   <div style="display: inline-block;">
    <form action='deleteall.php' method='post'>
	<input type="submit" name="submit" value="Очистить базу пользователей">
	</form>
   </div>
</div>
<br>

<?php include 'usertable.php' ?>
