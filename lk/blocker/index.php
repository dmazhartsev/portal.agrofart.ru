<?php     
header ("Content-Type: text/html; charset=utf-8");
          //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!     
             
      session_start();     
      if(isset($_GET['exit'])) { 
session_destroy();     
#redirect 
header('Location: ../../'); 
exit; 
} 
// 
$login = stripslashes($login);     
          $login = htmlspecialchars($login);     
$password = stripslashes($password);     
          $password = htmlspecialchars($password); 
// Подключение    ?>  
<head> 
<title>Личный кабинет</title> 
<link rel="shortcut icon" href="../../images/af.png" type="image/png">
<link rel="stylesheet" href="../../css/styles.css" type="text/css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300" type="text/css">
</head> 
<body> 
  <div id="wrapper">
    <header>
      <a href="../../"><img src="../../images/logo.png" alt="Agrofart logo"></a>
      <div id="header-user">
      <?php if (empty($_SESSION['login']) or empty($_SESSION['id']))     
          {     
          // Если пусты, то мы не выводим ссылку
            echo "Вы вошли на сайт, как гость<br>";
            }     
          else     
          {     

          echo "Вы вошли на сайт, как ".$_SESSION['login']."<a href=../../sql/exit.php> Выход</a>";
      } ?>
      </div>
    </header>
    <nav>
      <ul class="top-menu">
        <li><a href="/">ГЛАВНАЯ</a></li>
        <li class="active"><a>ЛИЧНЫЙ КАБИНЕТ</a></li>        
      </ul>
    </nav>
    <div id="heading">
      <h1>ЛИЧНЫЙ КАБИНЕТ</h1>
    </div>
    <aside>
      <nav>
        <ul class="aside-menu">
          <li><a href="../">ИНФО</a></li>
          <li><a href='../users'>СПИСОК ПОЛЬЗОВАТЕЛЕЙ</a></li>
          <li class="active">БЛОКИРОВКА</li>
          <li><a href='../work'>ЗАДОЛЖЕННОСТИ</a></li>
          <li><a href="../request/">ОТГРУЗКИ</a></li>
          <li><a href='../kontagent/'>КОНТРАГЕНТЫ</a></li>
        </ul>
      </nav>
    </aside>
    <section>
    
      <?php 
// 
include ("../../sql/bd.php"); 
     $result = mysql_query("SELECT * FROM users WHERE login='$login'",$db);     
     $myrow = mysql_fetch_array($result);// 

if (empty($_SESSION['login']) or empty($_SESSION['id']))     
          {     
           echo("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='3; URL=../../'></head></html>"); 
        echo("Вы не авторизовались! В течении 5 секуд Вас перенаправит на Главную Страницу"); 
          }     
          else     
          { 
        include 'blocker.php';
         } 
         

?>
      
    </section>
  </div>
  <footer>
    <div id="footer">
      <div id="footer-logo">
        <a href="../../"><img src="../../images/footer-logo.png" alt="Agrofart logo"></a>
        <p>Copyright &copy; 2017 Agrofart </p>
      </div>
 
    </div>
  </footer>    
</body>