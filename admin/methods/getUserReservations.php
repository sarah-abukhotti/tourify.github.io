<?php 
include_once('..\..\required/server.php');
  $query = "SELECT *
            FROM reservation
            ORDER BY id DESC";
  
        echo '  <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Username</th>
                      <th scope="col">Image</th>
                      <th scope="col">Landmark</th>
                      <th scope="col">Created At</th>
                      <th scope="col">Phone</th>
                      <th scope="col">Status</th>
                      <th scope="col">Info</th>
                      <th scope="col">Action</th>
                      <th scope="col">Remove</th>
                     </tr>
                  </thead>
                  <tbody>';
 
    
          $result = $db->query($query);
          $id = 1;
        
           while($row = $result->fetch_assoc()) { 

      
            if ($row['status'] == 0) {
                  $status ='Pending'; 
                  $btn = '<div class="btn btn-outline-success" onclick="accept('.$row['id'].')" >Accept</div>';
            }else{
                  $status ='Approved'; 
                  $btn = '<div class="btn btn-info" disabled >Done</div>';

            }
 
                $user = getUserById($row['uid']);
                echo '
                <tr>
                 <th scope="row">'.$id.'</th>
                 <td>'.@getUserFullName($row['uid']).'</td>

                 <td><img style="width:3em; height:3em;" src="../profile/'.@$user['image'].'" alt="Profile" class="rounded-circle">
                 </td>
                 <td>'.@getlandmarkNameByID(@$row['landmarkID']).'</td>
                 <td>'.@$row['createdAt'].'</td>
                 <td>'.@$user['phone'].'</td>
                 <td>'.@$status.'</td>
                 <td> <div class="btn btn-outline-primary" onclick="info('.$row['id'].')"><i class="ri-information-line"></i></div></td>
                 <td>'. $btn.'</td>
                 <td> <div class="btn btn-outline-danger" onclick="deleteResrvation('.$row['id'].')"><i class="ri-delete-bin-line"></i></div></td>
                </tr>
                ';
                     $id ++ ;  
              }

      echo '   </tbody>
          </table>';              
     // yellow($query);
    
?>