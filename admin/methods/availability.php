<?php 

include_once('..\..\required/server.php');
 
	$landmarkID   = $_POST['landmarkID'];
	$fromDay	  = $_POST['fromDay'];
	$toDay	 	  = $_POST['toDay'];
	$atTime	 	  = $_POST['atTime'];
	$toTime	      = $_POST['toTime'];
	$exception	  = $_POST['exception'];

	$query = "UPDATE availability SET fromDay = '".$fromDay."' , toDay = '".$toDay."' , atTime ='".$atTime."', toTime ='".$toTime."', exception = '".$exception."', updatedBy = '".$_SESSION['user']['uid']."' WHERE landmarkID ='".$landmarkID."'";
			 
	mysqli_query($db, $query);
   	
?>
