<?php 
include_once('..\..\required/server.php');

 	$type   = $_POST['type'];
	$query = "INSERT INTO landmarks_type (type) values ('".$type ."')";
	mysqli_query($db, $query);
   	echo $query;
?>
