<?php 
require_once '../Bd/conexion.php';
$query = "SELECT historyopen.intid_Open, cat_room.strNameRoom, cat_uidusers.strNameUser,cat_uidusers.strLastNameUser,cat_uidusers.intNumConUser, historyopen.dtm_DaTi FROM historyopen 
INNER JOIN access ON access.intid_Access=historyopen.intfk_Access 
INNER JOIN cat_room ON cat_room.intid_Room=access.intfk_Room
INNER JOIN cat_uidusers ON cat_uidusers.intid_UidUser=access.intfk_UidUsers;";
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