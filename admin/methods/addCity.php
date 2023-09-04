<?php 
include_once('..\..\required/server.php');

 	$city   = $_POST['city'];
	$query = "INSERT INTO citys (name) values ('".$city ."')";
	mysqli_query($db, $query);
 ?>
