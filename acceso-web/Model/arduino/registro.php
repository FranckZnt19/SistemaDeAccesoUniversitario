<?php

	$GLOBALS['intCountUid'] = 0;
	$hostname='localhost';
	$username='root';
	$password='1234';
	$database='seqcon';
	$mysqli=new mysqli($hostname,$username,$password,$database);

	if ($mysqli-> connect_errno)
	{
	 	die("fallo la conexion a Mysqli:(".$mysqli->mysqli_connect_errno().")".$mysqli->mysqli_connect_error());
	}

	$qry="SELECT COUNT(intUidCard) AS TOTAL FROM `cat_newcard`;";
	$result = $mysqli->query($qry);
	if ($result->num_rows>0) {
		while ($file = $result->fetch_assoc()) {
			$intCountUid=$file['TOTAL'];
		}
	}else{
		echo "Error 1";
	}

	//echo $intCountUid;

	if ($intCountUid>=1) {
			echo "Capturas pendientes";
		}else{
			$add = "INSERT INTO cat_newcard values (DEFAULT,$_POST[user]);";
			//$add = "INSERT INTO cat_newcard values (DEFAULT,12345);";
			if ($mysqli->query($add)===TRUE) {
	    		echo "Registrado";
			} else {
			    echo "Error2";
			}
		}
 ?>