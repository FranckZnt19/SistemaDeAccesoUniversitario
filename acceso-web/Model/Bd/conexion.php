<?php 
	$hostname='localhost';
	$username='root';
	$password='1234';
	$database='seqcon';
	$mysqli=new mysqli($hostname,$username,$password,$database);
	if ($mysqli-> connect_errno)
	 { 
	 	die("fallo la conexion a Mysqli:(".$mysqli->mysqli_connect_errno().")".$mysqli->mysqli_connect_error());
	 } 
 ?>