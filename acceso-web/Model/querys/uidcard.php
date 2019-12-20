<?php 
require_once '../Bd/conexion.php';
$eUID=$_POST['eUID'];
$opc=$_POST['opc'];
$informacion=[];

switch ($opc) {
	case 'Agregar':
		if( $_POST['tName'] != "" && $_POST['tApellido'] != "" && $_POST['eNC'] != "" && $eUID != "" ){
				$tName=$_POST['tName'];
				$tApellido=$_POST['tApellido'];
				$eNC=$_POST['eNC'];
				$existe = Existe_usr($eUID,$eNC,$mysqli);
				if ($existe>0) {
					$informacion["respuesta"]="EXISTE";
					echo json_encode($informacion);
				}else{
					$eliminar=Eliminar_ag($eUID,$mysqli);
					if ($eliminar>0) {
						Agregar($eUID,$tName,$tApellido,$eNC,$mysqli);
					}else{
						$informacion["respuesta"]="ERRROR";
						echo json_encode($informacion);
					}
				}			
		}else{
			$informacion["respuesta"] = "VACIO";
			echo json_encode($informacion);
		}
		break;
	case 'Eliminar':
		Eliminar($eUID,$mysqli);
		break;
	default:
		$informacion["respuesta"] = "OPCION_VACIA";
		echo json_encode($informacion);
		break;
}
function Existe_usr($eUID,$eNC,$mysqli){
	$query="SELECT * FROM `cat_uidusers` WHERE intfkUidUser=$eUID OR intNumConUser=$eNC;";
	$resultado= mysqli_query($mysqli,$query);
	$existe_usr=mysqli_num_rows($resultado);
	return $existe_usr;
}
function Agregar($eUID,$tName,$tApellido,$eNC,$mysqli)
{
	$query="INSERT INTO `cat_uidusers` VALUES (DEFAULT,'$tName','$tApellido',$eNC,$eUID,0,1);";
	$resultado= mysqli_query($mysqli,$query);
	Verificar($resultado);
	Cerrar($mysqli);
}

function Eliminar_ag($eUID,$mysqli)
{
	$query="DELETE FROM `cat_newcard` WHERE intUidCard=$eUID;";
	$resultado= mysqli_query($mysqli,$query);
	$eliminar_ag=mysqli_affected_rows($mysqli);
	return $eliminar_ag;
}
function Eliminar($eUID,$mysqli)
{
	$query="DELETE FROM `cat_newcard` WHERE intUidCard=$eUID;";
	$resultado= mysqli_query($mysqli,$query);
	Verificar($resultado);
	Cerrar($mysqli);
}
function Verificar($resultado){
	if (!$resultado) {
		$informacion["respuesta"]="ERRROR";
	}else {
		$informacion["respuesta"]="BIEN";
	}
	echo json_encode($informacion);
}
function Cerrar($mysqli){
	mysqli_close($mysqli);
}
 ?>
