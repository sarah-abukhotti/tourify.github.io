<?php 
include_once('..\..\required/server.php');
if (isset($_GET['id'])) {
    $query = "SELECT *
              FROM citys
              ORDER BY id ASC";
    echo '<option value="0" selected="true" hidden>Select City:</option>';

    $result = $db->query($query);

    while($row = $result->fetch_assoc()) { 
        if ($_GET['id'] == $row['id']) {
            echo '<option value="'.$row['id'].'" selected>'.$row['name'].'</option>';
        } else {
            echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
        }
    }
} else {
    $query = "SELECT *
              FROM citys
              ORDER BY id ASC";
    echo '<option value="0" selected="true" hidden>Select City:</option>';

    $result = $db->query($query);

    while($row = $result->fetch_assoc()) { 
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }
}
?>
