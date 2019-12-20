<?php 
require_once '../Bd/conexion.php';
$query = "SELECT intid_Access, intfk_Room, strNameRoom, intfk_UidUsers, cat_uidusers.strLastNameUser, strNameUser, intNumConUser, EstAccess,EstAs FROM access INNER JOIN cat_room ON cat_room.intid_Room=access.intfk_Room INNER JOIN cat_uidusers ON cat_uidusers.intid_UidUser=access.intfk_UidUsers WHERE EstAs=1;";
$resultado= mysqli_query($mysqli,$query);
if (!$resultado) {
	die("ERROR!");
}else{
	$arreglo["data"] = [];
	while ($dato=mysqli_fetch_assoc($resultado)) {
		$arreglo["data"][]= array_map("utf8_encode",$dato);
	}
	echo json_encode($arreglo);
}
mysqli_free_result($resultado);
mysqli_close($mysqli);
 ?>