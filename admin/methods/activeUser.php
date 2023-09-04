<?php 

include_once('..\..\required/server.php');
 
	$uid   = $_POST['uid'];
 
	$query = "UPDATE users SET activity=1 WHERE  uid=".$uid."";
			 
	mysqli_query($db, $query);
   	
?>
