<?php 
include_once('..\..\required/server.php');

 	$controll   = $_POST['id'];
	$query = "DELETE FROM landmarks_type where id = ".$controll."";
	mysqli_query($db, $query);
   	
?>
