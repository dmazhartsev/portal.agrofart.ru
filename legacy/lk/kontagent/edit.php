<html>
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>КОНТРАГЕНТЫ</title>
    <link rel="shortcut icon" href="../../images/af.png" type="image/png">
    <link rel="stylesheet" href="../../css/styles.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div id="wrapper" > 
        <table style='width:100%;height:100%;' border="0">
            <tr>
                <td style='padding: 20px'>
                    <div style='text-align: right;background-color:#e1e5ec;font-family:sans-serif;'>
                        <h3 style='text-align: center'>Редактирование контрагента</h3>
                        <div style='width: 100%;'>
                            <div style='width:90%;display: inline-block;'>
								<?php
								$PageInner = $_POST['PageInner'];
                                echo "<form action='/lk/".$PageInner."/' method='post'>";
								echo"<input name='SaveChangesKontragents' type='text' hidden='true' value='Yes'>";
								if(isset($_POST['login'])){
									echo"<input name='login' type='text' hidden='true' value='".$_POST['login']."'>";	
								};
								if(isset($_POST['exp'])){
									echo"<input name='exp' type='text' hidden='true' value='".$_POST['exp']."'>";	
								};
								?>
                                    <input name='KodKA' type='text' hidden='true' value=<?php echo $_POST['KodKA'] ?>>
									<input name='PageInner' type='text' hidden='true' value=<?php echo $_POST['PageInner'] ?>>
                                    <?php 									
                                    include ("../../sql/bd.php"); 
                                    $result = mysql_query("SELECT * FROM kontragents WHERE KodKA=".$_POST['KodKA'],$db);     
                                    $myrow = mysql_fetch_array($result);
                                    $cbo_sel = 'SELECTED="SELECTED"';
                                    ?>
                                    <p>
                                        <label>Наименование:</label>
                                        <input name="Name" type="text" required maxlength="100" style='width:60%' value=<?php echo "'".$myrow['name']."'" ?>>
                                    </p>
                                    <!--**** В текстовое поле пользователь вводит  ***** -->
                                    <p>
                                        <label>ИНН:</label>
                                        <input name="INN" type="text" required style='width:60%' maxlength="100" value=<?php echo "'".$myrow['inn']."'" ?>>
                                    </p>
                                    <!--**** В поле  пользователь вводит  ***** -->          
                                    <p>     
                                      <label>ДеньДЗ:</label>     
                                      <select  type="login" name="DayDZ" style='width:60%' >
                                         <option value="1" <?php echo ($myrow['DayDZ']=='0')?$cbo_sel:''; ?>>Не выбрано</option>
                                         <option value="1" <?php echo ($myrow['DayDZ']=='1')?$cbo_sel:''; ?>>Понедельник</option>
                                         <option value="2" <?php echo ($myrow['DayDZ']=='2')?$cbo_sel:''; ?>>Вторник</option>
                                         <option value="3" <?php echo ($myrow['DayDZ']=='3')?$cbo_sel:''; ?>>Среда</option>
                                         <option value="4" <?php echo ($myrow['DayDZ']=='4')?$cbo_sel:''; ?>>Четверг</option>
                                         <option value="5" <?php echo ($myrow['DayDZ']=='5')?$cbo_sel:''; ?>>Пятница</option>
                                         <option value="6" <?php echo ($myrow['DayDZ']=='6')?$cbo_sel:''; ?>>Суббота</option>
                                         <option value="7" <?php echo ($myrow['DayDZ']=='7')?$cbo_sel:''; ?>>Воскресенье</option>
                                     </select> 
                                 </p>    
                                 <!--**** В поле  пользователь вводит  ***** --> 
                                 <p>
                                    <label>Email руководителя:</label>
                                    <input name="EmailDirector" type="text"  style='width:60%' maxlength="100" value=<?php echo "'".$myrow['EmailDirector']."'" ?>>
                                </p>
                                <!--**** В поле  пользователь вводит  ***** --> 
                                <p>
                                    <label>Телефон руководителя:</label>
                                    <input name="PhoneDirector" type="text"  style='width:60%' maxlength="100" value=<?php echo "'".$myrow['PhoneDirector']."'" ?>>
                                </p>
                                <!--**** В поле  пользователь вводит  ***** -->  
                                <p>
                                    <label>Email по оплатам:</label>
                                    <input name="EmailOtvet" type="text"  style='width:60%' maxlength="100" value=<?php echo "'".$myrow['EmailOtvet']."'" ?>>
                                </p>
                                <!--**** В поле  пользователь вводит  ***** -->  
                                <p>
                                    <label>Телефон по оплатам:</label>
                                    <input name="PhoneOtvet" type="text"  style='width:60%' maxlength="100" value=<?php echo "'".$myrow['PhoneOtvet']."'" ?>>
                                </p>
								<p>
                                    <label>Email Декларация Алко:</label>
                                    <input name="EmailDeclaration" type="text"  style='width:60%' maxlength="100" value=<?php echo "'".$myrow['EmailDeclaration']."'" ?>>
                                </p>
                                <!--**** В поле  пользователь вводит  ***** -->  
                                <p>
                                    <label>Телефон Декларация Алко:</label>
                                    <input name="PhoneDeclaration" type="text"  style='width:60%' maxlength="100" value=<?php echo "'".$myrow['PhoneDeclaration']."'" ?>>
                                </p>
                                <!--**** В поле  пользователь вводит  ***** -->  
                                <input type="submit" name="submit" value="Сохранить">
                                <!--**** Кнопочка (type="submit") отправляет данные на страничку save_changes.php ***** --> 
                            </form>
                        </div>
                        <div style='display: inline-block;'>
                           <?php 
						   echo "<form action='/lk/".$PageInner."/' method='post'>"; 
						   echo"<input name='SaveChangesKontragents' type='text' hidden='true' value='No'>";
						  if(isset($_POST['login'])){
								echo"<input name='login' type='text' hidden='true' value=".$_POST['login'].">";	
						  };
						  if(isset($_POST['exp'])){
								echo"<input name='exp' type='text' hidden='true' value='".$_POST['exp']."'>";	
						  };
						   ?>
                              <button type="submit">Отмена</button>
                          </form>
                      </div>
                  </div>

              </table>
          </div>
      </body>
      </html>