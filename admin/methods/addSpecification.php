<?php 

include_once('..\..\required/server.php');
 
	$landmarkID   = $_POST['landmarkID'];
	$specification= $_POST['specification'];

	$query = "INSERT INTO specifications (landmarkID , specification)  
			  VALUES ('$landmarkID', '$specification')";
		 
	mysqli_query($db, $query);
   	
?>
