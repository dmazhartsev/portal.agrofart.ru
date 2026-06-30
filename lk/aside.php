<aside>
      <nav>
        <ul class="aside-menu">
		<?php
		session_start();
		if (empty($_SESSION['login']) or empty($_SESSION['id1C']))     
        {

		}else     
        {
			$id1C = $_SESSION['id1C'];
			$login = $_SESSION['login'];
			$ActivePageRus = $ActivePage;
		}
		
		
		if ($ActivePage=="marshrut"){
			echo "<li class='active'>МАРШРУТ</li>";
			$ActivePageRus = 'МАРШРУТ';
		}else{
			echo "<li><a href='../marshrut/'>МАРШРУТ</a></li>";
		};
		
		if ($ActivePage=="request"){
			echo "<li class='active'>ОТГРУЗКИ</li>";
			$ActivePageRus = 'ОТГРУЗКИ';
		}else{
			echo "<li><a href='../request/'>ОТГРУЗКИ</a></li>";
		};
		
		if ($ActivePage=="penni"){
			echo "<li class='active'>ПДЗ</li>";
			$ActivePageRus = 'ПДЗ';
		}else{
			echo "<li><a href='../penni/'>ПДЗ</a></li>";
		};
		
		if ($ActivePage=="zadania"){
			echo "<li class='active'>ЗАДАНИЯ</li>";
			$ActivePageRus = 'ЗАДАНИЯ';
		}else{
			echo "<li><a href='../zadania/'>ЗАДАНИЯ</a></li>";
		};
		
		if ($ActivePage=="work"){
			echo "<li class='active'>ЗАДОЛЖЕННОСТИ</li>";
			$ActivePageRus = 'ЗАДОЛЖЕННОСТИ';
		}else{
			echo "<li><a href='../work/'>ЗАДОЛЖЕННОСТИ</a></li>";
		};
		
		if ($ActivePage=="kontagent"){
			echo "<li class='active'>КОНТРАГЕНТЫ</li>";
			$ActivePageRus = 'КОНТРАГЕНТЫ';
		}else{
			echo "<li><a href='../kontagent/'>КОНТРАГЕНТЫ</a></li>";
		};
		
		/* if ($ActivePage=="info"){
			echo "<li class='active'>ИНФО</li>";
		}else{
			echo "<li><a href='../'>ИНФО</a></li>";
		}; */
		
		if ($_SESSION['login']=="Admin"){
			if ($ActivePage=="users"){
				echo "<li class='active'>СПИСОК ПОЛЬЗОВАТЕЛЕЙ</li>";
				$ActivePageRus = 'СПИСОК ПОЛЬЗОВАТЕЛЕЙ';
			}else{
				echo "<li><a href='../users/'>СПИСОК ПОЛЬЗОВАТЕЛЕЙ</a></li>";
			};		
		}
		
		if ($ActivePage=="aktsverki"){
			echo "<li class='active'>АКТЫ СВЕРКИ</li>";
			$ActivePageRus = 'АКТЫ СВЕРКИ';
		}else{
			echo "<li><a href='../aktsverki/'>АКТЫ СВЕРКИ</a></li>";
		};	
		
		if ($ActivePage=="edo"){
			echo "<li class='active'>НЕПОДТВЕРЖДЕННЫЕ ЭДО</li>";
			$ActivePageRus = 'НЕПОДТВЕРЖДЕННЫЕ ЭДО';
		}else{
			echo "<li><a href='../edo/'>НЕПОДТВЕРЖДЕННЫЕ ЭДО</a></li>";
		};	
		
		if (empty($_SESSION['login']) or empty($_SESSION['id1C']) or ($_SESSION['password']=='456321'))     
        {

		}else     
        {
			$db = mysql_connect ("localhost","root","vWwpcDWVrxR43Jzn");
			mysql_select_db ("portal",$db);
			mysql_set_charset("utf8");
			$result4 = mysql_query("INSERT INTO LogVisiting (LogDateTime,Page,Proekt,Name) VALUES(NOW(),'$ActivePageRus','$id1C','$login')",$db);
		}
		

		?>
        
     </ul>
   </nav>
   
 </aside>
 <section>