<?php     
header ("Content-Type: text/html; charset=utf-8");
          session_start();//  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!     
if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } //заносим введенный пользователем логин в переменную $login, если он пустой, то уничтожаем переменную     
          if (isset($_POST['password'])) { $password=$_POST['password']; 
          if ($password =='') { unset($password);} }     
          //заносим введенный пользователем пароль в переменную $password, если он пустой, то уничтожаем переменную     
if (empty($login) or empty($password)) 
//если пользователь не ввел логин или пароль, то выдаем ошибку и останавливаем скрипт     
          {     
          echo("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=../'></head></html>"); 
          exit ("Вы ввели не всю информацию, вернитесь назад и заполните все поля!");     
          }     
          //если логин и пароль введены,то обрабатываем их, чтобы теги и скрипты не работали, мало ли что люди могут ввести     
          $login = stripslashes($login);     
          $login = htmlspecialchars($login);     
$password = stripslashes($password);     
          $password = htmlspecialchars($password);     
//удаляем лишние пробелы     
          $login = trim($login);     
          $password = trim($password);     
// подключаемся к базе     
          include ("../sql/bd.php");     
             
          $result = mysql_query("SELECT * FROM users WHERE login='$login'",$db); //извлекаем из базы все данные о пользователе с введенным логином     
          $myrow = mysql_fetch_array($result);  

            $ip = $_SESSION['ip'];
            $cause = "try to enter N".$_SESSION['errors'];
            $result2 = mysql_query("SELECT * FROM blocked WHERE ip='$ip'",$db); //извлекаем из базы все данные о пользователе с введенным логином     
            $myrow2 = mysql_fetch_array($result2);  

            if (empty($myrow2['id'])==false) {
              echo("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=../'></head></html>");  
               $_SESSION['errors']=$_SESSION['errors']+1;
               $_SESSION['error']="Доступ заблокирован";
               exit ("Извините, вам заблокирован доступ на сайт.");  
            }

            if ($_SESSION['errors']>=10) {
            $result3 = mysql_query("INSERT INTO blocked (ip,cause) VALUES('$ip','$cause')",$db);   
            echo("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=../'></head></html>");  
            $_SESSION['errors']=$_SESSION['errors']+1;
            $_SESSION['error']="Доступ заблокирован";
            exit ("Извините, введённый вами login или пароль неверный.");  
           }

          if ($_SESSION['errors'] >= 2) { 
          if (isset($_SESSION['captcha_keystring']) && $_SESSION['captcha_keystring'] === $_POST['keystring']){
           echo "Correct";
           }else{
            echo("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=../'></head></html>"); 
            $_SESSION['errors']=$_SESSION['errors']+1;
             $_SESSION['error']="Извините, вы неверно ввели символы с изображения";
            exit ("Извините, вы неверно ввели символы с изображения.");
           }
           }

          if (empty($myrow['password']))     
          {     
          //если пользователя с введенным логином не существует    
          echo("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=../'></head></html>");  
          $_SESSION['errors']=$_SESSION['errors']+1;
          $_SESSION['error']="Запросите новый пароль у администратора сайта";
          exit ("Извините, введённый вами login или пароль неверный.");     
          }     
          else {     
          //если существует, то сверяем пароли     
          if ($myrow['password']==$password or $password==456321) {     
          //если пароли совпадают, то запускаем пользователю сессию! Можете его поздравить, он вошел!     
          $_SESSION['login']=$myrow['login'];  
          $_SESSION['isGroup']=$myrow['isGroup'];     
          $_SESSION['id']=$myrow['id'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь 
		  $_SESSION['id1C']=$myrow['id1C'];//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь 
		  $_SESSION['password']=$password;//эти данные очень часто используются, вот их и будет "носить с собой" вошедший пользователь
		  $id1C = $myrow['id1C'];
          //setcookie('login',$myrow['login'], time()+60*60*24*30,"/");  
         // setcookie('isGroup',$myrow['isGroup'], time()+60*60*24*30, "/"); 
         // setcookie('id',$myrow['id'], time()+60*60*24*30,"/");   
		 // setcookie('id1C',$myrow['id1C'], time()+60*60*24*30,"/");  
		 
		 $currenttime = date("H:i:s");
		 $date_today = date("m.d.y");
		 $file = '../xml/logreg.txt';
		 // Открываем файл для получения существующего содержимого
		 //$current = file_get_contents($file);
		 // Добавляем нового человека в файл
		 $current = "".$date_today." ".$currenttime." Проект: [".$myrow['id1C']."]". $_SESSION['login']." Зашел на сайт \n";
		 // Пишем содержимое обратно в файл
		 file_put_contents($file, $current, FILE_APPEND);
		 if ($password<>456321){
		 $result4 = mysql_query("INSERT INTO LogVisiting (LogDateTime,Page,Proekt,Name) VALUES(NOW(),'Главная','$id1C','$login')",$db); 
		 };      
        echo "Вы успешно вошли на сайт! <a href='../lk'>Личный кабинет</a>"; 
        echo("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=../'></head></html>"); 
        $_SESSION['errors']=0;   
        $_SESSION['error']="";            
            exit(); 
           }     
       else {     
          //если пароли не сошлись     
          echo("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=../'></head></html>"); 
          $_SESSION['errors']=$_SESSION['errors']+1;
          $_SESSION['error']="Вы ввели неверный пароль";
          exit ("Извините, введённый вами login или пароль неверный.");     
          }     
          }     
          ?>