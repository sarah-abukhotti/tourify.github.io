<?php 
include_once('..\..\required/server.php');
include_once('..\..\required/AdminFunctions.php');

  $servicesArray = AdminGetLandmarkServices($_GET['landmarkID']);
  $basicInformationArray = AdminGetlandmarkID($_GET['landmarkID']);
        echo '  <table class="table table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">service </th>
                      <th scope="col">Delete</th>
                     </tr>
                  </thead>
                  <tbody id="SpecificationAria">';
         $count = 1;
         foreach ($servicesArray as $key => $array)
              {
 
              echo '
                     <tr>
        <th scope="row">'.$count.'</th>
        <td>'. $array['serviceName'].' 
                       &nbsp; &nbsp; &nbsp; 
                     
                   </td>
        <td><i class="ri-delete-bin-line" onclick="deleteDataService('. $array['controll'].' )"></i></td>
       </tr>
       ';
       $count ++ ;
              }

      echo '   </tbody>
          </table>';              
     
?>