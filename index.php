<?php     
header ("Content-Type: text/html; charset=utf-8");
include ("./sql/bd.php");
          //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!     
             
      session_start();     
      if(isset($_GET['exit'])) { 
session_destroy();     
#redirect 
header('Location: index.php'); 
exit; 
} 
?>     
         
<head> 
<title>Главная страница</title> 
<!-- Блок стили для кастомных комбобоксов + -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">
<style>
  .custom-combobox {
    position: relative;
    display: inline-block;
  }
  .custom-combobox-toggle {
    position: absolute;
    top: 0;
    bottom: 0;
    margin-left: -1px;
    padding: 0;
  }
  .custom-combobox-input {
    margin: 0;
    padding: 5px 10px;
	width: 250px;
	color: #b2b2b2;
  }
  </style>
  <!-- Блок стили для кастомных комбобоксов - -->
<link rel="shortcut icon" href="/images/af.png" type="image/png">
<link rel="stylesheet" href="css/styles.css" type="text/css">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Oswald:400,300" type="text/css">
<link charset="utf-8" rel="stylesheet" type="text/css" href="css/smoke-pure.css" />
<script type="text/javascript" src="js/smoke-pure.js"></script>
<!--script>
    function dataSelect(f) {
      n = f.login.selectedIndex
      if(n) alert("Выбран: " + f.login.options[n].value)
    }
  </script-->
  <!-- Блок скрипт для кастомных комбобоксов + -->
  <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
  <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
  <script>
  $( function() {
    $.widget( "custom.combobox", {
      _create: function() {
        this.wrapper = $( "<span>" )
          .addClass( "custom-combobox" )
          .insertAfter( this.element );
 
        this.element.hide();
        this._createAutocomplete();
        this._createShowAllButton();
      },
 
      _createAutocomplete: function() {
        var selected = this.element.children( ":selected" ),
          value = selected.val() ? selected.text() : "";
 
        this.input = $( "<input>" )
          .appendTo( this.wrapper )
          .val( value )
          .attr( "title", "" )
          .addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
          .autocomplete({
            delay: 0,
            minLength: 0,
            source: this._source.bind( this )
          })
          .tooltip({
            classes: {
              "ui-tooltip": "ui-state-highlight"
            }
          });
 
        this._on( this.input, {
          autocompleteselect: function( event, ui ) {
            ui.item.option.selected = true;
            this._trigger( "select", event, {
              item: ui.item.option
            });
          },
 
          autocompletechange: "_removeIfInvalid"
        });
      },
 
      _createShowAllButton: function() {
        var input = this.input,
          wasOpen = false;
 
        $( "<a>" )
          .attr( "tabIndex", -1 )
          .attr( "title", "Show All Items" )
          .tooltip()
          .appendTo( this.wrapper )
          .button({
            icons: {
              primary: "ui-icon-triangle-1-s"
            },
            text: false
          })
          .removeClass( "ui-corner-all" )
          .addClass( "custom-combobox-toggle ui-corner-right" )
          .on( "mousedown", function() {
            wasOpen = input.autocomplete( "widget" ).is( ":visible" );
          })
          .on( "click", function() {
            input.trigger( "focus" );
 
            // Close if already visible
            if ( wasOpen ) {
              return;
            }
 
            // Pass empty string as value to search for, displaying all results
            input.autocomplete( "search", "" );
          });
      },
 
      _source: function( request, response ) {
        var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
        response( this.element.children( "option" ).map(function() {
          var text = $( this ).text();
          if ( this.value && ( !request.term || matcher.test(text) ) )
            return {
              label: text,
              value: text,
              option: this
            };
        }) );
      },
 
      _removeIfInvalid: function( event, ui ) {
 
        // Selected an item, nothing to do
        if ( ui.item ) {
          return;
        }
 
        // Search for a match (case-insensitive)
        var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
        this.element.children( "option" ).each(function() {
          if ( $( this ).text().toLowerCase() === valueLowerCase ) {
            this.selected = valid = true;
            return false;
          }
        });
 
        // Found a match, nothing to do
        if ( valid ) {
          return;
        }
 
        // Remove invalid value
        this.input
          .val( "" )
          .attr( "title", value + " didn't match any item" )
          .tooltip( "open" );
        this.element.val( "" );
        this._delay(function() {
          this.input.tooltip( "close" ).attr( "title", "" );
        }, 2500 );
        this.input.autocomplete( "instance" ).term = "";
      },
 
      _destroy: function() {
        this.wrapper.remove();
        this.element.show();
      }
    });
 
    $( "#combobox" ).combobox();
    $( "#toggle" ).on( "click", function() {
      $( "#combobox" ).toggle();
    });
  } );
  </script>
  <!-- Блок скрипт для кастомных комбобоксов - -->
