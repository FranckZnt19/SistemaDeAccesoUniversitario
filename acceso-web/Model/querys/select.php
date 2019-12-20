<?php 
require_once '../Model/Bd/conexion.php';
	$query = 'SELECT * FROM cat_room  WHERE boolEstR=1;';
  	$result = mysqli_query($mysqli,$query);