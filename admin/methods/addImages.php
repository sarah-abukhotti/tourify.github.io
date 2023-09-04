<?php
include_once('..\..\required/server.php');

if (isset($_POST['imageText'])) {
    $landmarkID = $_POST['landmarkID'];
    $imageText = $_POST['imageText'];
    $imageUrls = explode("\n", $imageText); // Assuming each URL is on a new line in the textarea.

    foreach ($imageUrls as $imageUrl) {
        $imageUrl = trim($imageUrl);
        if ($imageUrl !== '') {
            $insert = "INSERT into images(landmarkID, image, main) values('$landmarkID', '$imageUrl', 0)";
            mysqli_query($db, $insert);
        }
    }
}
?>