</head> 
<body> 
  <div id="wrapper">
    <header>
      <a href="/"><img src="images/logo.png" alt="Agrofart logo"></a>
      <div id="header-user">
      <?php 
      $ip = $_SERVER['REMOTE_ADDR'];
          if (array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER)) {
          $ip = array_pop(explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']));}
          $user_agent = $_SERVER["HTTP_USER_AGENT"];
          if (strpos($user_agent, "Firefox") !== false) $browser = "Firefox";
          elseif (strpos($user_agent, "Opera") !== false) $browser = "Opera";
          elseif (strpos($user_agent, "Chrome") !== false) $browser = "Chrome";
          elseif (strpos($user_agent, "MSIE") !== false) $browser = "Internet Explorer";
          elseif (strpos($user_agent, "Safari") !== false) $browser = "Safari";
          else $browser = "Неизвестный";
          $_SESSION['ip']=$ip;
          $_SESSION['browser']=$browser;
		  //Обнуление куки 
		setcookie('login', '',time()-60*60*24*30, "/");
         setcookie('id', '',time()-60*60*24*30,"/");
		 setcookie('isGroup','', time()+60*60*24*30, "/");
		 setcookie('id1C','', time()+60*60*24*30,"/");
      if (empty($_SESSION['login']) or empty($_SESSION['id']) or empty($_SESSION['id1C']))     
          {     
            if (isset($_COOKIE['login'])) 
          {
            $_SESSION['login']=$_COOKIE['login'];
            $_SESSION['id']=$_COOKIE['id'];
			$_SESSION['id1C']=$_COOKIE['id1C'];
            $_SESSION['isGroup']=$_COOKIE['isGroup'];
            echo "Вы вошли на сайт, как ".$_SESSION['login']." <a href=/sql/exit.php> Выход</a>";
          } else{       
            echo "Вы вошли на сайт, как гость<br>";
          }        
          }
          
          else     
          { 
          echo "Вы вошли на сайт, как ".$_SESSION['login']." <a href=/sql/exit.php> Выход</a>";
      } ?>
      </div>
    </header>
    <nav>
      <ul class="top-menu">
        <li class="active"><a>ГЛАВНАЯ</a></li>
        <li><a href="/lk/marshrut">ЛИЧНЫЙ КАБИНЕТ</a></li>  
      </ul>
    </nav>
    <div id="heading">
      <h1>Главная страница</h1>
    </div>
    <aside>

    </aside>
    <section class="mainpage">
    
      <?php
      // Если не авторизован, то выводим поле авторизации, иначе дальше

if (empty($_SESSION['login']) or empty($_SESSION['id']) or empty($_SESSION['id1C']))     
          {  

           include './sql/login.php'; 
         
          }     
          else     
          {     
      //Вопрос про телефон+
      $result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db); 
      $myrow = mysql_fetch_array($result);
      $telephone = $myrow['telephone'];
      $telephoneConfirmed = $myrow['telephoneConfirmed'];
      if ($telephoneConfirmed==0){
      if (empty($_GET['telConfirm'])) {   
      print "<script type='text/javascript'>
      smoke.confirm ('Подтвердите, корректно ли указан Ваш номер телефона ".$telephone." ?', function (result) { 
if (result === true) {curPage=window.location.href; window.location.href = curPage+\"?telConfirm=1\";  return;  }                                               
smoke.prompt ('Введите корректный номер', function (NewTelephone) {
if (NewTelephone === false) return;                                                  
smoke.confirm ('Подтвердите, корректно ли Вы указали Ваш номер: '+NewTelephone+' ? Эта информация будет отправлена в отдел КРО, в течении дня с Вами свяжется сотрудник для подтверждения корректировки номера', function (NewTelephoneConfirm) {
    if (NewTelephoneConfirm === true) {curPage=window.location.href; window.location.href = curPage+\"?telConfirm=1&NewTelephone=\"+NewTelephone;  return;  }
})
})
})
      </script>   ";} 
      else 
      {
         // echo "Телефон подтвержден. <br> <br>";
         $result = mysql_query ("UPDATE users SET telephoneConfirmed =1 WHERE (id1C = ".$_SESSION['id1C'].")"); 
         if (empty($_GET['NewTelephone'])) {} else {
          //Отправка почты
          include ("./sql/smtp-func.php");
$mail_to = 'kredit@agrofart.ru'; //куда должно будет прийти письмо.
//$mail_to = 'dmazharcev@agrofart.ru'; //вам потребуется указать здесь Ваш настоящий почтовый ящик, куда должно будет прийти письмо.
$type = 'plain'; //Можно поменять на html; plain означяет: будет присылаться чистый текст.
$charset = 'utf-8';
   $message = "Запрос от ТП (".$_SESSION['login'].") на изменение номера телефона с ".$telephone." на ".$_GET['NewTelephone'].", необходимо связаться с Агентом для подтверждения информации";
   $subject = 'Запрос с Web-портала';
   $mail_from = 'hosting@agrofart.ru';
   $replyto = 'hosting@agrofart.ru';
   $headers = "To: \"Administrator\" <$mail_to>\r\n".
              "From: \"$replyto\" <$mail_from>\r\n".
              "Reply-To: $replyto\r\n".
              "Content-Type: text/$type; charset=\"$charset\"\r\n";
   $sended = smtpmail($mail_to, $subject, $message, $headers);
   if (!$sended) echo "<script>alert(\"Письмо не удалось отправить. Пожалуйста свяжитесь с администратором сайта\");</script>"; 
   else echo "<script>alert(\"Письмо было успешно отправлено. В ближайшее время Вы получите ответ на него.\");</script>";
         }
      } 
      }
      //echo "Вопрос про телефон задали ".$telephone;
      
         //echo "Проверка авторизации пройдена. <br>  <br>"; 
          echo "Коллеги!<br>  
<br>
Вашему вниманию предлагаем два информационных канала в Telegram:<br>
<br>
1.  <a href='https://t.me/joinchat/GYtx4aSpEAYyY2Ji' target='_blank'>Канал для отдела продаж АГРОФАРТ</a>.<br>
                В данном канале будет размещаться оперативная информация для отделов продаж Компании, такие, как: изменения режима работы, политик компании для структуры продаж, прочая важная и оперативная информация, новые бизнес-процессы и изменения в личном кабинете, и т.д.
                Информация направлена на улучшение коммуникаций, их оперативности, а также на все, что способствует удобству работы и вашей эффективности.<br>
               <img src='images/SalesTeamAGROFART.jpeg' alt='SalesTeamAGROFART'><br><br>
2.  <a href='https://t.me/AGROFART' target='_blank'>Информационный канал АГРОФАРТ</a><br>
                Новости компании АГРОФАРТ.<br>
<img src='images/AGROFART-Focus.jpeg' alt='AGROFART-Focus'><br><br>
";           

          } 

?>
<script type='text/javascript'>
//alert(1);
//if (telConfirm === 1) {  document.write("$result = mysql_query ('UPDATE users SET telephoneConfirmed =1 WHERE (id = ".$_SESSION['id'].")');"); alert( 'false!' ); } else {alert( 'true!' );}
 </script>   
 
    </section>
  </div>
  <footer>
    <div id="footer">
      <div id="footer-logo">
        <a href="/"><img src="images/footer-logo.png" alt="Whitesquare logo"></a>
        <p>Copyright &copy; 2017 Agrofart </p>
      </div>
 
    </div>
  </footer>    
</body>