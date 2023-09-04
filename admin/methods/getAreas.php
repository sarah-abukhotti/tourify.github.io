<?php 
include_once('..\..\required/server.php');
 
if (isset($_GET['areaID'])) {
   $query = "SELECT *
             FROM citys_areas
             ";
  
   $result = $db->query($query);
         
   while($row = $result->fetch_assoc()) { 
      if ($_GET['areaID'] == $row['id']) {
         echo '<option value="'.$row['id'].'" selected> '.$row['areaName'].' </option>';
      } else {
         echo '<option value="'.$row['id'].'"> '.$row['areaName'].' </option>';
      }
   }
} else {
   $city = $_GET['city'];
   $query = "SELECT *
             FROM citys_areas
             WHERE cityId = ".$city."";
 
   echo '<option value="0" selected="true" hidden>Choose an area:</option>';

   $result = $db->query($query);
         
   while($row = $result->fetch_assoc()) { 
      echo '  <option value="'.$row['id'].'"> '.$row['areaName'].' </option>';
   }
}
?>
