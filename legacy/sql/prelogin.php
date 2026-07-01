
  <form action="" method="post">    
          <label>Войти на сайт как:<br></label>     
               <select type="login" name="options">
                    <option value=0  <?php if ( $isGroup == 0 ) echo 'selected="selected"'; ?>>Торговый представитель</option>
                    <option value=1  <?php if ( $isGroup == 1 ) echo 'selected="selected"'; ?>>Покупатель</option>
                    <option value=2  <?php if ( $isGroup == 2 ) echo 'selected="selected"'; ?>>Администратор</option>
                    <option value=3  <?php if ( $isGroup == 3 ) echo 'selected="selected"'; ?>>Водитель</option>
               </select> 
  <input type="submit"  value="OK"> 
                      
          </form>   

<?php
     $isGroup = $_POST['options'];
?>