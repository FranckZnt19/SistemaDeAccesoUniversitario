<?php 
require_once '../Bd/conexion.php';
$query = "SELECT * FROM cat_newcard";
$resultado= mysqli_query($mysqli,$query);
if (!$resultado) {
	die("ERROR!");
}else{
	$arreglo["data"] = [];
	while ($dato=mysqli_fetch_assoc($resultado)) {
		$arreglo["data"][]= array_map("utf8_encode",$dato);
	}
	echo json_encode($arreglo);
	//print_r($arreglo);

}
mysqli_free_result($resultado);
mysqli_close($mysqli);
 ?>