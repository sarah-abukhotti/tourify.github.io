<?php 
include_once('..\..\required/server.php');
  $query = "SELECT *
          FROM landmarks_type
          ORDER BY id ASC";
 

        echo '  <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Type</th>
                      <th scope="col">Delete</th>
                     </tr>
                  </thead>
                  <tbody>';
 
    
        $result = $db->query($query);
        
           while($row = $result->fetch_assoc()) { 

              echo '
                     <tr>
                      <th scope="row">'.$row['id'].'</th>
                      <td>'. $row['type'].' 
                                     &nbsp; &nbsp; &nbsp;      </td>
                      <td><i class="ri-delete-bin-line" onclick="deleteDataType('. $row['id'].' )"></i></td>
                     </tr>
                     ';
      
              }

      echo '   </tbody>
          </table>';              
     
?>