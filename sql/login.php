<?php     
          //  вся процедура работает на сессиях. Именно в ней хранятся данные  пользователя, пока он находится на сайте. Очень важно запустить их в  самом начале странички!!!     
          session_start();  
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

     $isGroup = $_POST['options'];
     include 'prelogin.php';


     //echo "<h3>В переменной isGroup: ".$isGroup."</h3>";

          ?>     
             
               
          <form action="/sql/testreg.php" method="post">     

              
       <p>     
          <label>Пользователь:<br></label>     
               <select type="login" name="login" id="combobox">
               <?php 
               include ("./sql/bd.php"); 
               $strSQL = "SELECT * FROM users WHERE isGroup='".$isGroup."' ORDER BY id1C";
               $rs = mysql_query($strSQL) or die('Error, insert query failed');
                while($row = mysql_fetch_array($rs)) {
                echo "<option value='".$row['login']."''>".$row['id1C'].":".$row['login']."</option>";
               } 
               ?>
               </select> 
          </p>     



          <!--**** В текстовое поле (name="login" type="text") пользователь вводит свой логин ***** -->     
             
          <p>     

          <label>Пароль:<br></label>     
          <input name="password" type="password" size="15" maxlength="15">     
          </p>     

          <!--**** В поле для паролей (name="password" type="password") пользователь вводит свой пароль ***** -->       
          <?php 
               if (isset($_SESSION['errors']) && $_SESSION['errors']>=2){
               
                    echo "<label>Символы с изображения:<br></label>  
                    <input type='text' name='keystring'>
                    <p> 
                    <img src='/kcaptcha/'>          
                     </p>"; } 
           ?>
           

          <p>     
            
          <input type="submit" name="submit" value="Войти"> 
          <!--input type="button" value="Проверка выбора" onClick="dataSelect(this.form)"-->   

          <!--**** Кнопочка (type="submit") отправляет данные на страничку testreg.php ***** -->       
          <label>
          <?php 
               //echo "Неверных вводов:".$_SESSION['errors'];
               echo $_SESSION['error'];
           ?>
          </label>
            
          </p></form>     
          <br>     
