<?php 
include_once('..\..\required/server.php');
$query = "SELECT * , citys_areas.id as controll 
          FROM citys
          JOIN citys_areas ON citys_areas.cityId = citys.id
          ORDER BY citys.name, citys_areas.areaName ASC";

echo '<table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">City</th>
              <th scope="col">Area</th>
              <th scope="col">Added By</th>
              <th scope="col">Delete</th>
            </tr>
          </thead>
          <tbody>';

$count = 1;

$result = $db->query($query);

while($row = $result->fetch_assoc()) { 
    echo '
        <tr>
            <th scope="row">'.$count.'</th>
            <td>'. $row['name'].'</td>
            <td>'. $row['areaName'].'</td>
            <td>'. getUserFullName($row['addBy']).'</td>
            <td><i class="ri-delete-bin-line" onclick="deleteDataArea('.$row['controll'].')"></i></td>
        </tr>
    ';
    $count++;
}

echo '</tbody>
      </table>';              
     
?>
