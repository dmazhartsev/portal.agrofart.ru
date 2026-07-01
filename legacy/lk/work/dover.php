<?php
	header ("Content-Type: text/html; charset=utf-8");
	session_start(); 
	include ("../../sql/bd.php");

    $NomDoc = $_POST['NomDoc'];
	$DocDate = $_POST['DocDate'];
	$Sum = $_POST['Sum'];
	$Proekt = $_SESSION['id1C'];
	$date_today = date("d.m.y");
	
	if (empty($NomDoc))
	{     
		exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/work'></head></html>"); 
	}; 
 
	$sql = ("INSERT INTO Dover (NomDoc, DateDoc, Sum, LoadedTo1C, LogDate, Proekt) VALUES ('$NomDoc','$DocDate', '$Sum', 0, '$date_today', '$Proekt')");
	$result = mysql_query($sql) or die("Error ".mysql_error());

    exit("<html><head><title>Загрузка..</title><meta http-equiv='Refresh' content='0; URL=/lk/work'></head></html>");
?>