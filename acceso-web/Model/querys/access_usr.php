  <?php 
require_once '../Bd/conexion.php';
/*session_start();
if (!isset($_SESSION['ncontrol'])) {
    header('Location: ../index.php');
    exit();
}
else{
    $tipo_usr=$_SESSION['idtipo'];
    $id_usr=$_SESSION['id'];
    if ($tipo_usr == 3 || $tipo_usr == 2) 
    {
        header('Location: ../php/welcome.php');
    }
    else{}}
*/

$output = "";
$query="SELECT * FROM `cat_uidusers` WHERE intNumConUser='' and boolEstUs=1;";

    if (isset($_POST['consult'])) {
        $q = $mysqli->real_escape_string($_POST['consult']);
        //$query ="SELECT * FROM `cat_uidusers` WHERE intNumConUser LIKE '%$q%';";
        $query ="SELECT * FROM `cat_uidusers` WHERE intNumConUser=$q and boolEstUs=1;";

    }

    $result = $mysqli->query($query);

    if ($result->num_rows>0) {
        $output.="
        <div class='alert alert-success tabla_datos' role='alert'>";

        while ($file = $result->fetch_assoc()) {
            $output.="<p>".$file['strNameUser']." ".$file['strLastNameUser']."</p>";

        }
        $output.="</div>";
    }else{
        $output.="";
    }

    echo $output;
 ?>