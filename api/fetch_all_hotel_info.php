<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tourify";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch all columns from the "landmarks" table
$sql = "SELECT * FROM landmarks";
$result = $conn->query($sql);

// Create an array to store the results
$data = array();

if ($result->num_rows > 0) {
    // Loop through each row of the result
    while ($row = $result->fetch_assoc()) {
        // Add the row to the data array
        $data[] = $row;
    }
}

// Close the database connection
$conn->close();

// Set the appropriate headers
header('Content-Type: application/json');

// Convert the data array to JSON and output it
echo json_encode($data);

?>
