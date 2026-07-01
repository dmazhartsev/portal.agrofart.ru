<?php     
session_start();     
include ("../../sql/bd.php");
$result = mysql_query("SELECT * FROM users WHERE id1C=".$_SESSION['id1C'],$db); 
$myrow = mysql_fetch_array($result);
$proekt = $myrow['id1C'];   
$Super = $myrow['Super'];  
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Редактирование</title>
    <link rel="shortcut icon" href="../../images/af.png" type="image/png">
    <link rel="stylesheet" href="../../css/styles.css" type="text/css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script>
        function agreeForm(f) {
            if (f.agree.checked) f.submit.disabled = 0 
                else f.submit.disabled = 1
        }
    </script>
</head>
<body style='text-align: center'>
   <div id="wrapper"> 
       <table style='width:100%;height:100%;' border="0">
        
        <tr>
            <td style='padding: 20px'>
                <div style='text-align: right;background-color:#e1e5ec;font-family:sans-serif;'>
                    <h3 style='text-align: center'>Редактирование комментария</h3>
                    <div style='width: 100%;'>
                        <div style='width:90%;display: inline-block;'>
                            <form action="save_changes.php" method="post">
                                <input name='id' type='text' hidden='true' value=<?php echo $_POST['id'] ?>>
                                <?php 
                                include ("../../sql/bd.php"); 
                                $result = mysql_query("SELECT * FROM dolg WHERE id=".$_POST['id'],$db);     
                                $myrow = mysql_fetch_array($result);
                                $cbo_sel = 'SELECTED="SELECTED"';
                                ?>
                                <!--**** save_changes.php - это адрес обработчика.  ***** -->
                                <p style='text-align: center'>
                                    <label >Контрагент: <?php echo "".$myrow['Kontragent']."" ?></label>
                                </p>
                                <!--**** В текстовое поле пользователь вводит  ***** -->
                                <p>
                                    <label>Реализация:</label>
                                    <input name="Name" type="text"  maxlength="100" style='width:60%' value=<?php echo "'".$myrow['Name']."'" ?>>
                                </p> 
                                <!--**** В поле  пользователь вводит  ***** --> 
                                <p>
                                    <label>Комментарий:</label>
                                    <input name="PenniText" type="text"  style='width:60%' maxlength="300" value=<?php echo "'".$myrow['PenniText']."'"?> <?php if ($Super==1){echo "readonly"; } ?>>
                                </p>
                                <!--**** В поле  пользователь вводит  ***** --> 
                                <p>
                                    <label>Коммент супер:</label>
                                    <input name="PenniTextSuper" type="text"  style='width:60%' maxlength="300" value=<?php echo "'".$myrow['PenniTextSuper']."'"?> <?php if ($Super==0){echo "readonly"; } ?>>
                                </p>
                                <!--**** В поле  пользователь вводит  ***** -->  
                                <p>
                                    <label>Срок погашения:</label>
                                    <input name="PenniDate" type="date"  style='width:60%' value=<?php echo "'".$myrow['PenniDate']."'" ?>>
                                </p>
                                <!--**** В поле  пользователь вводит  ***** -->  
                                <p>
                                    <input type="submit" name="submit" value="Сохранить">
                                    <!--**** Кнопочка (type="submit") отправляет данные на страничку  ***** --> 
                                </p>
                            </form>
                        </div>
                        
                        <div style='display: inline-block;'>
                            <form action="/lk/penni/">
                              <button type="submit">Отмена</button>
                          </form>
                      </div>
                  </div>
              </table>
          </div>
      </body>
      </html>