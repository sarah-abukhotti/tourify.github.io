<?php
// Fetch data from the API
$apiUrl = 'https://rehamalswaisi.000webhostapp.com/fetchAllHotel.php';
$apiResponse = file_get_contents($apiUrl);
// Check if the API response is valid JSON
if ($apiResponse !== false) {
    // Convert JSON response to a PHP object
    $data = json_decode($apiResponse);
    // Check if the JSON decoding was successful
    if ($data !== null) {
        // $data now contains the API data as a PHP object
        // You can access the data and manipulate it as needed
        // For example, to access the first landmark's name:
       // $firstLandmarkName = $data[0]->landmarkName;
        // To loop through all the landmarks and display their names:
        echo count($data) . '<br>';
        
        foreach ($data as $landmark) {
            echo $landmark->landmarkName . '<br>';
        }
    } else {
        // JSON decoding failed
        echo 'Error: Unable to decode JSON data from the API.';
    }
} else {
    // Error fetching data from the API
    echo 'Error: Unable to fetch data from the API.';
}
?>
