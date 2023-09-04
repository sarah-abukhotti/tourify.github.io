<?php 
include_once('..\..\required/server.php');

 	$controll   = $_POST['controll'];
	$query = "DELETE FROM specifications where id = ".$controll."";
	mysqli_query($db, $query);
   	
?>
