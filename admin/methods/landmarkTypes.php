<?php
include_once('..\..\required/connect.php');
 
if (isset($_GET['id'])) {

   $sql = "SELECT * from landmarks_type ";
 
   $result = $db->query($sql);

   while($row = $result->fetch_assoc()) { 
      if ($_GET['id'] == $row['id']) {
         echo '<option class="form-control" value="'.$row['id'].'" selected>'.$row['type'].' </option>';
      }else{
         echo '<option class="form-control" value="'.$row['id'].'">'.$row['type'].' </option>';

      }

  }

   
}else{

   $sql = "SELECT * from landmarks_type ";
   echo '<option value="0" selected="true"   hidden>Select the type: </option>';

   $result = $db->query($sql);

   while($row = $result->fetch_assoc()) { 
      echo '<option class="form-control" value="'.$row['id'].'">'.$row['type'].' </option>';

  }
}
  
?>
