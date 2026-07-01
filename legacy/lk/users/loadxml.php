<?php    
header ("Content-Type: text/html; charset=utf-8");
include ("../../sql/bd.php");

$xmlURL = "../../xml/Users.xml";

$sxml = simplexml_load_file($xmlURL);
$query = "DELETE FROM users  where (login<>'Admin')";
mysql_query($query) or die(mysql_error());

foreach($sxml->user as $user) {

  $id = stripslashes($user->attributes()['id']);
  $Name = stripslashes($user->attributes()['Name']);
  $id1C = stripslashes($user->attributes()['id1C']);
  $id1C1 = stripslashes($user->attributes()['id1C1']);
  $id1C2 = stripslashes($user->attributes()['id1C2']);
  $Podrazdelenie = stripslashes($user->attributes()['Podrazdelenie']);
  $Napravlenie = stripslashes($user->attributes()['Napravlenie']);
  $email = stripslashes($user->attributes()['email']);
  $password = stripslashes($user->attributes()['password']);
  $isGroup = stripslashes($user->attributes()['isGroup']);
  $KanalSbyta = stripslashes($user->attributes()['KanalSbyta']);
   $telephone = stripslashes($user->attributes()['telephone']);
$Super = stripslashes($user->attributes()['Super']);


  $query = mysql_query("SELECT COUNT(*) FROM users WHERE id1C='$id1C'") or die(mysql_error());
  $user = mysql_fetch_row($query);
  $total = $user[0];

  if ("$total" == 0) {
    $sql = ("INSERT INTO users (login, id, Super, password, isGroup, email, id1C, Podrazdelenie, Napravlenie, KanalSbyta, telephone, id1C1, id1C2) VALUES('$Name','$id', '$Super', '$password', '$isGroup', '$email', '$id1C', '$Podrazdelenie', '$Napravlenie', '$KanalSbyta', '$telephone', '$id1C1', '$id1C2')");
    $result = mysql_query($sql) or die("Error ".mysql_error());
    //echo $Name.' - добавлен!<br>';
  } else {
    $result = mysql_query ("UPDATE users SET password ='$password' WHERE (id1C = '$id1C')");
    $result = mysql_query ("UPDATE users SET email ='$email' WHERE (id1C = '$id1C')");
    $result = mysql_query ("UPDATE users SET id ='$id' WHERE (id1C = '$id1C')");
    $result = mysql_query ("UPDATE users SET KanalSbyta ='$KanalSbyta' WHERE (id1C = '$id1C')");
    $result = mysql_query ("UPDATE users SET telephone ='$telephone' WHERE (id1C = '$id1C')");
    $result = mysql_query ("UPDATE users SET telephoneConfirmed = 0 WHERE (id1C = '$id1C')");
	$result = mysql_query ("UPDATE users SET id1C1 = '$id1C1' WHERE (id1C = '$id1C')");
	$result = mysql_query ("UPDATE users SET id1C2 = '$id1C2' WHERE (id1C = '$id1C')");
  }
}


$strSQL = "SELECT * FROM users where (login<>'Admin')";
$rs = mysql_query($strSQL);
while($row = mysql_fetch_array($rs)) {
  $finder = 0;
  foreach($sxml->user as $user) {
    $id1C = stripslashes($user->attributes()['id1C']);
    if ($row['id1C']==$id1C)
    {
     $finder=$finder+1; 
    }
}
  if ($finder==0) {
    echo $row['login']." не найден в загружаемом файле и подлежит удалению из базы<br>";
    $id1C = $row['id1C'];
    $query = "DELETE FROM users WHERE (id1C = '$id1C')";
    mysql_query($query) or die(mysql_error());
  }
}

exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='1; URL=/lk/users'></head></html>");