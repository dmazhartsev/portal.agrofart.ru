<?php
header ("Content-Type: text/html; charset=utf-8");
if (isset($_POST['id'])) { $id=$_POST['id']; 
    if ($id =='') { unset($id);} } 
    if (empty($id))
//если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт     
          {     
          exit ("Не выбран!");     
          } 
    $id = trim($id);
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную
 if (empty($login) or empty($password)) //если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт
    {
    exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");
    }
    //если логин и пароль введены, то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
 $password = stripslashes($password);
    $password = htmlspecialchars($password);
 //удаляем лишние пробелы
    $login = trim($login);
    $password = trim($password);
 // подключаемся к базе
    include ("../../sql/bd.php");// файл bd.php должен быть в той же папке, что и все остальные, если это не так, то просто измените путь 
 // проверка на существование пользователя с таким же логином
    $result = mysql_query("SELECT * FROM users WHERE (login='$login') and (id<>'$id')",$db);
    $myrow = mysql_fetch_array($result);
    if (!empty($myrow['id'])) {
    exit ("Извините, введённый вами логин уже зарегистрирован. Введите другой логин.");
    }
 // если такого нет, то сохраняем данные
    $result2 = mysql_query ("UPDATE users SET login='$login', password='$password' WHERE (id = '$id')");
    // Проверяем, есть ли ошибки
    if ($result2=='TRUE')
    {
    exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/users'></head></html>");
    }
 else {
    echo "Ошибка! Вы не зарегистрированы.";
    }
    ?>

   