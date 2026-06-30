<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300" type="text/css">
<link rel="stylesheet" href="../../css/styles.css" type="text/css">
<style>
.dropbtn {
  background-color: #997c07;
  color: white;
  padding: 5px;
  font-size: 16px;
  border: none;
  width: 80px;
}

.dropdown {
  float: right;	
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;  
  z-index: 1;
  right: 0;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  min-width: 160px;
}

.dropdown-content form {
   margin: 0;
}

.dropdown-content input {
   margin: 0;
   min-width: 120px;
}

.dropdown-content a:hover {background-color: #ddd;}

.dropdown-content input:hover {background-color: #6f5c11;}

.dropdown:hover .dropdown-content {display: block;}

.dropdown:hover .dropbtn {background-color: #6f5c11;}
</style>
</head> 
<body> 
  <div id="wrapper">
    <header>
      <a href="../../"><img src="../../images/logo.png" alt="Agrofart logo"></a>
      <div id="header-user">
      <?php if (empty($_SESSION['login']) or empty($_SESSION['id1C']))     
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
 $ActivePage="marshrut";
	  include ("../../lk/aside.php");
include ("../../sql/bd.php"); 
     $result = mysql_query("SELECT * FROM users WHERE login='$login'",$db);     
     $myrow = mysql_fetch_array($result);// 

if (empty($_SESSION['login']) or empty($_SESSION['id1C']))     
          {     
           echo("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='3; URL=../../'></head></html>"); 
        echo("Вы не авторизовались! В течении 5 секуд Вас перенаправит на Главную Страницу"); 
          }     
          else     
          { 
        include 'usertable.php';
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

<script type="text/javascript">
$(document).ready(function () {

    if (localStorage.getItem("my_app_name_here-quote-scroll") != null) {
        $(window).scrollTop(localStorage.getItem("my_app_name_here-quote-scroll"));
    }

    $(window).on("scroll", function() {
        localStorage.setItem("my_app_name_here-quote-scroll", $(window).scrollTop());
    });

  });
</script>

 