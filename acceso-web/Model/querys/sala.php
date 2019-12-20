<?php  
require_once '../Bd/conexion.php';
$opc=$_POST['opc'];
$informacion=[];

switch ($opc) {
	case 'Agregar':
		if( $_POST['tName'] != ""){
				$tName=$_POST['tName'];
				$existe = Existe_room($tName,$mysqli);
				if ($existe>0) {
					$informacion["respuesta"]="EXISTE";
					echo json_encode($informacion);
				}else{
						Agregar($tName,$mysqli);
				}			
		}else{
			$informacion["respuesta"] = "VACIO";
			echo json_encode($informacion);
		}
		break;
	case 'Editar':
		if( $_POST['tName'] != ""){
				$tName=$_POST['tName'];
				$intID=$_POST['intID'];
				$existe = Existe_room($tName,$mysqli);
				if ($existe>0) {
					$informacion["respuesta"]="EXISTE";
					echo json_encode($informacion);
				}else{
						Updat($intID,$tName,$mysqli);
				}			
		}else{
			$informacion["respuesta"] = "VACIO";
			echo json_encode($informacion);
		}
		break;
	case 'Eliminar':
		$intID=$_POST['intID'];
		Eliminar($intID,$mysqli);
		break;
	case 'Abrir':
		$intID=$_POST['intID'];
		Abrir($intID,$mysqli);
		break;
	case 'Cerrar':
		$intID=$_POST['intID'];
		Cierra($intID,$mysqli);
		break;
	default:
		$informacion["respuesta"] = "OPCION_VACIA";
		echo json_encode($informacion);
		break;
}
function Agregar($tName,$mysqli){
	$query="INSERT INTO cat_room VALUES (DEFAULT,'$tName',0,1);";
	$resultado= mysqli_query($mysqli,$query);
	Verificar($resultado);
	Cerrar($mysqli);
	
}
function Updat($intID,$tName,$mysqli){
	$query="UPDATE cat_room SET strNameRoom='$tName' WHERE intid_Room=$intID;";
	$resultado= mysqli_query($mysqli,$query);
	Verificar($resultado);
	Cerrar($mysqli);
}
function Existe_room($tName,$mysqli){
	$query="SELECT * FROM cat_room WHERE strNameRoom='$tName';";
	$resultado= mysqli_query($mysqli,$query);
	$existe_usr=mysqli_num_rows($resultado);
	return $existe_usr;
}
function Abrir($intID,$mysqli)
{
	$query="UPDATE cat_room SET boolEstRoom=1 WHERE intid_Room=$intID;";
	$resultado= mysqli_query($mysqli,$query);
	Verificar($resultado);
	Cerrar($mysqli);
}
function Cierra($intID,$mysqli)
{
	$query="UPDATE cat_room SET boolEstRoom=0 WHERE intid_Room=$intID;";
	$resultado= mysqli_query($mysqli,$query);
	Verificar($resultado);
	Cerrar($mysqli);
}
function Eliminar($intID,$mysqli)
{
	$query="UPDATE cat_room SET boolEstR=0 WHERE intid_Room=$intID;";
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