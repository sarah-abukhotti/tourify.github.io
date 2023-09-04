<?php 
include_once('..\..\required/server.php');
  	$controll   = $_POST['id'];
	$query = "DELETE FROM citys_areas where id = ".$controll."";
	mysqli_query($db, $query);
 
?>
