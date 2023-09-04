<?php 
include_once('..\..\required/server.php');
  
 // echo "<pre>";
// print_r($_FILES);
// print_r($_REQUEST);
 
$stmt   = array(); 
if ($_POST['owner'] != null) {
	array_push($stmt,  "owner ='".$_POST['owner']."' " ); 
 }
 if ($_POST['landmarkName'] != null) {
	array_push($stmt,  "landmarkName ='".$_POST['landmarkName']."' " ); 
 }

if ($_POST['type'] != null) {
	array_push($stmt,  "type ='".$_POST['type']."' " ); 
 }

 if ($_POST['price'] != null) {
	array_push($stmt,  "price ='".$_POST['price']."' " ); 
 }

if ($_POST['description'] != null) {
	array_push($stmt,  "description ='".$_POST['description']."' " ); 
 }

if ($_POST['longitude'] != null) {
	array_push($stmt,  "longitude ='".$_POST['longitude']."' " ); 
 }

if ($_POST['latitude'] != null) {
	array_push($stmt,  "latitude ='".$_POST['latitude']."' " ); 
 }

if ($_POST['city'] != null) {
	array_push($stmt,  "city ='".$_POST['city']."' " ); 
 }
if ($_POST['city'] != null) {
	array_push($stmt,  "areaID ='".$_POST['area']."' " ); 
 }

if ($_POST['haveBooking'] != null) {
	array_push($stmt,  "haveBooking ='".$_POST['haveBooking']."' " ); 
 }
 if ($_POST['activity'] != null) {
	array_push($stmt,  "activity ='".$_POST['activity']."' " ); 
 }
 
 
	  $array_data ='';
	  $total_count = count($stmt) ; 
	  $count = 1;

foreach ($stmt as $data){
				
				if ($total_count == $count) {
					$array_data .=  $data;
				}else{
					$array_data .=  $data .' ,';
 					
				}
		   $count ++ ;
		}
// echo $array_data;
  $query = "UPDATE landmarks set ".$array_data." where id = '".$_POST['landmarkID']."'"; 
  mysqli_query($db, $query); 
 
  if(isset($_FILES['file']['name'])){

  $filename = $_FILES['file']['name'];
  $location = "..\..\landmark-Image-main/".$filename;
  $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
  $imageFileType = strtolower($imageFileType);
	/* Valid extensions */
  $valid_extensions = array("jpg","jpeg","png");
  $response = 0;
  if (move_uploaded_file($_FILES['file']['tmp_name'],$location)) {
  	  $query2 = "UPDATE images set image ='".$filename."' WHERE main=1 and landmarkID ='".$_POST['landmarkID']."'"; 
      mysqli_query($db, $query2); 
  }
}
 
 
 


?>
