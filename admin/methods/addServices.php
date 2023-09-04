<?php 

include_once('..\..\required/server.php');
 
	$landmarkID   = $_POST['landmarkID'];
	$services	  = $_POST['services'];

	$query = "INSERT INTO services (landmarkID , serviceName)  
			  VALUES ('$landmarkID', '$services')";
			 
	mysqli_query($db, $query);
   	
?>
