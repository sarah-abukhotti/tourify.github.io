<?php 
include_once('..\..\required/server.php');
  $query = "SELECT *
          FROM users
          ORDER BY id ASC";
  
        echo '  <table class="table table-hover">
                  <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Type</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    <th scope="col">Delete</th>                    
                     </tr>
                  </thead>
                  <tbody>';
 
    
        $result = $db->query($query);
        
           while($row = $result->fetch_assoc()) { 

            if ($row['activity'] == 1 ) {
              $activity ='Active';
              $btn ='<div class="btn btn-outline-warning" onclick="Disactive('.$row['uid'].' )"><i class="ri-indeterminate-circle-line" ></i></div>';
          } else {
              $activity ='Inactive';
              $btn ='<div class="btn btn-outline-success" onclick="Active('.$row['uid'].' )"><i class="ri-creative-commons-sa-line"></i></div>';
          }
          

            $attribute = getUserType($row['type']);
            if($row['type']!=1){
              echo '
                     <tr>
                      <th scope="row">'.$row['id'].'</th>
                      <td>'.getUserFullName($row['uid']).'</td>
                      <td><img style="width:3em; height:3em;" src="..\profile/'. $row['image'].'" alt="Profile" class="rounded-circle">
                      </td>
                      <td>'.$row['phone'].'</td>
                      <td>'.$row['email'].'</td>
                      <td>'.$attribute.' </td>
                      <td>'.$activity.'</td>
                       <td>'.$btn.'</td>
                       <td><div class="btn btn-outline-danger" onclick="deleteUserData('.$row['uid'].' )"><i class="ri-delete-bin-line"></i></div></td>
                     </tr>
                     ';
              }else{
                echo '
                     <tr>
                      <th scope="row">'.$row['id'].'</th>
                      <td>'.getUserFullName($row['uid']).'</td>
                      <td><img style="width:3em; height:3em;" src="..\profile/'. $row['image'].'" alt="Profile" class="rounded-circle">
                      </td>
                      <td>'.$row['phone'].'</td>
                      <td>'.$row['email'].'</td>
                      <td>'.$attribute.' </td>
                      <td>'.$activity.'</td>
                       <td>'.$btn.'</td>
                       <td><div class="btn btn-dark" ><i class="ri-delete-bin-line"></i></div></td>
                     </tr>
                     ';
              }
            }

      echo '   </tbody>
          </table>';              
     
?>