<html>
    <head>
        <meta charset="utf-8">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <style>html{height:100%;font-family:sans-serif;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;font-size:10px;-webkit-tap-highlight-color:transparent}*,:after,:before{-webkit-box-sizing:border-box;-moz-box-sizing:border-box;box-sizing:border-box}body{height:100%;margin:0;font-family:'Helvetica Neue',Helvetica,Arial,sans-serif;font-size:14px;line-height:1.42857143;color:#333;background-color:#fff}button,h3,input{font-family:inherit}h3{font-weight:500;line-height:1.1;color:inherit;margin-top:0;margin-bottom:20px;font-size:24px}.authform{width:300px;background-color:#e1e5ec;padding:25px 27px;margin: 0 auto;-moz-border-radius:4px;-webkit-border-radius:4px;border-radius:4px}
</style>
        <title>Редактирование</title>
    </head>
    <body style='text-align: center'>
        <table style='width:100%;height:100%;border:none'>
            <tbody>
                <tr>
<td style='padding: 20px'>
<div class='authform' style='text-align: center'>
        <h3><?php echo $_POST['login'];  ?>  </h3>
        <form action="save_changes.php" method="post">
        <input name='id' type='text' hidden='true' value=<?php echo $_POST['id'] ?>>
        <!--**** save_user.php - это адрес обработчика.  То есть, после нажатия на кнопку "Зарегистрироваться", данные из полей  отправятся на страничку save_user.php методом "post" ***** -->
        <p>
        <label>Логин:<br></label>
        <input name="login" type="text" size="15" value=<?php echo $_POST['login'] ?> maxlength="15">
        </p>
        <!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->
        <p>
        <label>Пароль:<br></label>
        <input name="password" type="password" size="15" value=<?php echo $_POST['password'] ?> maxlength="15">
        </p>
         <!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** --> 
        <p>
        <input type="submit" name="submit" value="Сохранить">
        <!--**** Кнопочка (type="submit") отправляет данные на страничку save_changes.php ***** --> 
        </p></form>
        </tbody>
        </table>
    </body>
</html>