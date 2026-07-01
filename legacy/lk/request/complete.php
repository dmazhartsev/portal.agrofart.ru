<?php 
include ("../../sql/bd.php");
if (isset($_POST['KodKA'])) { $KodKA=$_POST['KodKA']; if ($KodKA =='') { unset($KodKA);} }
if (isset($_POST['id'])) { $id = $_POST['id'];  if ($id == '') { unset($id);} } 
if (isset($_POST['exp'])) { $exp = $_POST['exp'];  if ($exp == '') { unset($exp);} } 
if (isset($_POST['login'])) { $login = $_POST['login'];  if ($login == '') { unset($login);} } 
if (isset($_POST['NomDoc'])) { $NomDoc = $_POST['NomDoc'];  if ($NomDoc == '') { unset($NomDoc);} } 
?>
<head>
    <meta charset="utf-8">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Несоответствие цен</title>
    <link rel="shortcut icon" href="../../images/af.png" type="image/png">
    <link rel="stylesheet" href="../../css/styles.css" type="text/css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<div id="wrapper">
    <table style='width:100%;height:100%;border-width: 0;'>
    <tr>
    <td style='padding: 20px'>
    <div class='authform' style='text-align: right;background-color:#e1e5ec;font-family:sans-serif;'>
        <?php                                                             
            echo"<h3 style='text-align: center'>Введите коментарий о несоответствии ".$NomDoc."</h3>";                        
            echo("<div style='width: 100%;'>
                <div style='display: inline-block;width:90%;'>
                        <form action='/lk/request/' method='post'> 
                        <input name='NomDoc' type='text' hidden='true' value=".$NomDoc." >");
                      if(empty($_POST['KodKA'])) {
							echo "<input name='KodKA' type='text' hidden='true' value=''>";
						}else{  
							$KodKA = $_POST['KodKA'];
							echo "<input name='KodKA' type='text' hidden='true' value='".$KodKA."'>";
						};
						if (empty($_POST['exp'])) {
						  echo "<input name='KodKA' type='text' hidden='true' value='ВсеЗадания'>";
						} else {
						  $exp = $_POST['exp'];
						  echo "<input name='exp' type='text' hidden='true' value='".$exp."'>";
						};
						if (empty($_POST['login'])) {
						  $proekt = $_SESSION['id1C'];
						   echo "<input name='login' type='text' hidden='true' value='".$proekt."'>";
						} else {
						  $proekt = $_POST['login'];
						   echo "<input name='login' type='text' hidden='true' value='".$proekt."'>";
						};
						echo"<input name='CheckCen' type='text' hidden='true' value='No'>";					
        ?>
                    <p>
                        <label>Текст комментария:</label>
                        <input name="Komment" type="text" required style='width:80%' maxlength="500" value="">
                    </p>
                    <input type="submit" name="submit" value="ОК">
                </form>
				
           
    </div>
	 <div style='display: inline-block;'>        
                <form action='/lk/request/'>  
				  <?php
				    if(empty($_POST['KodKA'])) {
						echo "<input name='KodKA' type='text' hidden='true' value=''>";
					}else{  
						$KodKA = $_POST['KodKA'];
						echo "<input name='KodKA' type='text' hidden='true' value='".$KodKA."'>";
					};
					if (empty($_POST['exp'])) {
					  echo "<input name='KodKA' type='text' hidden='true' value='ВсеЗадания'>";
					} else {
					  $exp = $_POST['exp'];
					  echo "<input name='exp' type='text' hidden='true' value='".$exp."'>";
					};
					if (empty($_POST['login'])) {
					  $proekt = $_SESSION['id1C'];
					   echo "<input name='login' type='text' hidden='true' value='".$proekt."'>";
					} else {
					  $proekt = $_POST['login'];
					   echo "<input name='login' type='text' hidden='true' value='".$proekt."'>";
					};
				  ?>
                  <button type="submit">Отмена</button>
              </form>
            </div>
    </table>
</div>
</body>
