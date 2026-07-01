<div id="coords"></div>

<script language="javascript"><!--
  if (!navigator.geolocation) {
query='mes=Неизвестная ошибка'; 
document.getElementById('coords').innerHTML = '<img src="getgeo.php?' + query +' " '+'border="0" width="1" height="1" style="display: none;"/>';
}else{
navigator.geolocation.getCurrentPosition(function(position) {
  query='lat=' + position.coords.latitude.toFixed(3) + '&lng=' + position.coords.longitude.toFixed(3)+ '&acc=' + position.coords.accuracy; 
  document.getElementById('coords').innerHTML = '<img src="getgeo.php?' + query +' " '+'border="0" width="1" height="1" style="display: none;"/>';
}, function(error) {
query='mes=' + error.message+ '&code=' + error.code; 
document.getElementById('coords').innerHTML = '<img src="getgeo.php?' + query +' " '+'border="0" width="1" height="1" style="display: none;"/>';
            });
}
//--></script>