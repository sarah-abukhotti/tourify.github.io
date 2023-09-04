<?php 
include_once('..\..\required/server.php');

 	$controll   = $_POST['uid'];
	$query = "DELETE FROM users where uid = ".$controll."";
	mysqli_query($db, $query);
   	
?>
