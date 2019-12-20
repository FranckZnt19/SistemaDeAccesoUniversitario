<?php  
require_once '../Bd/conexion.php';
$opc=$_POST['opc'];
$informacion=[];

switch ($opc) {
	case 'Agregar':
		if( $_POST['nc'] != "" && $_POST['room'] != ""){
				$nc=$_POST['nc'];
				$room=$_POST['room'];
				$output="";

				$query="SELECT * FROM `cat_uidusers` WHERE intNumConUser=$nc AND boolEstUs=1;";
				$resultado= mysqli_query($mysqli,$query);
				if ($resultado->num_rows>0) {
			        while ($file = $resultado->fetch_assoc()) {
			            $output=$file['intid_UidUser'];
			        }
			    }else{
			        $output="";
			    }

			    Ag($output,$room,$mysqli);		
		}else{
			$informacion["respuesta"] = "VACIO";
			echo json_encode($informacion);
		}
		break;
	default:
		$informacion["respuesta"] = "OPCION_VACIA";
		echo json_encode($informacion);
		break;
}

function Ag($output,$room,$mysqli)
{
	$query="INSERT INTO `access`(`intid_Access`, `intfk_Room`, `intfk_UidUsers`, `EstAccess`, `EstAs`) VALUES (default,$room,$output,0,1);";
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