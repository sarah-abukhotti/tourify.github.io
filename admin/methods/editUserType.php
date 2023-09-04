<?php 

include_once('..\..\required/server.php');
 
	$uid   = $_POST['owner'];
	$type   = $_POST['type'];
 
	$query = "UPDATE users SET type=".$type." WHERE  uid=".$uid."";
			 
	mysqli_query($db, $query);
   	
?>
