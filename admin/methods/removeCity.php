<?php 
include_once('..\..\required/server.php');

 	$controll   = $_POST['id'];
	$query = "DELETE FROM citys where id = ".$controll."";
	mysqli_query($db, $query);
    
?>
