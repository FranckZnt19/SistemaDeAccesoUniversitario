<?php  
require_once '../Bd/conexion.php';
$opc=$_POST['opc'];
$informacion=[];

switch ($opc) {
	case 'Editar':
		if( $_POST['tName'] != "" && $_POST['tApellido'] != "" && $_POST['eNC'] != "" && $_POST['intID'] != "" ){
				$tName=$_POST['tName'];
				$tApellido=$_POST['tApellido'];
				$eNC=$_POST['eNC'];
				$intID=$_POST['intID'];
				Updat($intID,$tName,$tApellido,$eNC,$mysqli);			
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
function Existe_usr($eNC,$mysqli){
	$query="SELECT * FROM `cat_uidusers` WHERE intNumConUser=$eNC;";
	$resultado= mysqli_query($mysqli,$query);
	$existe_usr=mysqli_num_rows($resultado);
	return $existe_usr;
}

function Updat($intID,$tName,$tApellido,$eNC,$mysqli){
	$query="UPDATE cat_uidusers SET strNameUser='$tName',strLastNameUser='$tApellido',intNumConUser=$eNC WHERE intid_UidUser=$intID;";
	$resultado= mysqli_query($mysqli,$query);
	Verificar($resultado);
	Cerrar($mysqli);
}

function Abrir($intID,$mysqli)
{
	$query="UPDATE cat_uidusers SET boolEstUser=1 WHERE intid_UidUser=$intID;";
	$resultado= mysqli_query($mysqli,$query);
	Verificar($resultado);
	Cerrar($mysqli);
}
function Cierra($intID,$mysqli)
{
	$query="UPDATE cat_uidusers SET boolEstUser=0 WHERE intid_UidUser=$intID;";
	$resultado= mysqli_query($mysqli,$query);
	Verificar($resultado);
	Cerrar($mysqli);
}
function Eliminar($intID,$mysqli)
{
	$query="UPDATE cat_uidusers SET boolEstUs=0 WHERE intid_UidUser=$intID;";
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