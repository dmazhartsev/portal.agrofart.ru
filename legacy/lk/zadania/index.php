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
		  include 'save_changes.php';
// Подключение    ?>  
<head> 
<title>Личный кабинет</title> 
<link rel="shortcut icon" href="../../images/af.png" type="image/png">
<link rel="stylesheet" href="../../css/styles.css" type="text/css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300" type="text/css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
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
    
    
      <?php 
// 
$ActivePage="zadania";
	  include ("../../lk/aside.php");
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
        include 'tabletp.php';
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