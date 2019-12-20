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
function Abrir($intID,$mysqli)
{
	$query="UPDATE access SET EstAccess=1 WHERE intid_Access=$intID;";
	$resultado= mysqli_query($mysqli,$query);
	Verificar($resultado);
	Cerrar($mysqli);
}
function Cierra($intID,$mysqli)
{
	$query="UPDATE access SET EstAccess=0 WHERE intid_Access=$intID;";
	$resultado= mysqli_query($mysqli,$query);
	Verificar($resultado);
	Cerrar($mysqli);
}
function Eliminar($intID,$mysqli)
{
	$query="UPDATE access SET EstAs=0 WHERE intid_Access=$intID;";
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