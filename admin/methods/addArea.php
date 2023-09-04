<?php 
include_once('..\..\required/server.php');
  	$name   = $_POST['name'];
 	$city   = $_POST['city'];
 	$uid   = $_SESSION['user']['uid'];
	$query = "INSERT INTO citys_areas (cityId , areaName , addBy) values ('".$city ."' ,'".$name ."' ,'".$uid ."')";
	mysqli_query($db, $query);
 ?>
