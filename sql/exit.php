<?php     
         session_start(); 
      unset($_SESSION['login']);     
         unset($_SESSION['id']); 
		 unset($_SESSION['id1C']);
         setcookie('login', '',time()-60*60*24*30, "/");
         setcookie('id', '',time()-60*60*24*30,"/");
		 setcookie('isGroup','', time()+60*60*24*30, "/");
		 setcookie('id1C','', time()+60*60*24*30,"/");  
      exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/'></head></html>"); 
          ?>