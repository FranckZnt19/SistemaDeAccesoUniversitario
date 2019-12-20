<?php

	$GLOBALS['intCountUid'] = 0;
	$GLOBALS['dati']=date("Y-m-d H:i:s");
	$hostname='localhost';
	$username='root';
	$password='1234';
	$database='seqcon';
	$mysqli=new mysqli($hostname,$username,$password,$database);

	if ($mysqli-> connect_errno)
	{
	 	die("fallo la conexion a Mysqli:(".$mysqli->mysqli_connect_errno().")".$mysqli->mysqli_connect_error());
	}

	$qry="SELECT intid_Access FROM access INNER JOIN cat_room ON intid_Room=intfk_Room INNER JOIN cat_uidusers ON intid_UidUser=intfk_UidUsers WHERE EstAs=1 AND 
			(EstAccess=1 AND 
			    (boolEstUs=1 AND  
			    	(boolEstUser=1 AND 
			        	(boolEstRoom=1 AND 
			            	(boolEstR=1 AND 
			                    (intid_Room=1 AND 
			                    	(intfkUidUser=$_POST[user])
			                    )
			                )
			            )
			        )
			    )
			);";
	$result = $mysqli->query($qry);
	if ($result->num_rows>0) {
		while ($file = $result->fetch_assoc()) {
			$intCountUid=$file['intid_Access'];
		}

		$add = "INSERT INTO historyopen (intid_Open, intfk_Access, dtm_DaTi) VALUES (DEFAULT,$intCountUid,'$dati');";
		if ($mysqli->query($add)===TRUE) {
			echo "aprobado";
		} else {
		    echo "Error1";
		}
	}else{
		echo "Denegado";
	}
	//echo $intCountUid 157482380;
 ?>