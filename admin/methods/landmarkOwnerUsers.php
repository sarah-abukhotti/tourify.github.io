<?php 
include_once('..\..\required/server.php');

if (isset($_GET['owner'])) {
     $query = "SELECT *
               FROM users
               WHERE type = 1
               ORDER BY id ASC";
 
           $result = $db->query($query);
         
           while($row = $result->fetch_assoc()) { 
            if ($_GET['owner'] == $row['uid']) {
                echo '  <option value="'.$row['uid'].'" selected> '.$row['fname'].' '.$row['lname'].' </option>';

            }else{
               echo '  <option value="'.$row['uid'].'"> '.$row['fname'].' '.$row['lname'].' </option>';
 
            }
 
            }
    
}else{
     $query = "SELECT *
               FROM users
               WHERE type = 1
               ORDER BY id ASC";
               echo '<option value="0" selected="true" hidden>Select the owner: </option>';

          $result = $db->query($query);
         
          while($row = $result->fetch_assoc()) { 

              echo '  <option value="'.$row['uid'].'"> '.$row['fname'].' '.$row['lname'].' </option>';
      
          }
}
 
 
    
?>
 