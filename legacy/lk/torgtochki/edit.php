<html>
    <head>
        <meta charset="utf-8">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <style>html{height:100%;font-family:sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;font-size:10px;-webkit-tap-highlight-color:transparent}*,:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}body{height:100%;margin:0;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#333;background-color:#fff}button,h3,input{font-family:inherit}h3{font-weight:500;line-height:1.1;color:inherit;margin-top:0;margin-bottom:20px;font-size:24px}.authform{width:820px;background-color:#e1e5ec;padding:25px 27px;margin: 0 auto;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px}
</style>
<?php 
if (isset($_POST['idKa'])) { $idKa=$_POST['idKa']; 
    if ($idKa =='') { unset($idKa);} } 
    if (empty($idKa))
//если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт     
          {     
          exit ("Не выбран контрагент!");     
          } 
 ?>
        <title>КОНТРАГЕНТЫ</title>
        <link rel="shortcut icon" href="../../images/af.png" type="image/png">
        <link rel="stylesheet" href="../../css/styles.css" type="text/css">
    </head>
    <body style='text-align: center'>
        <table style='width:100%;height:100%;border:none'>
            <tbody>
                <tr>
<td style='padding: 20px'>
<div class='authform' style='text-align: right'>
        <h3 style='text-align: center'>Редактирование торговой точки</h3>
        <form action="save_changes.php" method="post">
        <input name='id' type='text' hidden='true' value=<?php echo $_POST['id'] ?>>
        <input name='idKa' type='text' hidden='true' value=<?php echo $idKa; ?>>
        <?php 
          include ("../../sql/bd.php"); 
          $result = mysql_query("SELECT * FROM torgtochki WHERE id=".$_POST['id'],$db);     
          $myrow = mysql_fetch_array($result);
         ?>
        <!--**** save_changes.php - это адрес обработчика.  ***** -->
        <p>
        <label>Наименование:</label>
        <input name="Name" type="text" required maxlength="100" style='width:80%' value=<?php echo "'".$myrow['name']."'" ?>>
        </p>
        <!--**** В текстовое поле пользователь вводит  ***** -->
         <p>
        <label>КПП:         </label>
        <input name="KPP" type="text"  style='width:80%' maxlength="100" value=<?php echo "'".$myrow['kpp']."'" ?>>
        </p>
         <!--**** В поле  пользователь вводит  ***** --> 
          <p>
        <label>Индекс:</label>
        <input name="Index" type="text"  style='width:80%' maxlength="100" value=<?php echo "'".$myrow['MailIndex']."'" ?>>
        </p>
         <!--**** В поле  пользователь вводит  ***** --> 
          <p>
        <label>Регион:</label>
        <input name="Region" type="text"  style='width:80%' maxlength="100" value=<?php echo "'".$myrow['Region']."'" ?>>
        </p>
         <!--**** В поле  пользователь вводит  ***** --> 
          <p>
        <label>Город:</label>
        <input name="City" type="text"  style='width:80%' maxlength="100" value=<?php echo "'".$myrow['city']."'" ?>>
        </p>
         <!--**** В поле  пользователь вводит  ***** --> 
          <p>
        <label>Улица:</label>
        <input name="Street" type="text"  style='width:80%' maxlength="100" value=<?php echo "'".$myrow['Street']."'" ?>>
        </p>
         <!--**** В поле  пользователь вводит  ***** --> 
          <p>
        <label>Дом:</label>
        <input name="House" type="text"  style='width:80%' maxlength="100" value=<?php echo "'".$myrow['House']."'" ?>>
        </p>
         <!--**** В поле  пользователь вводит  ***** --> 
        <p>
        <input type="submit" name="submit" value="Сохранить">
        <!--**** Кнопочка (type="submit") отправляет данные на страничку save_user.php ***** --> 
        </p></form>
        <form action="/lk/torgtochki/">
          <button type="submit">Отмена</button>
        </form>
        </tbody>
        </table>
    </body>
</html>