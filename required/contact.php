<?php 
include_once('connect.php'); 
 
	$name        = $_POST['name'];
	$email       = $_POST['email'];
	$subject     = $_POST['subject'];
	$message     = $_POST['message'];
 	
	$query = "INSERT INTO reports (name, email , subject , message )  
					    VALUES ( '".$name."', '".$email."','".$subject."','".$message."')";
					    echo 	$query;
	mysqli_query($db, $query);
?>