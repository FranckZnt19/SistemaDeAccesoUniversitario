<?php 
//require_once ('../Model/Bd/conexion.php');
$mysqli=mysqli_connect("localhost","root","","seqcon");
$query = "SELECT * FROM cat_newcard;";
$resultado= mysqli_query($mysqli,$query);
?>
<table class="table table-bordered" id="nuevo1" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>UID</th>
        </tr>
    </thead>
    <tbody>
<?php
while($row = mysqli_fetch_array($resultado))  
{  
   ?>	
   		<tr>
   			<td><?php echo $row["intUidCard"]; ?></td>
   		</tr>
    <?php 
}
mysqli_free_result($resultado);
mysqli_close($mysqli);
?>
	</tbody>
	<tfoot>
	    <tr>                  
	        <th>UID</th>
	    </tr>
	</tfoot>
</table>
 