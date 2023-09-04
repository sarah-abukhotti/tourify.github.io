<?php
include_once('..\..\required/server.php');
 
$sql = "SELECT * from landmarks ORDER BY ID DESC";
echo '<option value="0" selected="true" hidden>Select the place: </option>';

$result = $db->query($sql);

   while($row = $result->fetch_assoc()) { 
      echo '<option class="form-control" value="'.$row['id'].'">'.$row['landmarkName'].' </option>';

  }
  
?>
